<?php

        require("../login/connect.php");
        require("../login/session.php");
        

        $sql = "DELETE FROM td_device_trans where trans_dt = '".$_GET['trans_dt']."'"."and trans_no= ".$_GET['trans_no'];

       

       $result = mysqli_query($db,$sql);

       $sql1= "DELETE FROM td_device_amc where trans_dt = '".$_GET['trans_dt']."'"."and trans_no= ".$_GET['trans_no'];

      
       $result1 = mysqli_query($db,$sql);

	   header('Location: deviceSale.php');

?>