<?php
	$servername	= "localhost";
	$username	= "root";
	$password	= "teachers";
	$dbname		= "service";

	$db	= mysqli_connect($servername,$username,$password,$dbname);

	if(!$db){
		die("Failed To Connect To Database".mysqli_connect_error());
	}

?>
