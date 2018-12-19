<?php

        require("../login/connect.php");
        require("../login/session.php");
        

        $sql    = "DELETE FROM td_mc_trans where trans_dt = '".$_GET['trans_dt']."' and trans_cd = ".$_GET['trans_cd']."";

        $result = mysqli_query($db,$sql);

        $del    = "DELETE FROM td_mc_status where trans_dt = '".$_GET['trans_dt']."' and trans_cd = ".$_GET['trans_cd']."";

        $result1 = mysqli_query($db,$del);

		header('Location: book.php');

?>
