<?php

require "sendgrid-php/SendGrid_loader.php";
require "unirest-php-master/lib/Unirest.php";


error_reporting(E_ALL);
ini_set('display_errors', '1');

 $url = 'http://sendgrid.com/';
 $user = 'azure_0c3c5610525389e9875c7eda6e42678a@azure.com';
 $pass = '7rjwkvyt';

$classId = $_GET['ClassId'];

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
  $sendGrid = new SendGrid($user, $pass);
  $fromEmail = "inquizio@inquizio.bymail.in";
  foreach ($studentIdArray as $id) {
    echo "Getting email for student $id<br>";
    $email = mysqli_fetch_array(mysqli_query($mysqlCon, "SELECT Email FROM student WHERE StudentId=$id"))['Email'];
    $mailObj = new SendGrid\Mail();
    $mailObj->addTo($email)->setFrom($fromEmail)->setSubject("INQUIZIO: Response requested")->setText("Hello from Inquizio! Your instructor has requested a response from you; please reply to this email with the letter corresponding to your answer!");
    $mailObj->$smtp->send($mailObj);
    echo "Sent message to student $id at $email<br>";
  }

 
