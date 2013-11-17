<?php  
  
  $queryType = $_POST['Query'];

  if ($queryType == 'TestConnection') {
    echo TRUE;
  }

  if($_POST['Query']=='CreateQuestion') {
    $teacher_name = filter_var($_GET['TeacherName'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
    $teacher_password = filter_var($_GET['Password'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
			
    filter_var(@$_GET['ClassId'], FILTER_SANITIZE_NUMBER_INT);

  }
?>
