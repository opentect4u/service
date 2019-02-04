<?php
		ini_set("display_errors",1);
		error_reporting(E_ALL);

		require("../login/connect.php");
		require("../login/session.php");
		require("../dash/menu.php");

        if($_SERVER['REQUEST_METHOD']=="POST"){
            $transDt      = $_POST['trans_dt'];
            $cust         = $_POST['cust_cd'];
            $mcType       = $_POST['mc_type'];
            //$mcQty        = $_POST['mc_qty'];
            $serv         = $_POST['srv_ctr'];
            $subBy        = $_POST['cust_person'];
            $phone        = $_POST['cust_per_ph'];
            $rcvBy        = $_POST['engg_invol'];
            $rkms         = $_POST['remarks'];


            $mcProb         = implode('*/*',$_POST["prob"]);
            $mcProb         = explode('*/*',$mcProb);

            $slNo           = implode('*/*',$_POST["sl_no"]);
            $slNo           = explode('*/*',$slNo);

            //$slNo           = $_POST['sl_no'];

            $mcStatus       = implode('*/*',$_POST["status"]);
            $mcStatus       = explode('*/*',$mcStatus);
            
            $crtby          = $_SESSION['userId'];
            $crtdt          = date('Y-m-d h:i:s');

            $select         = "select ifnull(max(substr(trans_cd,5)),0) + 1 trans_no
                               from td_mc_trans
                               where year(trans_dt) = year(CURRENT_DATE);";

            $no             = mysqli_query($db,$select);

            $trans_no       = mysqli_fetch_assoc($no);

            $transNo        = $trans_no['trans_no'];

            $year           = date('Y');

            $transNo        = $year.$transNo;

            for($i = 0; $i < sizeof($slNo); $i++){

              $sql          = "insert into td_mc_trans(trans_dt,trans_cd,cust_cd,trans_type,mc_type_id,
                                                       sl_no,mc_prob,warr_status,mc_qty,srv_ctr,cust_person,
                                                       cust_per_ph,engg_invol,remarks,created_by,created_dt)
                               values('$transDt',$transNo,$cust,'I',$mcType,'$slNo[$i]','$mcProb[$i]','$mcStatus[$i]',0,
                                      $serv,'$subBy','$phone','$rcvBy','$rkms','$crtby','$crtdt')";

              $result       = mysqli_query($db,$sql);

                if($result){
                    $_SESSION['flag'] = true;
                    header("location:book.php");
                }

            }

        }

        function checkInput($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
        }

        $select = "select cust_cd,cust_name from md_customers";
        $cust   = mysqli_query($db,$select);

        $select = "Select mc_id,mc_type from md_mc_type";
        $mc     = mysqli_query($db,$select);

        $select = "Select sl_no,center_name from md_service_centre";
        $srv    = mysqli_query($db,$select);



?>		

<head>
    <title>New Device In</title>
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
            <h2 style="margin-left:60px;text-align:center">Device In</h2>
            <hr class="new">

            <div class="card mb-3">

                <div class="card-body">

                    <div class="w3-responsive" style="margin-left:60px;">

                        <div class="wraper">

                            <div class="col-md-6 container form-wraper">

                                <form method="POST" id="form"
                                      action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >

                                    <div class="form-header">
                                        <h4>In Details</h4>
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
                                        <label for="cust_cd" class="col-sm-2 col-form-label">Customer:</label>

                                        <div class="col-sm-8">
                                            <Select class="form-control required"
                                                    name ="cust_cd"
                                                    id="cust_cd">
                                                <option value="">Select Customer</option>
                                                <?php

                                                    while($data = mysqli_fetch_assoc($cust)){
                                                        echo ("<option value=".$data['cust_cd'].">".
                                                               $data['cust_name']."</option>");
                                                    }
                                                ?>    
                                            </Select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="mc_type" class="col-sm-2 col-form-label">M/C Type:</label>

                                        <div class="col-sm-8">
                                            <Select class="form-control required"
                                                    name ="mc_type"
                                                    id="mc_type">
                                                <option value="">Select Device</option>
                                                <?php

                                                    while($data = mysqli_fetch_assoc($mc)){
                                                        echo ("<option value=".$data['mc_id'].">".
                                                               $data['mc_type']."</option>");
                                                    }
                                                ?>    
                                            </Select>
                                        </div>
                                    </div>

                                    <!--<div class="form-group row">
                                        <label for="mc_qty" class="col-sm-2 col-form-label">Quantity:</label>

                                        <div class="col-sm-8">
                                            <input type="number"
                                                   class= "form-control"
                                                   name = "mc_qty"
                                                   id   = "mc_qty"
                                                   required
                                            />
                                        </div>
                                    </div>-->

                                    <div class="form-group row">
                                        <label for="srv_ctr" class="col-sm-2 col-form-label">Service Center:</label>

                                        <div class="col-sm-8">
                                            <Select class="form-control required"
                                                    name ="srv_ctr"
                                                    id="srv_ctr">
                                                <option value="">Select Service Center</option>
                                                <?php

                                                    while($data = mysqli_fetch_assoc($srv)){
                                                        echo ("<option value=".$data['sl_no'].">".
                                                               $data['center_name']."</option>");
                                                    }
                                                ?>    
                                            </Select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="cust_person" class="col-sm-2 col-form-label">Submited By:</label>

                                        <div class="col-sm-8">
                                            <input type="text"
                                                   class= "form-control"
                                                   name = "cust_person"
                                                   id   = "cust_person"
                                                   required
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="cust_per_ph" class="col-sm-2 col-form-label">Phone No.:</label>

                                        <div class="col-sm-8">
                                            <input type="text"
                                                   class= "form-control"
                                                   name = "cust_per_ph"
                                                   id   = "cust_per_ph"
                                                   required
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="engg_invol" class="col-sm-2 col-form-label">Received By:</label>

                                        <div class="col-sm-8">
                                            <input type="text"
                                                   class= "form-control"
                                                   name = "engg_invol"
                                                   id   = "engg_invol"
                                                   required
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="remarks" class="col-sm-2 col-form-label">Remarks:</label>

                                        <div class="col-sm-8">
                                            <textarea type="text" class= "form-control" name = "remarks" id   = "remarks" required></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">

                                    <?php require("slNotab.php");?>

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
