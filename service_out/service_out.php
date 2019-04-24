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

        $sql    = "select * from td_mc_trans 
                   where trans_type = 'S'
                   and   approval_status = 'U'
                   order by trans_dt,trans_cd,sl_no";

        $result = mysqli_query($db,$sql);

        
?>

<html>
<head>
    <title>Manage Service Out</title>
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
        <h2 style="margin-left:60px;text-align:center">Manage Service Out</h2>
        <hr class="new">
        <div class="card mb-3">
            <div class="card-header" style="margin-left:60px;">
                <!--<a class="button" href="../booking/addService.php"><i class="fa fa-plus"></i>
                    <span>New</span>
                </a>-->
            </div>

            <hr class="new">
                <div class="card-body">
                    <div class="w3-responsive" style="margin-left:60px;">
                        <table id="dta" class="w3-table-all">
                            <thead>
                                <tr class="w3-light-grey">
                                    <th>Date</th>
                                    <th>Ticket No.</th>
                                    <th>Center</th>
                                    <th>Serial No.</th>
                                    <th>Device Type</th>
                                    <th>Customer</th>
                                    <th>Edit</th>
                                    <!--<th>Delete</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                 <?php
                                    if($result){
                                        if(mysqli_num_rows($result) > 0){
                                            while($data = mysqli_fetch_assoc($result)){

                                                $date       = date('d/m/Y',strtotime($data['trans_dt']));
                                                $transNo    = $data['trans_cd'];
                                                $no         = $data['sl_no']; 



                                                $cust = $data['cust_cd'];

                                                 $cname = "select cust_cd,cust_name from md_customers
                                                           where cust_cd = $cust";

                                                 $cresult = mysqli_query($db,$cname);

                                                 $Name    = mysqli_fetch_assoc($cresult);

                                                 $cName   = $Name['cust_name'];

                                                $mcId        = $data['mc_type_id'];  

                                                 $mcname     = "select mc_type from md_mc_type 
                                                                where  mc_id = $mcId"; 

                                                 $mcresult   = mysqli_query($db,$mcname);

                                                 $name       = mysqli_fetch_assoc($mcresult);

                                                 $mcName    = $name['mc_type'];

                                                 $sc        = $data['srv_ctr'];

                                                 $sql1      = "select sl_no,center_name from md_service_centre 
                                                                where  sl_no = $sc"; 

                                                 $result1  = mysqli_query($db,$sql1);

                                                 $data1    = mysqli_fetch_assoc($result1);

                                                 $srv = $data1['center_name'];

                                ?>
                                <tr>
                                    <td><?php echo $date; ?></td>
                                    <td><?php echo $transNo; ?></td>
                                    <td><?php echo $srv; ?></td>
                                    <td ><?php echo $no; ?></td>
                                    <td><?php echo $mcName; ?></td>
                                    <td><?php echo $cName; ?></td>
        <td><a href="editService_out.php?trans_dt=<?php echo$data['trans_dt']; ?>&trans_cd=<?php echo $transNo;?>&sl_no=<?php echo $no;?>">
                                        <i class="fa fa-edit fa-2x" style="color: #57b846"></i>
                                        <a>
                                    </td>
                                  <!--  <td>
                                        <a href="javascript: void(0)" class="del" 
                                           id="<?php echo $data['trans_dt']; ?>" 
                                           id1 ="<?php echo $no; ?>" >
                                            <i class="fa fa-eraser fa-2x"style="color: #57b846"></i>
                                        </a>    
                                    </td>  -->
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
                                    <th>Center</th>
                                    <th>Serial No.</th>
                                    <th>Device Type</th>
                                    <th>Customer</th>
                                    <th>Edit</th>
                                    <!--<th>Delete</th>-->
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

                var transDt = $(this).attr('id');
                var transCd = $(this).attr('id1');

                window.location = "http://"+"<?php echo  $_SERVER['HTTP_HOST']; ?>"+"/service/booking/delServicein.php?trans_dt="+transDt+"&trans_cd="+transCd;

            }

        });
    } );
</script>    