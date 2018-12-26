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

        $sql    = "select distinct trans_dt,bill_no,arrival_dt,serv_ctr
                   from   td_parts_trans 
                   where trans_dt = current_date 
                   and trans_type = 'I' ";

        $result = mysqli_query($db,$sql);

?>

<html>
<head>
    <title>Manage Component In</title>
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
        <h2 style="margin-left:60px;text-align:center">Manage Component In</h2>
        <hr class="new">
        <div class="card mb-3">
            <div class="card-header" style="margin-left:60px;">
                <a class="button" href="../stock/addPartsIn.php"><i class="fa fa-plus"></i>
                    <span>New</span>
                </a>
            </div>
            <hr class="new">
                <div class="card-body">
                    <div class="w3-responsive" style="margin-left:60px;">
                        <table id="dta" class="w3-table-all">
                            <thead>
                                <tr class="w3-light-grey">
                                    <th>Date</th>
                                    <th>Bill No.</th>
                                    <th>Arrival Date</th>
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

                                                $date = date('d/m/Y',strtotime($data['trans_dt']));
                                                $bill = $data['bill_no']; 
                                                $ardt = date('d/m/Y',strtotime($data['arrival_dt']));
                                                $srvc = $data['serv_ctr'];  

                                                 $scname     = "select center_name from md_service_centre 
                                                               where sl_no =$srvc"; 

                                                 $scresult   = mysqli_query($db,$scname);

                                                 $name       = mysqli_fetch_assoc($scresult);

                                                 $srvName    = $name['center_name']; 

                                ?>
                                <tr>
                                    <td><?php echo $date; ?></td>
                                    <td><?php echo $bill; ?></td>
                                    <td><?php echo $ardt; ?></td>
                                    <td><?php echo $srvName; ?></td>
                                    <td><a href="editPartsIn.php?bill_no=<?php echo$bill; ?>">
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
                                    <th>Bill No.</th>
                                    <th>Arrival Date</th>
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
<?php
        require("../dash/footer.php");
?> 

<script>
    $(document).ready(function() {
        $('#dta').DataTable();

        $('.del').click(function(){

            if(window.confirm('Are you sure you want to delete this record?')){

                var delCd = $(this).attr('id');

                window.location = "http://"+"<?php echo  $_SERVER['HTTP_HOST']; ?>"+"/service/stock/delParts.php?bill_no="+delCd;

            }

        });
    } );
</script>    