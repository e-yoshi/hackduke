<?php

$fh = fopen('~/parse.log', 'a+');
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

