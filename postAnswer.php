<?php 
	require_once ('db.php');
	
	if(isset($_GET['Response'])){
		$std_resp = filter_var($_GET['Response'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
	} else {
		//Bad Request
		printf("Connect failed: %s\n", mysqli_connect_error());
		http_status_code(406);
		exit(1);	
	}
	
	if(isset($_GET['Phone'])){
		//Comes from twillio
		$std_phone = filter_var(@$_GET['Phone'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
		$query = "SELECT student.StudentId FROM hackdukedatabase.student WHERE student.PhoneNumber='{$std_phone}'";
		$result = $mysqli->query($query) or die($mysqli->error.__LINE__);		
		$row = $result->fetch_row();
		$std_id = $row[0];
		var_dump($result);
		var_dump($std_id);

		$result->free();
	} elseif (isset($_GET['Email'])){
		//SendGrid
		$std_email = filter_var(@$_GET['Email'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
		$query = "SELECT student.StudentId FROM hackdukedatabase.student WHERE student.Email = '{$std_email}'";
		$result = $mysqli->query($query) or die($mysqli->error.__LINE__);		
		$row = $result->fetch_row();
		$std_id = $row[0];
		var_dump($std_id);
		$result->free();
	} else{
		//Bad request
		http_status_code(406);
		exit(1);
	}	
	$query = "INSERT INTO response (ClassId, StudentId, Response) SELECT classlog.ClassId, '{$std_id}', '{$std_resp}' WHERE classlog.StudentId = '{$std_id}' FROM hackdukedatabase.classlog ORDER BY TimeStarted DESC LIMIT 1";
	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	var_dump($result);
	if($result==TRUE){
		http_status_code(202);
		exit(1);
	}
	
	$result->free();
	// CLOSE CONNECTION
	$mysqli->close();		
?>