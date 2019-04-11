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

        $sql    = "select mc_id,mc_type,dev_type,created_by,created_dt
                   from   md_mc_type";

        $result = mysqli_query($db,$sql);

?>

<html>
<head>
    <title>Manage Device Type</title>
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
        <h2 style="margin-left:60px;text-align:center">Manage Device Type</h2>
        <hr class="new">
        <div class="card mb-3">
            <div class="card-header" style="margin-left:60px;">
                <a class="button" href="../add/addMachine.php"><i class="fa fa-plus"></i>
                    <span>New</span>
                </a>
            </div>
            <hr class="new">
                <div class="card-body">
                    <div class="w3-responsive" style="margin-left:60px;">
                        <table id="dta" class="w3-table-all">
                            <thead>
                                <tr class="w3-light-grey">
                                    <th>Sl.No.</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php
                                    if($result){
                                        if(mysqli_num_rows($result) > 0){
                                            while($data = mysqli_fetch_assoc($result)){

                                                $slno       = $data['mc_id'];
                                                $type       = $data['dev_type'];

                                                if($type=='L'){
                                                    $devType = "Billing Machine";
                                                }elseif($type=='P'){
                                                    $devType = "Printer";
                                                }elseif($type=='B'){
                                                    $devType = "Banking & Others";
                                                }else{
                                                    $devType = "Others";
                                                }

                                                $name       = $data['mc_type']; 
                                ?>
                                <tr>
                                    <td><?php echo $slno; ?></td>
                                    <td><?php echo $devType; ?></td>
                                    <td><?php echo $name; ?></td>
                                    <td><a href="editMachine.php?mc_id=<?php echo$slno; ?>">
                                        <i class="fa fa-edit fa-2x" style="color: #57b846"></i>
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
                                    <th>Sl.No.</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Edit</th>
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