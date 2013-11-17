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
	  $classId = @$_GET['ClassId'];
	$query = "SELECT response.Response, response.StudentId FROM hackdukedatabase.response WHERE ClassId ='{$classId}'";
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	if($result==TRUE){
		$rows = array();
		while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
			 array_push($rows, $row[1]);
			 array_push($rows, $row[0]);
		}
		$str = implode (",", $rows);
		echo $str;
		$result->free();
		// CLOSE CONNECTION
		$mysqli->close();
		http_status_code(202);
		exit(1);
		return;
	}
	   
	$result->free();
	// CLOSE CONNECTION
	$mysqli->close();
	http_status_code(406);
	exit(1);
  }

  // GetClasses: returns comma separated class ids from teacher name
  if ($queryType == 'GetClasses') {
	$teacher_name = @$_GET['TeacherName'];
	$query = "SELECT class.ClassId FROM hackdukedatabase.class WHERE TeacherName='{$teacher_name}'";
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	if($result==TRUE){
		$rows = array();
		while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
			 array_push($rows, $row[0]);
		}
		$str = implode (",", $rows);
		echo $str;
		http_status_code(202);
		$result->free();
	 	// CLOSE CONNECTION
	 	$mysqli->close();
		exit(1);
		return;
	}
	   
	$result->free();
	// CLOSE CONNECTION
	$mysqli->close();
	http_status_code(406);
	exit(1);
  }

  // GetStudents: returns comma separated student ids given a class id
  if ($queryType == 'GetStudents') {
	  $class_id = @$_GET['ClassId'];
	$query = "SELECT class.StudentIds FROM hackdukedatabase.class WHERE ClassId='{$class_id}'";
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	if($result==TRUE){
		$row = mysqli_fetch_array($result, MYSQLI_NUM);
		echo $row[0];
		http_status_code(202);
		$result->free();
	 	// CLOSE CONNECTION
	 	$mysqli->close();
		exit(1);
		return;
	}
	   
	$result->free();
	// CLOSE CONNECTION
	$mysqli->close();
	http_status_code(406);
	exit(1);
  }
  
  
  // GetStudents: returns comma separated student ids given a class id
  if ($queryType == 'GetStudentsWithNames') {	  
	   $class_id = @$_GET['ClassId'];
	$query = "SELECT class.StudentIds FROM hackdukedatabase.class WHERE ClassId='{$class_id}'";
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	if($result==TRUE){
		$row = mysqli_fetch_array($result, MYSQLI_NUM);
	} else {
		$result->free();
		// CLOSE CONNECTION
		$mysqli->close();
		http_status_code(406);
		exit(1);
		return;
	}
	   
	$result->free();	  
	$query = "SELECT student.StudentId, student.FirstName FROM hackdukedatabase.student WHERE student.StudentId IN ({$row[0]})";
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	if($result==TRUE){
		$rows = array();
		while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
			 array_push($rows, $row[0]);
			 array_push($rows, $row[1]);
		}
		$str = implode (",", $rows);
		echo $str;
		http_status_code(202);
	}
	   
	$result->free();
	// CLOSE CONNECTION
	$mysqli->close();
	http_status_code(406);
	exit(1);
  }
  
  if ($queryType == 'MakeStudent') {
	$std_first_name =  @$_GET['FirstName'];
	$std_last_name =  @$_GET['LastName'];
	$std_email =  @$_GET['Email'];
	$std_phone =  @$_GET['Phone'];
	$query = "INSERT INTO hackdukedatabase.student (FirstName, LastName, Email, PhoneNumber) VALUES ('{$std_first_name}', '{$std_last_name}', '{$std_email}', '{$std_phone}')";
   	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	if($result==TRUE){
		echo 'True';
		$result->free();
	 	// CLOSE CONNECTION
	 	$mysqli->close();
		exit(1);
		return;
	}
	   
	$result->free();
	// CLOSE CONNECTION
	$mysqli->close();
	http_status_code(406);
	exit(1);
  }
  
   // SetStudents: takes in comma separated list of student ids and updates student list for given class id
  if ($queryType == 'SetStudents') {
	$class_id = @$_GET['ClassId'];
	$std_list = @$_GET['List'];
	$query = "UPDATE hackdukedatabase.class SET class.StudentIds='{$std_list}' WHERE ClassId = '{$class_id}'";
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	if($result==TRUE){
		echo 'True';
		http_status_code(202);
	}
	   
	$result->free();
	// CLOSE CONNECTION
	$mysqli->close();
	http_status_code(406);
	exit(1);
  }

  // SetClasses: takes in comma separated list of class ids and reconciles classes in class table with list
  if ($queryType == 'SetClass') {
	$class_id = @$_GET['ClassId'];
	$teacher_name = @$_GET['TeacherName'];
	$teacher_email = @$_GET['TeacherEmail'];
	$teacher_password= @$_GET['TeacherPassword'];
	$query = "UPDATE hackdukedatabase.class SET TeacherName='{$teacher_name}', TeacherEmail='{$teacher_email}', TeacherPassword='{$teacher_password}' WHERE ClassId='{$class_id}'";
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	if($result==TRUE){
		echo 'True';
		$result->free();
	 	// CLOSE CONNECTION
	 	$mysqli->close();
		exit(1);
		return;
	}
	   
	$result->free();
	// CLOSE CONNECTION
	$mysqli->close();
	http_status_code(406);
	exit(1);

  }
  
  // MakeClass creates a class
  if ($queryType == 'MakeClass') {
	$class_id = @$_GET['ClassId'];
	$teacher_name = @$_GET['TeacherName'];
	$teacher_email = @$_GET['TeacherEmail'];
	$teacher_password= @$_GET['TeacherPassword'];
	$query = "INSERT INTO hackdukedatabase.class TeacherName, TeacherEmail, TeacherPassword VALUES '{$teacher_name}', '{$teacher_email}', '{$teacher_password}'";
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	if($result==TRUE){
		echo 'True';
		$result->free();
	 	// CLOSE CONNECTION
	 	$mysqli->close();
		exit(1);
		return;
	}
	   
	$result->free();
	// CLOSE CONNECTION
	$mysqli->close();
	http_status_code(406);
	exit(1);

  }
  
?>
