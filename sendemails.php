<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include 'unirest-php-master/lib/Unirest.php';
include 'sendgrid-php/lib/SendGrid.php';
SendGrid::register_autoloader();

$sendgrid = new SendGrid('azure_0c3c5610525389e9875c7eda6e42678a@azure.com', '7rjwkvyt');
$mail = new SendGrid\Email();
echo "new sendgrid mail created";
$mail->
  addTo('xurui203@gmail.com')->
  setFrom('xurui203@gmail.com')->
  setSubject('Payment')->
  setText('Here is your $20!')->
  setHtml('<strong>Here is your $20!</strong>');
$sendgrid->web->
  send($mail);

echo "new sendgrid mail created";

?>
