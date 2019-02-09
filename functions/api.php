<?php
include_once '../config.php';
include_once 'Database.php';

$dbParams = [
	'host'         => DB_HOST,
	'username'     => DB_USER,
	'password'     => DB_PASS,
	'databasename' => DB_DATABASE,
	'port'         => DB_PORT,
];

$db = new Database( $dbParams );

echo "<pre>";
print_r( $db );