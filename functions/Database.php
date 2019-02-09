<?php

class Database {
	private $connection;
	private $host;
	private $username;
	private $password;
	private $databaseName;
	private $port;
	private $status_fatal;


	function __construct( $connectionParams = array() ) {
		$this->connection   = false;
		$this->host         = $connectionParams['host'];
		$this->username     = $connectionParams['username'];
		$this->password     = $connectionParams['password'];
		$this->databaseName = $connectionParams['databasename'];
		$this->port         = $connectionParams['port'];

		// Connect to Database
		$this->connect();
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

	function getOne( $query ) { // return only one row
		$cnx = $this->connection;
		if ( ! $cnx || $this->status_fatal ) {
			echo 'GetOne -> Connection failed';
			die();
		}

		$cur = @mysql_query( $query, $cnx );

		if ( $cur == false ) {
			$errorMessage = @pg_last_error( $cnx );
			$this->handleError( $query, $errorMessage );
		} else {
			$this->Error    = false;
			$this->BadQuery = "";
			$tmp            = mysql_fetch_array( $cur, MYSQL_ASSOC );

			$return = $tmp;
		}

		@mysql_free_result( $cur );

		return $return;
	}

	function getAll( $query ) { // getAll function: when you need to select more than 1 line in the database
		$cnx = $this->connection;
		if ( ! $cnx || $this->status_fatal ) {
			echo 'GetAll -> Connection failed';
			die();
		}

		mysql_query( "SET NAMES 'utf8'" );
		$cur    = mysql_query( $query );
		$return = array();

		while ( $data = mysql_fetch_assoc( $cur ) ) {
			array_push( $return, $data );
		}

		return $return;
	}

	function execute( $query, $use_slave = false ) { // execute function: to use INSERT or UPDATE
		$cnx = $this->conn;
		if ( ! $cnx || $this->status_fatal ) {
			return null;
		}

		$cur = @mysql_query( $query, $cnx );

		if ( $cur == false ) {
			$ErrorMessage = @mysql_last_error( $cnx );
			$this->handleError( $query, $ErrorMessage );
		} else {
			$this->Error    = false;
			$this->BadQuery = "";
			$this->NumRows  = mysql_affected_rows();

			return;
		}
		@mysql_free_result( $cur );
	}

	function handleError( $query, $str_erreur ) {
		$this->Error    = true;
		$this->BadQuery = $query;
		if ( $this->Debug ) {
			echo "Query : " . $query . "<br>";
			echo "Error : " . $str_erreur . "<br>";
		}
	}

}