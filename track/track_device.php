<?php
        ini_set("display_errors",1);
        error_reporting(E_ALL);

        require("../login/connect.php");
        require("../login/session.php");
        require("../dash/menu.php");

       if($_SERVER['REQUEST_METHOD']=="POST"){

            $sl_no  =   $_POST['sl_no'];

            $sql    = "select * from td_mc_trans where sl_no = '$sl_no' and trans_type='I'";
                        
            $result = mysqli_query($db,$sql);
        }
?>

<html>
<head>
    <title>Track Device</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.4/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.7/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="../css/editor.dataTables.min.css">
    <link rel="stylesheet" href="../css/sb-admin.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/button.css">
    

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
    <script src="../js/dataTables.editor.min.js"></script>
</head>
<body>
<div style="min-height: 500px;">
<div class="content-wrapper">
    <div class="container-fluid">
        <h2 style="margin-left:60px;text-align:center">Track Device</h2>
        <hr class="new">
        <div class="card mb-3">
            <div class="card-header" style="margin-left:60px;"></div>
            <hr class="new">
                <div class="card-body">
                    <div class="w3-responsive" style="margin-left:60px;">
                        <table id="dta" class="w3-table-all">
                            <thead>
                                <tr class="w3-light-grey">
                                    <th>Date</th>
                                    <th>Ticket No.</th>
                                    <th>Service Center</th>
                                    <th>View Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php
                                    if($result){
                                        if(mysqli_num_rows($result) > 0){
                                            while($data = mysqli_fetch_assoc($result)){
                                                $date   = $data['trans_dt'];    
                                                $tktno  = $data['trans_cd'];
                                                $srv    = $data['srv_ctr'];

                                                $select = "select sl_no,center_name from md_service_centre
                                                           where sl_no = $srv";

                                                $result1 = mysqli_query($db,$select);
                                                $row     = mysqli_fetch_assoc($result1);
                                                $srv_ctr = $row['center_name'];       
                                ?>
                                <tr>
                                    <td><?php echo date('d/m/Y',strtotime($date));?></td>
                                    <td><?php echo $tktno;?></td>
                                    <td><?php echo $srv_ctr; ?></td>
                                    <td><a href="device_history.php?trans_cd=<?php echo $tktno;?>&sl_no=<?php echo $sl_no; ?>">
                                        <i class="fa fa-eye fa-2x" style="color: #57b846"></i>
                                        <a>
                                    </td>
                                      
                                </tr>
                                <?php
                                            }
                                        }
                                    }    
                                ?> 
                            </tbody>    
                            <tfoot>
                                <tr>
                                    <th>Date</th>
                                    <th>Ticket No.</th>
                                    <th>Service Center</th>
                                    <th>View Details</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</div>
</div>
</body>

<script>
    $(document).ready(function() {
        $('#dta').DataTable();
    } );
</script>    