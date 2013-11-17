<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

  // require the twilio php library 
  require "twilio-php-master/Services/Twilio.php";

  // create twilio client
  $AccountSid = "AC3d59d01368bbc628721a869c0404786b";
  $AuthToken = "07284eb8cf827621a327022ba0bd47b4";
  $client = new Services_Twilio($AccountSid, $AuthToken);

$from = $_POST['from'];
$to = $_POST['to'];
$subject = $_POST['subject'];
$body = $_POST['text'];

  $twilioPhone = "919-666-3358";
$phone = "9198109361";    
$sms = $client->account->messages->sendMessage($twilioPhone, $phone, "From: $from; To: $to; Subject: $subject; Body: $body");

?>

