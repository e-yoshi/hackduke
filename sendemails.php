<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include 'sendgrid-php/SendGrid_loader.php';

$sendgrid = new SendGrid('azure_0c3c5610525389e9875c7eda6e42678a@azure.com', '7rjwkvyt');
$mail = new SendGrid\Mail();
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
