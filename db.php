<?php

// CONNECT TO THE DATABASE
	$DB_NAME = 'hackdukedatabase';
	//$DB_HOST = 'us-cdbr-azure-west-b.cleardb.com';
	//$DB_USER = 'b95acf3e9baf04';
	//$DB_PASS = '3c5f9044';
	
	$DB_HOST = 'localhost';
	$DB_USER = 'root';
	$DB_PASS = 'donkey';

	$mysqli = @new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
	//Write student answer to database

	if ($mysqli->connect_error) {
		echo false;
		exit(1);
	}
?>