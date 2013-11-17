<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

$fh = fopen('/tmp/parse.log', 'a+');
if ( $fh )
{
	fwrite($fh, print_r($_POST, true) . print_r($_FILES, true));
	foreach ($_FILES as $key => $file)
	{
		move_uploaded_file($file['tmp_name'], "/tmp/".$file['name']);
	}
	fclose($fh);
}

echo "email parsed";


?>

