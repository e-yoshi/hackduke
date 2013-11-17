<?php 
// CONNECT TO THE DATABASE
	$DB_NAME = 'hackdukedatabase';
	$DB_HOST = 'us-cdbr-azure-west-b.cleardb.com';
	$DB_USER = 'bcd4a2c313611e';
	$DB_PASS = '886d7131';
	
	$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
	//Write student answer to database

	if ($mysqli->connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	
	if(isset($_POST['ClassId'])&&isset($_POST['Response'])){
		$class_id = filter_var(@$_POST['ClassId'], FILTER_SANITIZE_NUMBER_INT);
		$std_resp = filter_var($_POST['Response'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
	} else {
		//Bad Request
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit(406);	
	}
	
	if(isset($_POST['Phone'])){
		//Comes from twillio
		$std_num = filter_var(@$_POST['Phone'], FILTER_SANITIZE_NUMBER_INT);
		$query = "INSERT INTO response (ClassId, StudentId, Response) SELECT {$class_id}, student.StudentId, {$std_resp} FROM student WHERE student.PhoneNumber = {$std_num}";

		
	} elseif (isset($_POST['Email'])){
		//SendGrid
		$std_email = filter_var(@$_POST['Email'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
		$query = "INSERT INTO response (ClassId, StudentId, Response) SELECT {$class_id}, student.StudentId, {$std_resp} FROM student WHERE student.Email = {$std_email}";
	} else{
		//Bad request
		exit(406);
	}	
	
/*
// A QUICK QUERY ON A FAKE USER TABLE
	$query = "SELECT * FROM `users` WHERE `status`='bonkers'";
	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

// GOING THROUGH THE DATA
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo stripslashes($row['username']);	
		}
	}
	else {
		echo 'NO RESULTS';	
	}
	*/
	
	// CLOSE CONNECTION
	$mysqli->close();
		
?>