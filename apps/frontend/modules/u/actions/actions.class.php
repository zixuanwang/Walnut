<?php
require_once sfConfig::get ( 'sf_lib_dir' ) . '/SolrPhpClient/Apache/Solr/Service.php';
require_once sfConfig::get ( 'sf_lib_dir' ) . '/walnut/HbaseAdapter.php';
require_once sfConfig::get ( 'sf_lib_dir' ) . '/walnut/GlobalConfig.php';
require_once sfConfig::get ( 'sf_lib_dir' ) . '/walnut/ImageDaemonAdapter.php';
require_once sfConfig::get ( 'sf_lib_dir' ) . '/walnut/ANNTreeDaemonAdapter.php';

class uActions extends sfActions {
	const SOLR_SERVER_NAME = 'localhost';
	const SOLR_SERVER_PORT = '8080';
	const SOLR_ROOT_DIR = '/solr/';
	
	public function executeHome(sfWebRequest $request) {
		$this->limit = 16;
		$solr = new Apache_Solr_Service ( self::SOLR_SERVER_NAME, self::SOLR_SERVER_PORT, self::SOLR_ROOT_DIR );
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
	
	public function executeView(sfWebRequest $request) {
	
	}
	
	public function executeAbout(sfWebRequest $request) {
	
	}
	
	public function executeJoin(sfWebRequest $request) {
	
	}
	
	public function executeError(sfWebRequest $request) {
	
	}
	
	public function executeGuidance(sfWebRequest $request) {
	
	}
	
	public function executeFaq(sfWebRequest $request) {
	
	}
	
	public function getCategoryName($indexName) {
		$string = file_get_contents ( '/export/sfproject/walnut/web/js/category.json' );
		$json = json_decode ( $string, true );
		$indexArray = explode ( '|', $indexName );
		if (count ( $indexArray ) > 0) {
			$categoryName = $json [$indexArray [0]] [name];
			$json = $json [$indexArray [0]] [children];
			for($i = 1; $i < count ( $indexArray ); ++ $i) {
				$categoryName .= '|' . $json [$indexArray [$i]] [name];
				$json = $json [$indexArray [$i]] [children];
			}
		}
		return $categoryName;
	}
	
	public function executeQuery(sfWebRequest $request) {
		if ($request->isMethod ( 'post' )) {
			// get category name
			$imagePathPrefix = '/export/sfproject/walnut/web/uploads/';
			$categoryName = $request->getParameter ( 'sub_0' );
			for($i = 1; $i < 4; ++ $i) {
				if ($request->hasParameter ( 'sub_' . $i )) {
					$categoryName .= '|' . $request->getParameter ( 'sub_' . $i );
				}
			}
			$categoryName = $this->getCategoryName ( $categoryName );
			$imagePath = $imagePathPrefix . $request->getParameter ( 'path' );
			$hbaseAdapter = new HbaseAdapter ();
			$colorTreeIndex = unpack ( 'i', $hbaseAdapter->loadCell ( 'category_index', $categoryName, 'd:color' ) );
			$colorTreeIndex = $colorTreeIndex [1];
			$shapeTreeIndex = unpack ( 'i', $hbaseAdapter->loadCell ( 'category_index', $categoryName, 'd:shape' ) );
			$shapeTreeIndex = $shapeTreeIndex [1];
			$surfTreeIndex = unpack ( 'i', $hbaseAdapter->loadCell ( 'category_index', $categoryName, 'd:surf' ) );
			$surfTreeIndex = $surfTreeIndex [1];
			if ($colorTreeIndex != null) {
				$ann = new ANNTreeDaemonAdapter ();
				$colorResults = $ann->query ( $imagePath, $colorTreeIndex, 'color', 8 );
			}
			if ($shapeTreeIndex != null) {
				$ann = new ANNTreeDaemonAdapter ();
				$shapeResults = $ann->query ( $imagePath, $shapeTreeIndex, 'shape', 8 );
			}
			if ($surfTreeIndex != null) {
				$ann = new ANNTreeDaemonAdapter ();
				$surfResults = $ann->query ( $imagePath, $surfTreeIndex, 'surf', 8 );
			}
			$this->colorProductArray = array ();
			$this->shapeProductArray = array ();
			$this->surfProductArray = array ();
			foreach ( $colorResults as $result ) {
				$products = $this->getProductInfo ( $result );
				foreach ( $products as $product ) {
					$this->colorProductArray [] = $product;
				}
			}
			foreach ( $shapeResults as $result ) {
				$products = $this->getProductInfo ( $result );
				foreach ( $products as $product ) {
					$this->shapeProductArray [] = $product;
				}
			}
			foreach ( $surfResults as $result ) {
				$products = $this->getProductInfo ( $result );
				foreach ( $products as $product ) {
					$this->surfProductArray [] = $product;
				}
			}
		}
	}
	
	public function executeSelectimage(sfWebRequest $request) {
		if ($request->isMethod ( 'post' )) {
			if ($request->hasParameter ( 'inputlink' )) {
				$linkurl = $request->getParameter ( 'inputlink' );
				$pathParts = pathinfo ( $linkurl );
				$pathExt = strtolower ( $pathParts ['extension'] );
				if ($pathExt == 'jpg' || $pathExt == 'jpeg') {
					$tmpPath = '/tmp/' . rand () . time () . '.jpg';
					$this->downloadFile ( $linkurl, $tmpPath );
					$filename = md5_file ( $tmpPath );
					$filepath = sfConfig::get ( 'sf_upload_dir' ) . '/' . $filename . '.jpg';
					rename ( $tmpPath, $filepath );
				} else {
					$this->getUser ()->setAttribute ( 'errorMessage', '请使用jpeg图片：）' );
					$this->redirect ( 'u/error' );
				}
			} else {
				$file = $request->getFiles ( 'inputfile' );
				$filepath = $this->saveUploadedImage ( $file );
			}
			$name = basename ( $filepath, '.jpg' );
			$dirName = dirname ( $filepath );
			$this->imagePath = $name . '_200.jpg';
			$client = new ImageDaemonAdapter ();
			$client->cropImage ( $filepath, $dirName . '/' . $this->imagePath, 200, 0 );
		}
	}
	
	public function saveImage($filePath) {
		$filename = md5_file ( $filePath );
		$newFilePath = sfConfig::get ( 'sf_upload_dir' ) . '/' . $filename . '.jpg';
		move_uploaded_file ( $filePath, $newFilePath );
		return $newFilePath;
	}
	
	public function saveUploadedImage($file) {
		// This function downsample and rename the uploaded image
		// The image path is returned.
		$type = $file ['type'];
		if (strstr ( $type, '/', true ) != 'image') {
			$this->getUser ()->setAttribute ( 'errorMessage', '请使用jpeg图片：）' );
			$this->redirect ( 'u/error' );
		}
		$pathParts = pathinfo ( $file ['name'] );
		$pathExt = strtolower ( $pathParts ['extension'] );
		if ($pathExt != 'jpg' && $pathExt != 'jpeg') {
			$this->getUser ()->setAttribute ( 'errorMessage', '请使用jpeg图片：）' );
			$this->redirect ( 'u/error' );
		}
		return $this->saveImage ( $file ['tmp_name'] );
	}
	
	public function downloadFile($url, $path) {
		$newfname = $path;
		$file = fopen ( $url, "rb" );
		if ($file) {
			$newf = fopen ( $newfname, "wb" );
			if ($newf)
				while ( ! feof ( $file ) ) {
					fwrite ( $newf, fread ( $file, 1024 * 8 ), 1024 * 8 );
				}
		}
		if ($file) {
			fclose ( $file );
		}
		if ($newf) {
			fclose ( $newf );
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
		// build back menu from prefix
		$prefixArray = explode ( '|', $this->prefix );
		$prefixArraySize = count ( $prefixArray );
		if ($prefixArraySize > 1) {
			$this->parentMenu = $prefixArray [$prefixArraySize - 1];
			$this->parentMenuUrl = $this->buildParentPrefix ( $this->prefix );
		}
	}
	
	public function buildParentPrefix($prefix) {
		$newPrefix = '';
		$token = explode ( '|', $prefix );
		$tokenSize = count ( $token );
		if ($tokenSize > 2) {
			$newPrefix = $token [0] - 1;
			for($i = 1; $i < $tokenSize - 1; ++ $i) {
				$newPrefix .= '|' . $token [$i];
			}
		}
		return $newPrefix;
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
	
	public function packLong($v) {
		return pack ( 'll', $v & 0xFFFFFFFF, $v >> 32 );
	}
	
	public function unpackLong($v) {
		return unpack ( 'll', $v );
	}
	
	public function executeImagequery(sfWebRequest $request) {
		$this->page = $request->getParameter ( 'page', 0 );
		$this->imageKey = $request->getParameter ( 'imagekey', - 1 );
		$this->featureType = $request->getParameter ( 't', null );
		$hbaseAdapter = new HbaseAdapter ();
		if ($this->featureType == 'color') {
			// get color neighbors
			$neighborIdArray = explode ( '|', $hbaseAdapter->loadCell ( 'image_index', $this->packLong ( $this->imageKey ), 'd:color' . $this->page ) );
		}
		if ($this->featureType == 'shape') {
			// get shape neighbors
			$neighborIdArray = explode ( '|', $hbaseAdapter->loadCell ( 'image_index', $this->packLong ( $this->imageKey ), 'd:shape' . $this->page ) );
		}
		if ($this->featureType == 'pattern') {
			// get surf neighbors
			$neighborIdArray = explode ( '|', $hbaseAdapter->loadCell ( 'image_index', $this->packLong ( $this->imageKey ), 'd:surf' . $this->page ) );
		}
		$this->productArray = array ();
		foreach ( $neighborIdArray as $neighborId ) {
			$products = $this->getProductInfo ( $neighborId );
			foreach ( $products as $product ) {
				$this->productArray [] = $product;
			}
		}
		
		$this->pageArray = array ();
		for($i = - 3; $i <= 3; ++ $i) {
			$p = $this->page + $i;
			if ($p >= 0) {
				$this->pageArray [] = $p;
			}
		}
	}
	
	public function getProductInfo($imageKey) {
		$productArray = array ();
		try {
			$solr = new Apache_Solr_Service ( self::SOLR_SERVER_NAME, self::SOLR_SERVER_PORT, self::SOLR_ROOT_DIR );
			$result = $solr->search ( 'imagekey:' . $imageKey, 0, 1 );
			foreach ( $result->response->docs as $product ) {
				$productArray [] = $product;
			}
		
		} catch ( Exception $e ) {
		}
		return $productArray;
	}
	
	public function executeTextquery(sfWebRequest $request) {
		$this->limit = 16;
		$this->page = $request->getParameter ( 'page', 0 );
		$this->query = $request->getParameter ( 'q', '*' );
		$this->prefix = $request->getParameter ( 'prefix' );
		$this->results = false;
		$solr = new Apache_Solr_Service ( self::SOLR_SERVER_NAME, self::SOLR_SERVER_PORT, self::SOLR_ROOT_DIR );
		try {
			$categoryParameters = array ();
			$categoryParameters ['facet'] = 'true';
			$categoryParameters ['facet.field'] = array ('category' );
			$categoryParameters ['stats'] = 'true';
			$categoryParameters ['stats.field'] = 'price';
			// $categoryParameters ['sort'] = 'price asc';
			
			if ($request->hasParameter ( 'prefix' )) {
				// has category constraint
				$categoryParameters ['fq'] = 'category:' . $this->prefix;
				$categoryParameters ['facet.prefix'] = stripslashes ( $this->buildNextPrefix ( $this->prefix ) );
			} else {
				$categoryParameters ['facet.prefix'] = '0|';
			}
			$this->results = $solr->search ( $this->query, $this->page * $this->limit, $this->limit, $categoryParameters );
			// print_r($this->results);
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
	
	public function executeUpload(sfWebRequest $request) {
		$imagePath = $this->saveImage ( $request );
		$this->resultArray = $this->query ( $imagePath );
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
