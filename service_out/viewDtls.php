<?php
	
	require("../login/connect.php");
	require("../login/session.php");

	$sql = "select * from td_parts_trans
        	where bill_no = ".$_GET['tktNo']."
        	and   sl_no   = ".$_GET['mcSlNo']."";

    $result = mysqli_query($db, $sql);
    $res['parts_desc'] = $res['comp_qty'] = NULL;

    $i = 0;

	while($data = mysqli_fetch_assoc($result)){
		$res['parts_desc'][$i] = $data['parts_desc'];
		$res['comp_qty'][$i] = abs($data['comp_qty']);
		$i++;
	}

    echo json_encode($res);

?>