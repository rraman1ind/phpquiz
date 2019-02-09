<?php

include_once '../config.php';

class Database {
	private $connection;
	private $host;
	private $username;
	private $password;
	private $databaseName;
	private $port;
	private $status_fatal;


	function __construct() {
		$this->connection   = false;
		$this->host         = DB_HOST;
		$this->username     = DB_USER;
		$this->password     = DB_PASS;
		$this->databaseName = DB_DATABASE;
		$this->port         = DB_PORT;
	}

	// Close connection
	function __destruct() {
		$this->disconnect();
	}

	function connect() {

		if ( ! $this->connection ) {
			try {
				$this->connection = new PDO( 'mysql:host=' . $this->host . ';dbname=' . $this->databaseName . '', $this->username, $this->password, array( PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' ) );
			} catch ( Exception $e ) {
				die( 'Error : ' . $e->getMessage() );
			}

			if ( ! $this->connection ) {
				$this->status_fatal = true;
				echo 'Connection to DBB failed';
				die();
			} else {
				$this->status_fatal = false;
			}
		}

		return $this->connection;
	}

	function disconnect() {
		if ( $this->connection ) {
			$this->connection = null;
		}
	}

}