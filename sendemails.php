<?php
include 'path/to/sendgrid-php/SendGrid_loader.php';
$sendgrid = new SendGrid('username', 'password');
$mail = new SendGrid\Mail();
$mail->
  addTo('jcw46@duke.edu')->
  setFrom('xurui203@gmail.com')->
  setSubject('Payment')->
  setText('Here is your $20!')->
  setHtml('<strong>Here is your $20!</strong>');
$sendgrid->
web->
  send($mail);
?>
