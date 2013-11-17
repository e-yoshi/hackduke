<?php 
	require_once ('db.php');
	
	if(isset($_GET['Response'])){
		$class_id = filter_var(@$_GET['ClassId'], FILTER_SANITIZE_NUMBER_INT);
		$std_resp = filter_var($_GET['Response'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
	} else {
		//Bad Request
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit(406);	
	}
	
	if(isset($_GET['Phone'])){
		//Comes from twillio
		$std_phone = filter_var(@$_GET['Phone'], FILTER_SANITIZE_NUMBER_INT);
		$query = "SELECT student.StudentId FROM hackdukedatabase.student WHERE student.PhoneNumber = '{$std_phone}'";
		$std_id = $mysqli->query($query) or die($mysqli->error.__LINE__);		
	} elseif (isset($_GET['Email'])){
		//SendGrid
		$std_email = filter_var(@$_GET['Email'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
		$query = "SELECT student.StudentId FROM hackdukedatabase.student WHERE student.Email = '{$std_email}'";
		$std_id = $mysqli->query($query) or die($mysqli->error.__LINE__);
	} else{
		//Bad request
		exit(406);
	}	
	$query = "INSERT INTO response (ClassId, StudentId, Response) SELECT classlog.ClassId, '{$std_id}', '{$std_resp}' WHERE classlog.StudentId = '{$std_id}' FROM hackdukedatabase.classlog ORDER BY TimeStarted DESC LIMIT 1";
		$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	
	if($result==TRUE){
		exit(202);
	}
	
	$result->free();
	// CLOSE CONNECTION
	$mysqli->close();		
?>