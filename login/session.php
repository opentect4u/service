<?php
	session_start();

	if(!isset($_SESSION['userId'])){
		header("location:index.php");
	}elseif((time() - $_SESSION['last_time'] > 1800)){
		header("location: ../login/time_out.html");
	}
?>
