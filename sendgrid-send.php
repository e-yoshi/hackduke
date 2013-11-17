<?php

require "sendgrid-php/SendGrid_loader.php";
require "unirest-php-master/lib/Unirest.php";


error_reporting(E_ALL);
ini_set('display_errors', '1');

 $url = 'http://sendgrid.com/';
 $user = 'azure_0c3c5610525389e9875c7eda6e42678a@azure.com';
 $pass = '7rjwkvyt';


$to = array(
      'xurui203@gmail.com',
      'jcw46@duke.edu',
	  'elder.yoshida@gmail.com'
 );
 
 foreach ($to as $address){
	  
 $params = array(
      'api_user' => $user,
      'api_key' => $pass,
      'to' => $address,
	  'subject' => 'First round test',
      'html' => 'hihihi',
      'text' => 'hihihi',
      'from' => 'anything@xurui203.bymail.in',
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
 }