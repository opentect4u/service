<?php

    require("../login/connect.php");

    $sl_no = $_GET['sl_no'];

    //$sl_no = '939066355';

    $select =   "select count(*)countSl from td_device_amc where sl_no = '$sl_no'";

    

    $result = mysqli_query($db,$select);

    

    $data   = mysqli_fetch_assoc($result);

    $sl_no = $data['countSl'];

    echo $sl_no;
?>