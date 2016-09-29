<?php
	session_start();
	
	$server="localhost";
	$user="markos";
	$password=1234;
	$db_name="fileziller";
	$conn = mysqli_connect($server, $user, $password, $db_name);

	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
?>