<?php
		ini_set("display_errors",1);
		error_reporting(E_ALL);

		require("../login/connect.php");
		require("../login/session.php");
		//require("../dash/menu.php");

        if($_SERVER['REQUEST_METHOD']=="POST"){

            $transDt      = $_POST['trans_dt'];

            $billNo         = checkInput($_POST['bill_no']);
            $arvdt          = $_POST['trans_dt'];

            $mc             = implode('*/*',$_POST["dev_name"]);
            $mc             = explode('*/*',$mc);
            $mcqty          = $_POST['c_qty'];
            $slf            = $_POST['c_slfrm'];
            $slt            = $_POST['c_slto'];
            $serv           = $_POST['srv_ctr'];
            $ordby          = $_POST['order_by'];
            $rkms           = $_POST['remarks'];
            $crtby          = $_SESSION['userId'];
            $crtdt          = date('Y-m-d h:i:s');

            $select       = "select ifnull(max(trans_no),0) + 1 trans_no
                                  from td_device_trans
                                  where trans_dt = '$transDt'";

            $no           = mysqli_query($db,$select);

            $trans_no     = mysqli_fetch_assoc($no);

            $transNo      = $trans_no['trans_no']; 

            for($i = 0; $i < sizeof($mc); $i++){

                $select  = "select mc_id,mc_type from md_mc_type where mc_id = $mc[$i]";
                $result1 = mysqli_query($db,$select);
                $data    = mysqli_fetch_assoc($result1);
                $mname   = $data['mc_type'];

                 $sql          = "insert into td_device_trans(trans_dt,trans_no,trans_type,bill_no,arrival_dt,
                                  mc_type,mc_name,mc_qty,serv_ctr,oder_by,sl_no_from,sl_no_to,
                                  remarks,created_by,created_dt)
                                  values('$transDt',$transNo,'D','$billNo','$arvdt',$mc[$i],'$mname',-$mcqty[$i],
                                          $serv,'$ordby',$slf[$i],$slt[$i],'$rkms','$crtby','$crtdt')";

                 $result       = mysqli_query($db,$sql);
                 
                if($result){
                    $_SESSION['flag'] = true;
                    header("location:../device/device.php");
                }

            }

        }

        function checkInput($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
        }

        $select = "select sl_no,center_name from md_service_centre";
                   
        $serviceCenter = mysqli_query($db,$select);



?>		

<head>
    <title>Damage Devices</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.4/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.7/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--<link rel="stylesheet" href="../css/editor.dataTables.min.css">-->
    <!--<link rel="stylesheet" href="../css/sb-admin.css">-->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/button.css">
    <link rel="stylesheet" href="../form/css/sb-admin.css">
    <link rel="stylesheet" href="../form/css/select2.css">
    

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
    <!--<script src="../js/dataTables.editor.min.js"></script>-->
    <script src="../form/js/select2.js"></script>
    <script src="../form/js/validation.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<div style="min-height: 500px;">

    <div class="content-wrapper">

        <div class="container-fluid">
            <h2 style="margin-left:60px;text-align:center">Damage Devices</h2>
            <hr class="new">

            <div class="card mb-3">

                <div class="card-body">

                    <div class="w3-responsive" style="margin-left:60px;">

                        <div class="wraper">

                            <div class="col-md-6 container form-wraper">

                                <form method="POST" id="form"
                                      action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >

                                    <div class="form-header">
                                        <h4>Damage Details</h4>
                                    </div>

                                    <div class="form-group row">
                                        <label for="trans_dt" class="col-sm-2 col-form-label">Date:</label>

                                        <div class="col-sm-8">
                                            <input type="date"
                                                   name="trans_dt"
                                                   class="form-control required"
                                                   id="trans_dt"
                                                   value=<?php echo date('Y-m-d'); ?>
                                                   readonly
                                            />
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="bill_no" class="col-sm-2 col-form-label">Memo No.:</label>

                                        <div class="col-sm-8">
                                            <input type="text"
                                                   class= "form-control"
                                                   name = "bill_no"
                                                   id   = "bill_no"
                                                   required
                                            />
                                        </div>
                                    </div> 


                                    <div class="form-group row">   
                                         <label for="order_by" class="col-sm-2 col-form-label">Odered By:</label>

                                         <div class="col-sm-8">
                                            <input type="text"
                                                   class= "form-control"
                                                   name = "order_by"
                                                   id   = "order_by"
                                            />
                                        </div>
                                    </div> 


                                    <div class="form-group row">
                                        <label for="serv_ctr" class="col-sm-2 col-form-label">Service Center:</label>

                                        <div class="col-sm-8">
                                            <Select class="form-control required"
                                                    name ="srv_ctr"
                                                    id="srv_ctr">
                                                <option value="">Select Service Center</option>
                                                <?php

                                                    while($data = mysqli_fetch_assoc($serviceCenter)){
                                                        echo ("<option value=".$data['sl_no'].">".
                                                               $data['center_name']."</option>");
                                                    }
                                                ?>    
                                            </Select>
                                        </div>
                                    </div>

                                    <div class="form-group row">   
                                         <label for="remarks" class="col-sm-2 col-form-label">Remarks:</label>

                                         <div class="col-sm-8">
                                            <textarea type="text" class= "form-control" name = "remarks" id = "remarks" required></textarea>
                                        </div>
                                    </div> 

                                    <div class="form-group row">

                                    <?php require("../device/deviceIntab.php");?>

                                  </div>

                                    <div class="form-group row">

                                        <div class="col-sm-10">
                                            <input type="button" 
                                                   class="subbtn"
                                                   style="margin-left: 25px;"
                                                   id = "subbtn"
                                                   value="Save" />
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--<script>

    $("#form").validate();

    $(document).ready(function(){

        $('#emp_catg').change(function(){

            if($(this).val() == 1){

                $('.grade_pay').show();

            }
            else{

                $('.band_pey').text('Pay:');

                $('.grade_pey').hide();

            }

        });

    });

</script>-->

<?php
        require("../dash/footer.php");
?> 
