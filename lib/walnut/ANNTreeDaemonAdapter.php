<?php
require_once $GLOBALS ['THRIFT_ROOT'] . 'Thrift.php';
require_once $GLOBALS ['THRIFT_ROOT'] . 'protocol/TBinaryProtocol.php';
require_once $GLOBALS ['THRIFT_ROOT'] . 'transport/TSocket.php';
require_once $GLOBALS ['THRIFT_ROOT'] . 'transport/TBufferedTransport.php';
require_once $GLOBALS ['THRIFT_ROOT'] . 'transport/TFramedTransport.php';
require_once $GLOBALS ['THRIFT_ROOT'] . 'packages/ANNTreeDaemon/ANNTreeDaemon.php';
class ANNTreeDaemonAdapter {
	
	function __construct() {
		try {
			$this->mSocket = new TSocket ( self::ANNTREE_DAEMON_SERVER_NAME, self::ANNTREE_DAEMON_SERVER_PORT );
			$this->mSocket->setRecvTimeout ( 20000 );
			$this->mTransport = new TFramedTransport ( $this->mSocket );
			$this->mProtocol = new TBinaryProtocol ( $this->mTransport );
			$this->mClient = new ANNTreeDaemonClient ( $this->mProtocol );
			$this->mTransport->open ();
		} catch ( TException $tx ) {
		}
	}
	
	function __destruct() {
		$this->mTransport->close ();
	}
	
	public function query($imagePath, $treeIndex, $featureType, $k) {
		try {
			return $this->mClient->query ( $imagePath, $treeIndex, $featureType, $k );
		} catch ( TException $tx ) {
		}
	}
	
	private $mSocket;
	private $mTransport;
	private $mProtocol;
	private $mClient;
	const ANNTREE_DAEMON_SERVER_NAME = 'node1';
	const ANNTREE_DAEMON_SERVER_PORT = '9999';
}

?>