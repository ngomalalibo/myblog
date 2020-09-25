<?php
	$server = "mysql:host=68.66.226.77:3306;dbname=bestzoei_phpcms;charset=utf8";
	//	$server = "mysql:host=localhost;dbname=bestzoei_phpcms;charset=utf8";
	$user = "bestzoei_cms";
	$pass = "phpcms1234";
	$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false);
	$connection = new PDO($server, $user, $pass, $options);

?>