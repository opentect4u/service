<?php
        ini_set("display_errors",1);
        error_reporting(E_ALL);

        require("../login/connect.php");
        require("../login/session.php");
        require("../dash/menu.php");

       if($_SESSION['flag']==true){
            echo "<script>alert('Save Successful')</script>";
            $_SESSION['flag']=false;
        }

        $sql    = "select distinct trans_dt,trans_no,bill_no,arrival_dt,serv_ctr,trans_type
                   from   td_device_trans 
                   where  approval_status = 'U'
                   and    trans_dt = CURDATE()
                   and trans_type In ('I','T','D') 
                   order by trans_dt";

        $result = mysqli_query($db,$sql);

?>

<html>
<head>
    <title>Manage Devices</title>
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
        <h2 style="margin-left:60px;text-align:center">Manage Devices</h2>
        <hr class="new">
        <div class="card mb-3">
            <div class="card-header" style="margin-left:60px;">
                <a class="button" href="../device/addDeviceIn.php"><i class="fa fa-plus"></i>
                    <span>Purchase</span>
                </a>
                &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                <a class="button" href="../transfer/addDeviceTrf.php"><i class="fa fa-plus"></i>
                    <span>Transfer</span>
                </a>
                &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                <a class="button" href="../damage/addDeviceDamage.php"><i class="fa fa-plus"></i>
                    <span>Damage</span>
                </a>
            </div>
            <hr class="new">
                <div class="card-body">
                    <div class="w3-responsive" style="margin-left:60px;">
                        <table id="dta" class="w3-table-all">
                            <thead>
                                <tr class="w3-light-grey">
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>No.</th>
                                    <th>Service Center</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php
                                    if($result){
                                        if(mysqli_num_rows($result) > 0){
                                            while($data = mysqli_fetch_assoc($result)){

                                                $date   = date('d/m/Y',strtotime($data['trans_dt']));

                                                $bill   = $data['bill_no']; 

                                                $transNo= $data['trans_no'];
                                                
                                                $type   = $data['trans_type'];

                                                if($type=='I'){
                                                   $typeDesc = "Purchase";
                                                   $path     = "editDevIn.php";     
                                                }elseif($type=='T'){
                                                   $typeDesc = "Transfer"; 
                                                   $path     = "../transfer/editDevTrf.php";
                                                }else{
                                                    $typeDesc = "Damage";
                                                    $path     = "../damage/editDeviceDamage.php";
                                                }
                                                
                                                $srvc   = $data['serv_ctr'];  
                                                $scname = "select center_name from md_service_centre 
                                                               where sl_no =$srvc"; 
                                                $scresult   = mysqli_query($db,$scname);
                                                $name       = mysqli_fetch_assoc($scresult);
                                                $srvName    = $name['center_name'];
                                ?>
                                <tr>
                                    <td><?php echo $date; ?></td>
                                    <td><?php echo $typeDesc; ?></td>
                                    <td><?php echo $bill; ?></td>
                                    <td><?php echo $srvName; ?></td>
                                    <td><a href="<?php echo $path; ?>?trans_dt=<?php echo$data['trans_dt'];?>&trans_no=<?php echo$transNo; ?>">
                                        <i class="fa fa-edit fa-2x" style="color: #57b846"></i>
                                        <a>
                                    </td>
                                    <td>
                                        <a href="javascript: void(0)" class="del" id="<?php echo $bill; ?>">
                                            <i class="fa fa-eraser fa-2x"style="color: #57b846"></i>
                                        </a>    
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
                                    <th>Type</th>
                                    <th>Bill No.</th>
                                    <th>Service Center</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
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

        $('.del').click(function(){

            if(window.confirm('Are you sure you want to delete this record?')){

                var delCd = $(this).attr('id');

                window.location = "http://"+"<?php echo  $_SERVER['HTTP_HOST']; ?>"+"/service/device/delDev.php?bill_no="+delCd;

            }

        });
    } );
</script>    