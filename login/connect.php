<?php
	$servername	= "localhost";
	$username	= "root";
	$password	= "";
	$dbname		= "service";

	/*$servername	= "localhost";
	$username	= "sbyqjbtvhe";
	$password	= "service_sss";
	$dbname		= "sbyqjbtvhe";*/

	$db	= mysqli_connect($servername,$username,$password,$dbname);

	if(!$db){
		die("Failed To Connect To Database".mysqli_connect_error());
	}

?>
