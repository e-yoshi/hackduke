<?php

// CONNECT TO THE DATABASE
	$DB_NAME = 'hackdukedatabase';
	$DB_HOST = 'us-cdbr-azure-west-b.cleardb.com';
	$DB_USER = 'bcd4a2c313611e';
	$DB_PASS = '886d7131';
	
	$mysqli = @new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
	//Write student answer to database

	if ($mysqli->connect_error) {
		echo false;
		exit(1);
	}
    ?>