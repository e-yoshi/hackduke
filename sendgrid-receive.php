<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

  // db vars
  $dbHost = "us-cdbr-azure-west-b.cleardb.com";
  $dbUser = "bcd4a2c313611e";
  $dbPass = "886d7131";
  $dbName = "hackdukedatabase";

 // email vars
  $from = $_POST['from'];
  $body = $_POST['test'];
 
  // get student from db
  $mysqlCon = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
  if (mysqli_connect_errno($mysqlCon)) {
    $messageResponse = "Sorry, an error occurred in storing your response :(";
    exit("Error connecting to db");
  }
  $result = mysqli_query($mysqlCon, "SELECT StudentId FROM student WHERE Email=$from");
  if ($result == NULL) {
    exit("Received message from non-registered email");
  }
  
  $std_resp = filter_var($body, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
  $std_email = filter_var($from, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
  $query = "SELECT student.StudentId FROM hackdukedatabase.student WHERE student.Email='{$std_email}'";
  $result = mysqli_query($mysqlCon, $query);
  $rows = mysqli_fetch_array($result);
  $std_id = $rows[0];
  if (!is_null($std_id)) {
    $query = "INSERT INTO response (ClassId, StudentId, Response) SELECT classlog.ClassId, '{$std_id}', '{$std_resp}' FROM hackdukedatabase.classlog WHERE classlog.StudentId='{$std_id}' ORDER BY TimeStarted DESC LIMIT 1";
    $result = mysqli_query($mysqlCon, $query);
    if ($result == TRUE) {
      $messageResponse = "Successfully saved your response to the db! Response was: $body";
    } else {
      $messageResponse = "Could not update the db :(";
    }
  } else {
    $messageResponse = "Could not find student id for email";
  }	

?>

