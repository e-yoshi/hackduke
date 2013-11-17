<?php
require "sendgrid-php/SendGrid_loader.php";
require "unirest-php-master/lib/Unirest.php";

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

 $url = 'http://sendgrid.com/';
 $user = 'azure_0c3c5610525389e9875c7eda6e42678a@azure.com';
 $pass = '7rjwkvyt';

 $params = array(
      'api_user' => $user,
      'api_key' => $pass,
      'to' => $from,
      'subject' => 'Notification',
      'html' => $messageResponse,
      'text' => $messageResponse,
      'from' => 'xurui203@gmail.com',
   );

 $request = $url.'api/mail.send.json';

 // Generate curl request
 $session = curl_init($request);

 // Tell curl to use HTTP POST
 curl_setopt ($session, CURLOPT_POST, true);

 // Tell curl that this is the body of the POST
 curl_setopt ($session, CURLOPT_POSTFIELDS, $params);

 // Tell curl not to return headers, but do return the response
 curl_setopt($session, CURLOPT_HEADER, false);
 curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

 // obtain response
 $response = curl_exec($session);
 curl_close($session);

 // print everything out
 print_r($response);
?>

