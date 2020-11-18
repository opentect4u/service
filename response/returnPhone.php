<?php
		ini_set("display_errors",1);
		error_reporting(E_ALL);

		require("../login/connect.php");
		//require("../login/session.php");

        if($_SERVER['REQUEST_METHOD']=="GET"){
            $custId      = $_GET['cust_cd'];

            $sql         = "select cust_ph_no from md_customers where cust_cd = $custId";

            $result      = mysqli_query($db,$sql);

            $data        = mysqli_fetch_assoc($result);

            $phone       = $data['cust_ph_no'];

            echo $phone;
        }
?>