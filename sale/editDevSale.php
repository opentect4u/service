<?php
		ini_set("display_errors",1);
		error_reporting(E_ALL);

		require("../login/connect.php");
		require("../login/session.php");
		require("../dash/menu.php");


        if($_SERVER['REQUEST_METHOD']=="GET"){
            $transDt = $_GET['trans_dt'];
            $transNo = $_GET['trans_no'];

            $sql = "select * from td_device_trans where trans_dt = '$transDt' and trans_no = $transNo";

            $result = mysqli_query($db,$sql);

            $data   = mysqli_fetch_assoc($result);

            $saleDt = $data['arrival_dt'];
            $billNo = $data['bill_no'];
            $custCd = $data['cust_cd'];
            $mcType = $data['mc_type'];
            $verType = $data['mc_version'];
            $srvCtr  = $data['serv_ctr'];
            $mcQty   = ABS($data['mc_qty']);
            $warrPrd = $data['warranty_period'];
            $slFrm   = $data['sl_no_from'];
            $slTo    = $data['sl_no_to'];
            $rkms    = $data['remarks'];

            $sql1     = "select * from td_device_amc where trans_dt = '$transDt' and trans_no = $transNo";
            $result1  =  mysqli_query($db,$sql1);


        }

        if($_SERVER['REQUEST_METHOD']=="POST"){

            $transDt      = $_POST['trans_dt'];
            $saleDt       = $_POST['sale_dt'];
            $transNo      = $_POST['trans_no'];
            $invNo        = checkInput($_POST['bill_no']);
            $cust         = checkInput($_POST['cust_cd']);
            $mcType       = checkInput($_POST['mc_type']);
            $mcVer        = $_POST['mc_ver'];
            $mcQty        = $_POST['mc_qty'];
            $prd          = checkInput($_POST['warr_prd']);
            $slFrm        = $_POST['sl_frm'];
            $slTo         = $_POST['sl_to'];
            $rkms         = checkInput($_POST['remarks']);
            $slctr        = $_POST['sale_ctr'];

            if (!empty($_POST['c_sl'])){
                $devSl        = implode('*/*',$_POST['c_sl']); 
                $devSl        = explode('*/*',$devSl);
            }

            $crtby        = $_SESSION['userId'];
            $crtdt        = date('Y-m-d h:i:s');

            $amcDt        = date('Y-m-d', strtotime("+$prd months", strtotime($saleDt)));

            /*$select       = "select ifnull(max(trans_no),0) + 1 trans_no
                             from td_device_trans
                             where trans_dt = '$transDt'";

            $no           = mysqli_query($db,$select);

            $trans_no     = mysqli_fetch_assoc($no);

            $transNo      = $trans_no['trans_no']; */

            $select       = "select mc_id,mc_type from md_mc_type where mc_id = $mcType";
            $result1      = mysqli_query($db,$select);
            $data         = mysqli_fetch_assoc($result1);
            $mcName       = $data['mc_type'];


            /*$insert       = "insert into td_device_trans(trans_dt,trans_no,trans_type,bill_no,cust_cd,make,
                             arrival_dt,mc_type,mc_name,mc_version,mc_qty,serv_ctr,remarks,sl_no_from,
                             sl_no_to,warranty_period,created_by,created_dt)
                             values('$transDt',$transNo,'S','$invNo',$cust,'Power Craft','$saleDt',$mcType,
                                    '$mcName',$mcVer,-$mcQty,$slctr,'$rkms',$slFrm,$slTo,$prd,'$crtby','$crtdt')";*/

            $update       = "update td_device_trans
                             set    bill_no     = '$invNo',
                                    cust_cd     =  $cust,
                                    arrival_dt  = '$saleDt',
                                    mc_type     =  $mcType,
                                    mc_name     = '$mcName',
                                    mc_version  =  $mcVer,
                                    mc_qty      =  -$mcQty,
                                    serv_ctr    =  $slctr,
                                    remarks     =  '$rkms',
                                    sl_no_from  =  $slFrm,
                                    sl_no_to    =  $slTo,
                                    warranty_period = $prd,
                                    modified_by = '$crtby',
                                    modified_dt = '$crtdt'
                             where  trans_dt    = '$transDt'
                             and    trans_no    = $transNo";

            $result       = mysqli_query($db,$update);

            /*if($slFrm > 0){

                while($slFrm <= $slTo){

                    $rangeIn = "insert into td_device_amc(trans_dt,trans_no,trans_type,mc_type,sl_no,amc_from,amc_to)
                                               values('$transDt',$transNo,'S',$mcType,$slFrm,'$saleDt','$amcDt')";

                    $result1 = mysqli_query($db,$rangeIn);

                    $slFrm ++;
                }
            }    */

            /*for($i = 0; $i < sizeof($devSl); $i++){

                $sql = "insert into td_device_amc(trans_dt,trans_no,trans_type,mc_type,sl_no,amc_from,amc_to)
                                           values('$transDt',$transNo,'S',$mcType,$devSl[$i],'$saleDt','$amcDt')";

                $result2 = mysqli_query($db,$sql);
            }*/


             if($result){
                    $_SESSION['flag'] = true;
                    header("location:deviceSale.php");
                }
                exit();

        }

        function checkInput($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
        }

        $select = "select sl_no,center_name from md_service_centre";
                   
        $serviceCenter  = mysqli_query($db,$select);
        

        $select = "select cust_cd,cust_name from md_customers";
        $cust   = mysqli_query($db,$select);

        $sql    = "select mc_id,mc_type,dev_type from md_mc_type";
        $mc     = mysqli_query($db,$sql);

        $sql1   = "select sl_no,mc_type,version_name from md_version";
        $ver    = mysqli_query($db,$sql1); 



?>		

<head>
    <title>Edit Device Sale</title>
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
            <h2 style="margin-left:60px;text-align:center">Edit Device Sale</h2>
            <hr class="new">

            <div class="card mb-3">

                <div class="card-body">

                    <div class="w3-responsive" style="margin-left:60px;">

                        <div class="wraper">

                            <div class="col-md-6 container form-wraper">

                                <form method="POST" id="form"
                                      action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >

                                    <div class="form-header">
                                        <h4>Sale Details</h4>
                                    </div>

                                    <div class="form-group row">
                                        <label for="trans_dt" class="col-sm-2 col-form-label">Date:</label>

                                        <div class="col-sm-8">
                                            <input type="date"
                                                   name="trans_dt"
                                                   class="form-control required"
                                                   id="trans_dt"
                                                   value=<?php echo $transDt; ?>
                                                   readonly
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="trans_no" class="col-sm-2 col-form-label">Trans No.:</label>

                                        <div class="col-sm-8">
                                            <input type="text"
                                                   name="trans_no"
                                                   class="form-control required"
                                                   id="trans_no"
                                                   value=<?php echo $transNo; ?>
                                                   readonly
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="sale_dt" class="col-sm-2 col-form-label">Sale Date:</label>

                                        <div class="col-sm-8">
                                            <input type="date"
                                                   name="sale_dt"
                                                   class="form-control required"
                                                   id="trans_dt"
                                                   value=<?php echo $saleDt; ?>
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="bill_no" class="col-sm-2 col-form-label">Invoice No.:</label>

                                        <div class="col-sm-8">
                                            <input type="text"
                                                   class= "form-control"
                                                   name = "bill_no"
                                                   id   = "bill_no"
                                                   value =<?php echo $billNo;?>
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

                                                    while($data = mysqli_fetch_assoc($cust)){ ?>

                                                        <option value='<?php echo $data['cust_cd'];?>'
                                                                <?php echo($custCd==$data['cust_cd'])?'selected':'';?>>
                                                                 <?php echo $data['cust_name']; ?>
                                                        </option>);
                                                <?php
                                                    }
                                                ?>    
                                                   
                                            </Select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="mc_type" class="col-sm-2 col-form-label">Item:</label>

                                        <div class="col-sm-8">
                                            <Select class="form-control required"
                                                    name ="mc_type"
                                                    id="mc_type">
                                                <option value="">Select Item</option>
                                                <?php

                                                    while($data = mysqli_fetch_assoc($mc)){ ?>

                                                        <option value='<?php echo $data['mc_id'];?>'
                                                                <?php echo($mcType==$data['mc_id'])?'selected':'';?>>
                                                                 <?php echo $data['mc_type']; ?>
                                                        </option>);

                                                <?php        
                                                    }
                                                ?>    
                                            </Select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="mc_ver" class="col-sm-2 col-form-label">Version:</label>

                                        <div class="col-sm-8">
                                            <Select class="form-control required"
                                                    name ="mc_ver"
                                                    id="mc_ver">
                                                <option value="">Select Version</option>
                                                <?php

                                                    while($data = mysqli_fetch_assoc($ver)){ ?>

                                                        <option value='<?php echo $data['sl_no'];?>'
                                                                <?php echo($verType==$data['sl_no'])?'selected':'';?>>
                                                                 <?php echo $data['version_name']; ?>
                                                        </option>);

                                                <?php    
                                                    }
                                                ?>    
                                            </Select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="mc_type" class="col-sm-2 col-form-label">Sale Center:</label>

                                        <div class="col-sm-8">
                                            <Select class="form-control required"
                                                    name ="sale_ctr"
                                                    id="sale_ctr">
                                                <option value="">Select Center</option>
                                                <?php

                                                    while($data = mysqli_fetch_assoc($serviceCenter)){ ?>

                                                        <option value='<?php echo $data['sl_no'];?>'
                                                                <?php echo($srvCtr==$data['sl_no'])?'selected':'';?>>
                                                                 <?php echo $data['center_name']; ?>
                                                        </option>);
                                                <?php        
                                                    }
                                                ?>    
                                            </Select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="mc_qty" class="col-sm-2 col-form-label">Quantity:</label>

                                        <div class="col-sm-8">
                                            <input type="number"
                                                   class= "form-control"
                                                   name = "mc_qty"
                                                   id   = "mc_qty"
                                                   value = <?php echo $mcQty; ?>
                                                   required
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="warr_prd" class="col-sm-2 col-form-label">Warranty Period:</label>

                                        <div class="col-sm-8">
                                            <input type="text"
                                                   class= "form-control"
                                                   name = "warr_prd"
                                                   id   = "warr_prd"
                                                   placeholder="(In Months)"
                                                   value = <?php echo $warrPrd; ?>
                                                   required
                                            />
                                        </div>
                                    </div> 

                                    <div class="form-group row">
                                        <label for="sl_frm" class="col-sm-2 col-form-label">Sl.No.From:</label>

                                        <div class="col-sm-8">
                                            <input type="text"
                                                   class= "form-control"
                                                   name = "sl_frm"
                                                   id   = "sl_frm"
                                                   value = <?php echo $slFrm; ?>
                                                   readonly
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="sl_to" class="col-sm-2 col-form-label">Sl.No.To:</label>

                                        <div class="col-sm-8">
                                            <input type="text"
                                                   class= "form-control"
                                                   name = "sl_to"
                                                   id   = "sl_to"
                                                   value = <?php echo $slTo; ?>
                                                   readonly
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">   
                                         <label for="remarks" class="col-sm-2 col-form-label">Remarks:</label>

                                         <div class="col-sm-8">
                                            <textarea type="text" class= "form-control" name = "remarks" id = "remarks" required><?php echo $rkms; ?></textarea>
                                        </div>
                                    </div> 

                                    <div class="form-group row">

                                    <?php require("../sale/slnotabedit.php");?>

                                  </div>
                                  
                                    <div class="form-group row">

                                        <div class="col-sm-10">
                                            <input type="submit" 
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