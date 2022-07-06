<?php

	date_default_timezone_set('Asia/Karachi');

	define ("DB_HOST_NAME", "localhost");
	define ("DB_USER", "root");
	define ("DB_PASS", "pakistan");
	define ("DB_NAME", "gbobber");

	/*error_reporting(0);
	error_reporting(E_ALL);
	ini_set('display_errors', 1);*/

	$conn	=	new mysqli(DB_HOST_NAME, DB_USER, DB_PASS, DB_NAME, 3306);
	if ($conn -> connect_errno) {
	  echo "Failed to connect to MySQL: " . $conn -> connect_error;
	  exit();
	}


	require_once('includes/db.class.php');
	$db 			= 	new dvdb();

	$res = $db->get_row("select * from users order by id desc");

	print_r($res);
	





?>
