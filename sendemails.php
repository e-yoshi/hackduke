<?php
include 'sendgrid-php/lib/SendGrid.php';
$sendgrid = new SendGrid('azure_0c3c5610525389e9875c7eda6e42678a@azure.com', '7rjwkvyt');
$mail = new SendGrid\Mail();
echo "new sendgrid mail created";
$mail->
  addTo('elder.yoshida@gmail.com')->
  setFrom('xurui203@gmail.com')->
  setSubject('Payment')->
  setText('Here is your $20!')->
  setHtml('<strong>Here is your $20!</strong>');
$sendgrid->web->
  send($mail);

echo "new sendgrid mail created";

?>
