<?php
$GLOBALS ['THRIFT_ROOT'] = sfConfig::get ( 'sf_lib_dir' ) . '/thrift/';

// Load up all the thrift stuff
require_once $GLOBALS ['THRIFT_ROOT'] . 'Thrift.php';
require_once $GLOBALS ['THRIFT_ROOT'] . 'protocol/TBinaryProtocol.php';
require_once $GLOBALS ['THRIFT_ROOT'] . 'transport/TSocket.php';
require_once $GLOBALS ['THRIFT_ROOT'] . 'transport/TBufferedTransport.php';
require_once $GLOBALS ['THRIFT_ROOT'] . 'transport/TFramedTransport.php';

// Load the package that we autogenerated for this tutorial
require_once $GLOBALS ['THRIFT_ROOT'] . 'packages/ImageDaemon/ImageDaemon.php';
require_once $GLOBALS ['THRIFT_ROOT'] . 'packages/Hbase/Hbase.php';
require_once sfConfig::get ( 'sf_lib_dir' ) . '/SolrPhpClient/Apache/Solr/Service.php';

class uActions extends sfActions {
	/**
	 * Executes index action
	 *
	 * @param $request sfRequest
	 *       	 A request object
	 */
	public function executeHome(sfWebRequest $request) {
		$this->limit = 16;
		$solr = new Apache_Solr_Service ( 'localhost', 8080, '/solr/' );
		try {
			$additionalParameters = array ('facet' => 'true', 'facet.prefix' => 0, 'facet.field' => array ('category' ) );
			$this->results = $solr->search ( '*', $this->page * $this->limit, $this->limit, $additionalParameters );
			// Generate the navigation menu
			$this->buildNavigation ( $this->results );
			$this->total = ( int ) $this->results->response->numFound;
			$this->start = min ( $this->page * $this->limit, $this->total );
			$this->end = min ( ($this->page + 1) * $this->limit, $this->total );
			$this->pageArray = array ();
			for($i = - 3; $i <= 3; ++ $i) {
				$p = $this->page + $i;
				if ($p >= 0 && $p * $this->limit < $this->total) {
					$this->pageArray [] = $p;
				}
			}
		} catch ( Exception $e ) {
		
		}
	}
	
	public function buildNavigation($queryResult) {
		$this->menuArray = array ();
		$this->prefixMenuArray = array ();
		foreach ( $queryResult->facet_counts->facet_fields->category as $key => $value ) {
			if ($value != 0) {
				$menu = explode ( '|', $key );
				$menuSize = count ( $menu );
				$this->menuArray [$menu [$menuSize - 1]] = $value;
				$this->prefixMenuArray [$menu [$menuSize - 1]] = addslashes ( $key );
			}
		}
	}
	
	public function buildNextPrefix($prefix) {
		$newPrefix = '';
		$token = explode ( '|', $prefix );
		$tokenSize = count ( $token );
		if ($tokenSize > 0) {
			$newPrefix = $token [0] + 1;
			for($i = 1; $i < $tokenSize; ++ $i) {
				$newPrefix .= '|' . $token [$i];
			}
		}
		return $newPrefix;
	}
	
	public function executeTextquery(sfWebRequest $request) {
		$this->limit = 16;
		$this->page = $request->getParameter ( 'page', 0 );
		$this->query = $request->getParameter ( 'q', '*' );
		$this->prefix = $request->getParameter ( 'prefix', '0' );
		$this->results = false;
		$solr = new Apache_Solr_Service ( 'localhost', 8080, '/solr/' );
		try {
			$additionalParameters = array ('fq' => 'category:' . $this->prefix, 'facet' => 'true', 'facet.prefix' => stripslashes ( $this->buildNextPrefix ( $this->prefix ) ), 'facet.field' => array ('category' ) );
			$this->results = $solr->search ( $this->query, $this->page * $this->limit, $this->limit, $additionalParameters );
			// Generate the navigation menu
			$this->buildNavigation ( $this->results );
			$this->total = ( int ) $this->results->response->numFound;
			$this->start = min ( $this->page * $this->limit, $this->total );
			$this->end = min ( ($this->page + 1) * $this->limit, $this->total );
			$this->pageArray = array ();
			for($i = - 3; $i <= 3; ++ $i) {
				$p = $this->page + $i;
				if ($p >= 0 && $p * $this->limit < $this->total) {
					$this->pageArray [] = $p;
				}
			}
		} catch ( Exception $e ) {
		}
	}
	
	public function executeQuery(sfWebRequest $request) {
		if ($request->isMethod ( 'post' )) {
			$file = $request->getFiles ( 'fileInput' );
			$imagePath = $this->saveUploadedImage ( $file );
			$time_start = microtime ( true );
			$hashArray = $this->query ( $imagePath );
			$time_end = microtime ( true );
			$this->time = $time_end - $time_start;
			$this->productArray = array ();
			$i = 0;
			foreach ( $hashArray as $hash ) {
				$itemRowKey = $this->loadCell ( 'image', $hash, 'd:ii_0' );
				$this->productArray [$i] = array ();
				$this->productArray [$i] ['image'] = $hash . '_160.jpg';
				$this->productArray [$i] ['item'] = $this->getItemInfo ( $itemRowKey );
				$i ++;
			}
		}
	}
	
	public function executeUpload(sfWebRequest $request) {
		$imagePath = $this->saveImage ( $request );
		$this->resultArray = $this->query ( $imagePath );
	}
	
	public function saveImage($request) {
		$base = $request->getParameter ( 'image' );
		$binary = base64_decode ( $base );
		header ( 'Content-Type: bitmap; charset=utf-8' );
		$filename = sfConfig::get ( 'sf_upload_dir' ) . '/' . uniqueFilename ( '.jpg' );
		$file = fopen ( $filename, 'wb' );
		fwrite ( $file, $binary );
		fclose ( $file );
		return $filename;
	}
	
	public function query($imagePath) {
		try {
			$socket = new TSocket ( 'node2', '9992' );
			$socket->setRecvTimeout ( 20000 );
			$transport = new TFramedTransport ( $socket );
			$protocol = new TBinaryProtocol ( $transport );
			$client = new ImageDaemonClient ( $protocol );
			$transport->open ();
			$hashArray = $client->query ( $imagePath );
		} catch ( TException $tx ) {
			echo "ThriftException: " . $tx->getMessage () . "\r\n";
		}
		return $hashArray;
	}
	
	public function saveUploadedImage($file) {
		// This function downsample and rename the uploaded image
		// The image path is returned.
		$type = $file ['type'];
		if (strstr ( $type, '/', true ) != 'image') {
			return null;
		}
		$filename = md5_file ( $file ['tmp_name'] );
		$filepath = sfConfig::get ( 'sf_upload_dir' ) . '/' . $filename . '.jpg';
		move_uploaded_file ( $file ['tmp_name'], $filepath );
		// system ( 'convert ' . $file ['tmp_name'] . ' -resize 320x320 ' .
		// $filepath );
		return $filepath;
	}
	
	public function getItemInfo($itemRowKey) {
		$item = array ();
		try {
			$socket = new TSocket ( 'localhost', '9090' );
			$socket->setRecvTimeout ( 10000 );
			$transport = new TBufferedTransport ( $socket );
			$protocol = new TBinaryProtocol ( $transport );
			$client = new HbaseClient ( $protocol );
			$transport->open ();
			$infoArray = $client->getRowWithColumns ( 'item', $itemRowKey, array ('d:ap_0', 'd:nm_0', 'd:u_0', 'd:m_0' ) );
			$item ['price'] = $infoArray [0]->columns ['d:ap_0']->value;
			$item ['name'] = $infoArray [0]->columns ['d:nm_0']->value;
			$item ['url'] = $infoArray [0]->columns ['d:u_0']->value;
			$item ['source'] = $infoArray [0]->columns ['d:m_0']->value;
			$transport->close ();
		} catch ( TException $e ) {
			echo "ThriftException: " . $e->getMessage () . "\r\n";
		}
		return $item;
	}
	
	public function loadCell($tableName, $rowKey, $columnName) {
		$value = '';
		try {
			$socket = new TSocket ( 'localhost', '9090' );
			$socket->setRecvTimeout ( 10000 );
			$transport = new TBufferedTransport ( $socket );
			$protocol = new TBinaryProtocol ( $transport );
			$client = new HbaseClient ( $protocol );
			$transport->open ();
			$infoArray = $client->getRowWithColumns ( $tableName, $rowKey, array ($columnName ) );
			if (count ( $infoArray ) > 0) {
				$value = $infoArray [0]->columns [$columnName]->value;
			}
			$transport->close ();
		} catch ( TException $e ) {
			echo "ThriftException: " . $e->getMessage () . "\r\n";
		}
		return $value;
	}
	
	public function getImageInfo($imageArray) {
		$ret = array ();
		try {
			$socket = new TSocket ( 'localhost', '9090' );
			$socket->setRecvTimeout ( 60000 );
			$transport = new TBufferedTransport ( $socket );
			$protocol = new TBinaryProtocol ( $transport );
			$client = new HbaseClient ( $protocol );
			$transport->open ();
			$i = 0;
			foreach ( $imageArray as $imagePath ) {
				$item = array ();
				$item ['image'] = $imagePath;
				$imageHash = basename ( $imagePath, '.jpg' );
				$productArray = $client->get ( 'image', $imageHash, 'd:ii_0' );
				if (! empty ( $productArray )) {
					$productId = $productArray [0]->value;
					$infoArray = $client->getRowWithColumns ( 'meta', $productId, array ('d:u_0', 'd:t_0', 'd:lnp_0' ) );
					$item ['title'] = $infoArray [0]->columns ['d:t_0']->value;
					$item ['url'] = $infoArray [0]->columns ['d:u_0']->value;
					$item ['price'] = $infoArray [0]->columns ['d:lnp_0']->value;
				}
				$ret [$i ++] = $item;
			}
			$transport->close ();
		} catch ( TException $e ) {
			echo "ThriftException: " . $e->getMessage () . "\r\n";
		}
		return $ret;
	}
	
	public $mServer = 'localhost';
	public $mImageCount = 15;
}
