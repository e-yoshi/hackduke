<?php 
// CONNECT TO THE DATABASE
	$DB_NAME = 'hackdukedatabase';
	$DB_HOST = 'us-cdbr-azure-west-b.cleardb.com';
	$DB_USER = 'bcd4a2c313611e';
	$DB_PASS = '886d7131';
	
	$mysqli = @new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
	//Write student answer to database

	if ($mysqli->connect_error) {
		printf("Connect failed: %s\n", $mysqli->connect_error);
		exit();
	}
	
	if(isset($_GET['ClassId'])&&isset($_GET['Response'])){
		$class_id = filter_var(@$_GET['ClassId'], FILTER_SANITIZE_NUMBER_INT);
		$std_resp = filter_var($_GET['Response'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
	} else {
		//Bad Request
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit(406);	
	}
	
	if(isset($_GET['Phone'])){
		//Comes from twillio
		$std_num = filter_var(@$_GET['Phone'], FILTER_SANITIZE_NUMBER_INT);
		$query = "INSERT INTO response (StudentId, ClassId, Response) SELECT student.StudentId, '{$class_id}', '{$std_resp}' FROM hackdukedatabase.student WHERE student.PhoneNumber = '{$std_num}'";

		$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
		
	} elseif (isset($_GET['Email'])){
		//SendGrid
		$std_email = filter_var(@$_GET['Email'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
		$query = "INSERT INTO response (StudentId, ClassId, Response) SELECT student.StudentId, '{$class_id}', '{$std_resp}' FROM hackdukedatabase.student WHERE student.Email = '{$std_email}'";
		$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

	} else{
		//Bad request
		exit(406);
	}	
	
	if($result==TRUE){
		exit(202);
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