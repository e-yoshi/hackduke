<?php

ini_set('display_errors', E_ALL);
error_reporting(E_ALL);  
  // get POST params
  $classId = $_GET['ClassId'];
  echo "Class id is $classId";
  echo "<br>";

  // require the twilio php library 
  require "twilio-php-master/Services/Twilio.php";

  // create twilio client
  $AccountSid = "AC3d59d01368bbc628721a869c0404786b";
  $AuthToken = "07284eb8cf827621a327022ba0bd47b4";
  $client = new Services_Twilio($AccountSid, $AuthToken);
  
  // connect to mysql db
  $dbHost = "us-cdbr-azure-west-b.cleardb.com";
  $dbUser = "bcd4a2c313611e";
  $dbPass = "886d7131";
  $dbName = "hackdukedatabase";
  $mysqlCon = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

  // check connection
  if (mysqli_connect_errno($mysqlCon)) {
    exit("Failed to connect to db\n");
  }

  // make query
  $studentIds = mysqli_fetch_array(mysqli_query($mysqlCon, "SELECT StudentId FROM class WHERE ClassId=$classId"));
  if ($studentIds == NULL) {
    exit("Class not found");
  }
  $studentIdArray = explode(",", $studentIds['StudentId']);

  // send text messages
  $twilioPhone = "919-666-3358";
  foreach ($studentIdArray as $id) {
    echo "Getting phone for student $id<br>";
    $phone = mysqli_fetch_array(mysqli_query($mysqlCon, "SELECT PhoneNumber FROM student WHERE StudentId=$id"));
    $sms = $client->account->messages->sendMessage($twilioPhone, $phone, "Hello from Inquizio! Your instructor has requested a response; please reply to this text with the letter corresponding to your answer!");
    echo "Sent message to student $id at $phone['PhoneNumber']<br>";
  }

