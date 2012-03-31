<?php
$GLOBALS ['THRIFT_ROOT'] = sfConfig::get ( 'sf_lib_dir' ) . '/thrift/';

// Load up all the thrift stuff
require_once $GLOBALS ['THRIFT_ROOT'] . 'Thrift.php';
require_once $GLOBALS ['THRIFT_ROOT'] . 'protocol/TBinaryProtocol.php';
require_once $GLOBALS ['THRIFT_ROOT'] . 'transport/TSocket.php';
require_once $GLOBALS ['THRIFT_ROOT'] . 'transport/TBufferedTransport.php';
require_once $GLOBALS ['THRIFT_ROOT'] . 'transport/TFramedTransport.php';
require_once $GLOBALS ['THRIFT_ROOT'] . 'packages/Hbase/Hbase.php';

class HbaseAdapter {
	
	function __construct() {
		try {
			$this->mSocket = new TSocket ( self::SERVER_NAME, self::SERVER_PORT );
			$this->mSocket->setRecvTimeout ( 10000 );
			$this->mTransport = new TBufferedTransport ( $this->mSocket );
			$this->mProtocol = new TBinaryProtocol ( $this->mTransport );
			$this->mClient = new HbaseClient ( $this->mProtocol );
			$this->mTransport->open ();
		} catch ( TException $e ) {
		
		}
	}
	function __destruct() {
		$this->mTransport->close ();
	}
	public function loadCell($tableName, $rowKey, $columnName) {
		try {
			$cell = $this->mClient->get ( $tableName, $rowKey, $columnName );
			if (empty ( $cell )) {
				return '';
			} else {
				return $cell [0]->value;
			}
		} catch ( TException $e ) {
		}
		return '';
	}
	
	public function loadCells($tableName, $rowKey, $columnNameArray) {
		try {
			$cellArray = $this->mClient->getRowWithColumns ( $tableName, $rowKey, $columnNameArray );
			if (empty ( $cellArray )) {
				return '';
			} else {
				$ret = array ();
				foreach ( $cellArray [0]->columns as $columnName => $value ) {
					$ret [$columnName] = $cellArray [0]->columns [$columnName]->value;
				}
				return $ret;
			}
		} catch ( TException $e ) {
		}
		return '';
	}
	
	const SERVER_NAME = 'localhost';
	const SERVER_PORT = '9090';
	private $mSocket;
	private $mTransport;
	private $mProtocol;
	private $mClient;
}

?>