<?php
		require("../login/connect.php");
		session_start();

		$sl_no	= $_SESSION['sl_no'];
		$time	= date("Y-m-d h:i:s");

		$sql 	= "update td_audit_trail set logout = '$time'
				   where  sl_no = '$sl_no'";

		$result = mysqli_query($db,$sql);

		mysqli_close($db);

		if(session_destroy()){
			header("location:/service/index.php");
		}
?>
