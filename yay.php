<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"https://api.sendgrid.com/api/mail.send.json");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            "postvar1=value1&postvar2=value2&postvar3=value3");

// in real life you should use something like:
// curl_setopt($ch, CURLOPT_POSTFIELDS, 
//          http_build_query(array('postvar1' => 'value1')));

// receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);

echo $server_output;

curl_close ($ch);

// further processing ....
if ($server_output == "OK") { ... } else { ... }

?>