<?php

        require("../login/connect.php");
        require("../login/session.php");
        

        $sql    = "DELETE FROM td_device_trans where bill_no = '".$_GET['bill_no']."'";

        $result = mysqli_query($db,$sql);

		header('Location: device.php');

?>