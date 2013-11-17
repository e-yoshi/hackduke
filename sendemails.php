<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require 'sendgrid-php/SendGrid_loader.php';

$sendgrid = new SendGrid('azure_0c3c5610525389e9875c7eda6e42678a@azure.com', '7rjwkvyt');
$mail = new SendGrid\Mail();
echo "new sendgrid mail created";
$mail->
  addTo('xurui203@gmail.com')->
  addTo('nick@sendgrid.com')->
  setFrom('xurui203@gmail.com')->
  setSubject('Payment')->
  setText('Here is your $20!')->
  setHtml('<strong>Here is your $20!</strong>');
$work = $sendgrid->web->send($mail);

print_r($work);

echo "new sendgrid mail created";

?>
