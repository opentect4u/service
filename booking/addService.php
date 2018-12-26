<?php
		ini_set("display_errors",1);
		error_reporting(E_ALL);

		require("../login/connect.php");
		require("../login/session.php");
		//require("../dash/menu.php");

        if($_SERVER['REQUEST_METHOD']=="POST"){
            $transDt      = $_POST['trans_dt'];
            $mcSlNo       = $_POST['mc_sl_no'];
            $rkms         = $_POST['remarks'];
            $eng          = $_POST['service_by'];

            $max          = "select max(trans_dt)maxDt,max(trans_cd)maxCd 
                             from td_mc_status
                             where sl_no = $mcSlNo
                             and   status = 'I'";

            $maxResult    = mysqli_query($db,$max);            
            
            $maxdata      = mysqli_fetch_assoc($maxResult);

            $maxDt        = $maxdata['maxDt'];
            $maxNo        = $maxdata['maxCd'];



            $mcSelect     = "select * from td_mc_status 
                             where sl_no = $mcSlNo
                             and   trans_dt = '$maxDt'
                             and   trans_cd = $maxNo";

            $mcResult     = mysqli_query($db,$mcSelect);

            $row          = mysqli_fetch_assoc($mcResult);

            $cust         = $row['cust_cd'];
            $mcProb       = $row['mc_prob'];
            $Status       = $row['warr_status'];


            $mcStatus     = "Select * from td_mc_trans
                             where trans_dt = '$maxDt'
                             and   trans_cd = $maxNo
                             and   trans_type = 'I'";

            $statusResult =  mysqli_query($db,$mcStatus);

            $rowStatus    = mysqli_fetch_assoc($statusResult);

            $srvCtr       = $rowStatus['srv_ctr'];

            $parts         = implode('*/*',$_POST["comp_sl_no"]);
            $parts         = explode('*/*',$parts);

            $qty           = implode('*/*',$_POST["comp_qty"]);
            $qty           = explode('*/*',$qty);
            
            $crtby          = $_SESSION['userId'];
            $crtdt          = date('Y-m-d h:i:s');

            $select         = "select ifnull(max(trans_cd),0) + 1 trans_cd
                               from td_mc_service
                               where trans_dt = '$transDt'";

            $no             = mysqli_query($db,$select);

            $trans_no       = mysqli_fetch_assoc($no);

            $transNo        = $trans_no['trans_cd'];


            $sql            = "insert into td_mc_service(trans_dt,trans_cd,mc_sl_no,service_by,remarks,
                                                         in_dt,in_cd,created_by,created_dt)
                               values('$transDt',$transNo,'$mcSlNo','$eng','$rkms',
                                      '$maxDt',$maxNo,'$crtby','$crtdt')";

            $result         = mysqli_query($db,$sql);


            $insert         = "insert into td_mc_status(trans_dt,trans_cd,cust_cd,sl_no,mc_prob,warr_status,status)
                               values('$transDt',$transNo,$cust,'$mcSlNo','$mcProb','$Status','S')";

            $result1        = mysqli_query($db,$insert);


            for($i = 0; $i < sizeof($parts); $i++){

                $select     = "select ifnull(max(trans_no),0) + 1 trans_no
                               from td_parts_stock
                               where trans_dt = '$transDt'";

                $No         = mysqli_query($db,$select);

                $row        = mysqli_fetch_assoc($No);

                $transCd    = $row['trans_no'];

                $out        = "insert into td_parts_stock(trans_dt,trans_no,trans_type,bill_no,arrival_dt,comp_sl_no,
                                                         comp_qty,serv_ctr,remarks,created_by,created_dt)
                                                   values('$transDt',$transCd,'O','Out','$transDt',$parts[$i],$qty[$i],
                                                           $srvCtr,'$rkms','$crtby','$crtdt')";
              
                $result2       = mysqli_query($db,$out);

                if($result2){
                    $_SESSION['flag'] = true;
                    header("location:service.php");
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

        $select = "Select emp_code,tech_name from md_tech";
        $tech   = mysqli_query($db,$select);



?>		

<head>
    <title>New Device Service</title>
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
            <h2 style="margin-left:60px;text-align:center">Device Service</h2>
            <hr class="new">

            <div class="card mb-3">

                <div class="card-body">

                    <div class="w3-responsive" style="margin-left:60px;">

                        <div class="wraper">

                            <div class="col-md-6 container form-wraper">

                                <form method="POST" id="form"
                                      action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >

                                    <div class="form-header">
                                        <h4>Service Details</h4>
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
                                        <label for="mc_sl_no" class="col-sm-2 col-form-label">Serial No.:</label>

                                        <div class="col-sm-8">
                                            <input type="text"
                                                   name="mc_sl_no"
                                                   class="form-control required"
                                                   id="mc_sl_no"
                                                   required
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="cust_cd" class="col-sm-2 col-form-label">Customer:</label>

                                        <div class="col-sm-8">
                                            <input type="text"
                                                    name="cust_cd"
                                                    class="form-control required"
                                                    id="cust_cd"
                                                    readonly 
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="mc_type" class="col-sm-2 col-form-label">M/C Type:</label>

                                        <div class="col-sm-8">
                                             <input type="text"
                                                    name="mc_type"
                                                    class="form-control required"
                                                    id="mc_type"
                                                    readonly
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="in_dt" class="col-sm-2 col-form-label">Received On:</label>

                                        <div class="col-sm-8">
                                            <input type="text"
                                                   class= "form-control"
                                                   name = "in_dt"
                                                   id   = "in_dt"
                                                   readonly
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="mc_prob" class="col-sm-2 col-form-label">Problem:</label>

                                        <div class="col-sm-8">
                                             <input type="text"
                                                   class= "form-control"
                                                   name = "mc_prob"
                                                   id   = "mc_prob"
                                                   readonly
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="cust_person" class="col-sm-2 col-form-label">Technician:</label>

                                        <div class="col-sm-8">
                                            <Select class="form-control required"
                                                    name ="service_by"
                                                    id="service_by">
                                                <option value="">Select Technician</option>
                                                <?php

                                                    while($data = mysqli_fetch_assoc($tech)){
                                                        echo ("<option value=".$data['emp_code'].">".
                                                               $data['tech_name']."</option>");
                                                    }
                                                ?>    
                                            </Select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="remarks" class="col-sm-2 col-form-label">Remarks:</label>

                                        <div class="col-sm-8">
                                            <textarea type="text" class= "form-control" name = "remarks" id   = "remarks" required></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">

                                    <?php require("serviceTab.php");?>

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
