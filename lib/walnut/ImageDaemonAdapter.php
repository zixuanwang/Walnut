<?php
$GLOBALS ['THRIFT_ROOT'] = sfConfig::get ( 'sf_lib_dir' ) . '/thrift/';
require_once $GLOBALS ['THRIFT_ROOT'] . 'Thrift.php';
require_once $GLOBALS ['THRIFT_ROOT'] . 'protocol/TBinaryProtocol.php';
require_once $GLOBALS ['THRIFT_ROOT'] . 'transport/TSocket.php';
require_once $GLOBALS ['THRIFT_ROOT'] . 'transport/TBufferedTransport.php';
require_once $GLOBALS ['THRIFT_ROOT'] . 'transport/TFramedTransport.php';
require_once $GLOBALS ['THRIFT_ROOT'] . 'packages/ImageDaemon/ImageDaemon.php';

class ImageDaemonAdapter {
	
	function __construct() {
		try {
			$this->mSocket = new TSocket ( self::IMAGE_DAEMON_SERVER_NAME, self::IMAGE_DAEMON_SERVER_PORT );
			$this->mSocket->setRecvTimeout ( 10000 );
			$this->mTransport = new TFramedTransport ( $this->mSocket );
			$this->mProtocol = new TBinaryProtocol ( $this->mTransport );
			$this->mClient = new ImageDaemonClient ( $this->mProtocol );
			$this->mTransport->open ();
		} catch ( TException $tx ) {
			echo "ThriftException: " . $tx->getMessage () . "\r\n";
		}
	}
	
	function __destruct() {
		$this->mTransport->close ();
	}
	
	public function cropImage($imagePath, $cropImagePath, $width, $height) {
		try {
			$this->mClient->cropImage ( $imagePath, $cropImagePath, $width, $height );
		} catch ( TException $tx ) {
			echo "ThriftException: " . $tx->getMessage () . "\r\n";
		}
	}
	
	private $mSocket;
	private $mTransport;
	private $mProtocol;
	private $mClient;
	const IMAGE_DAEMON_SERVER_NAME = 'localhost';
	const IMAGE_DAEMON_SERVER_PORT = '9992';
}

?>