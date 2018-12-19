<?php
		ini_set("display_errors",1);
		error_reporting(E_ALL);

		require("../login/connect.php");
		require("../login/session.php");
		require("../dash/menu.php");

        if($_SERVER['REQUEST_METHOD']=="GET"){
            $transDt  = $_GET['trans_dt'];
            $transCd  = $_GET['trans_cd'];

            $sql     = "Select * from td_mc_trans where trans_dt = '$transDt' and trans_cd = $transCd";
            
            $result  = mysqli_query($db,$sql);

            $data    = mysqli_fetch_assoc($result);

            $custCd  = $data['cust_cd'];
            $mcType  = $data['mc_type_id'];
            $srvCtr  = $data['srv_ctr'];
            $qty     = $data['mc_qty'];
            $submt   = $data['cust_person'];
            $subph   = $data['cust_per_ph'];
            $rcvby   = $data['engg_invol'];
            $rkms    = $data['remarks'];

            $mcSql    = "Select * from td_mc_status where trans_dt='$transDt' and trans_cd=$transCd";

            $mcresult = mysqli_query($db,$mcSql);
        }

        if($_SERVER['REQUEST_METHOD']=="POST"){
            $transDt      = $_POST['trans_dt'];
            $transNo      = $_POST['trans_cd'];
            $cust         = $_POST['cust_cd'];

            $mcType       = $_POST['mc_type'];
            $mcQty        = $_POST['mc_qty'];
            $serv         = $_POST['srv_ctr'];
            $subBy        = $_POST['cust_person'];
            $phone        = $_POST['cust_per_ph'];
            $rcvBy        = $_POST['engg_invol'];
            $rkms         = $_POST['remarks'];


            $mcProb         = implode('*/*',$_POST["prob"]);
            $mcProb         = explode('*/*',$mcProb);

            $slNo           = $_POST['sl_no'];

            $mcStatus       = $_POST['status'];
            
            $crtby          = $_SESSION['userId'];
            $crtdt          = date('Y-m-d h:i:s');

           
            $sql            = "update td_mc_trans
                               set cust_cd      =  $cust,
                                   mc_type_id   =  $mcType,
                                   mc_qty       =  $mcQty,
                                   srv_ctr      =  $serv,
                                   cust_person  =  '$subBy',
                                   cust_per_ph  =  '$phone',
                                   engg_invol   =  '$rcvBy',
                                   remarks      =  '$rkms',
                                   modified_by  =  '$crtby',
                                   modified_dt  =  '$crtdt'
                            where  trans_dt     =  '$transDt'      
                            and    trans_cd     =  $transNo";
                             
            $result         = mysqli_query($db,$sql);

            for($i = 0; $i < sizeof($slNo); $i++){

              $update       = "update td_mc_status
                               set mc_prob     = '$mcProb[$i]',
                                   warr_status = '$mcStatus[$i]'
                               where trans_dt     =  '$transDt'
                               and    trans_cd     =  $transNo
                               and    sl_no        =  $slNo[$i]"; 

              echo $update;
                                
              $result1       = mysqli_query($db,$update);

                if($result1){
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
    <title>Edit Service In</title>
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
            <h2 style="margin-left:60px;text-align:center">Edit Service In</h2>
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
                                                   value=<?php echo $transDt; ?>
                                                   readonly
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="trans_dt" class="col-sm-2 col-form-label">Transaction No.:</label>

                                        <div class="col-sm-8">
                                            <input type="text"
                                                   name="trans_cd"
                                                   class="form-control required"
                                                   id="trans_cd"
                                                   value=<?php echo $transCd; ?>
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
                                        <label for="mc_type" class="col-sm-2 col-form-label">M/C Type:</label>

                                        <div class="col-sm-8">
                                            <Select class="form-control required"
                                                    name ="mc_type"
                                                    id="mc_type">
                                                <option value="">Select Device</option>
                                                <?php

                                                    while($data = mysqli_fetch_assoc($mc)){ ?>
                                                        <option value='<?php echo $data['mc_id']; ?>'
                                                          <?php echo($mcType==$data['mc_id'])?'selected':'';?>>
                                                          <?php echo $data['mc_type'] ?>
                                                        </option>
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
                                                   value = <?php echo $qty; ?>
                                                   required
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="srv_ctr" class="col-sm-2 col-form-label">Service Center:</label>

                                        <div class="col-sm-8">
                                            <Select class="form-control required"
                                                    name ="srv_ctr"
                                                    id="srv_ctr">
                                                <option value="">Select Service Center</option>
                                                <?php
                                                    while($data = mysqli_fetch_assoc($srv)){  ?>
                                                      <option value='<?php echo $data['sl_no']; ?>'
                                                          <?php echo($srvCtr==$data['sl_no'])?'selected':'';?>>
                                                          <?php echo $data['center_name']; ?>
                                                      </option>

                                                <?php    
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
                                                   value = <?php echo $submt; ?>
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
                                                   value = <?php echo $subph; ?>
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
                                                   value = <?php echo $rcvby; ?>
                                                   required
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="remarks" class="col-sm-2 col-form-label">Remarks:</label>

                                        <div class="col-sm-8">
                                            <textarea type="text" class= "form-control" name = "remarks" id   = "remarks" required><?php echo $rkms; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">

                                    <?php require("editSlnoTab.php");?>

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

<?php
        require("../dash/footer.php");
?> 
