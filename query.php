<?php  
  
  	require_once ('db.php');

  // vars
  $queryType = @$_GET['Query'];

  // TestConnection: used by ppt plugin to see if can connect
  if ($queryType == 'TestConnection') {
    echo TRUE;
    exit(1);
  }

  // CreateQuestion: populates db with class info and sends texts/emails
  if($queryType == 'CreateQuestion') {
    $classId = @$_GET['ClassId'];
	$teacher_name = @$_GET['TeacherName'];
	$teacher_email = @$_GET['TeacherEmail'];
	$teacher_password= @$_GET['TeacherPassword'];
	
   	$quiz_title = @$_GET['Title'];
    $question = @$_GET['Question'];
	
	$query = "INSERT INTO quiz Title, Question, ClassId VALUES '{$quiz_title}', '{$question}', '{$classId}'";
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	if($result==TRUE){
		echo TRUE;
		http_status_code(202);
		exit(1);
	}
	
	$result->free();
	// CLOSE CONNECTION
	$mysqli->close();
  }

  // GetResponse: returns comma separated student responses
  if ($queryType == 'GetResponse') {

  }

  // GetClasses: returns comma separated class ids from teacher name
  if ($queryType == 'GetClasses') {
	$teacher_name = @$_GET['TeacherName'];
	$query = "SELECT class.ClassId FROM hackdukedatabase.class WHERE TeacherName='{$teacher_name}'";
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	if($result==TRUE){
		$rows = $result->fetch_array(MYSQLI_NUM);
		$str = implode (", ", $rows);
		echo $str;
		http_status_code(202);
		exit(1);
	}
	   
	$result->free();
	// CLOSE CONNECTION
	$mysqli->close();
	http_status_code(406);
	exit(1);
  }

  // GetStudents: returns comma separated student ids given a class id
  if ($queryType == 'GetStudents') {
	  
  }

  // SetClasses: takes in comma separated list of class ids and reconciles classes in class table with list
  if ($queryType == 'SetClasses') {

  }

  // SetStudents: takes in comma separated list of student ids and updates student list for given class id
  if ($queryType == 'SetStudents') {

  }
  
?>
