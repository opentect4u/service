<?php
		ini_set("display_errors",1);
		error_reporting(E_ALL);

		require("../login/connect.php");
		require("../login/session.php");
		require("../dash/menu.php");

        if($_SERVER['REQUEST_METHOD']=="GET"){
            $trans_cd = $_GET['trans_cd'];
            $sl_no    = $_GET['sl_no'];

            $Insql    = "select * from td_mc_trans 
                         where trans_cd   = $trans_cd
                         and   sl_no      = '$sl_no'
                         and   trans_type = 'I'";


            $resultIn = mysqli_query($db,$Insql);

            if(mysqli_num_rows($resultIn)){
                $dataIn  = mysqli_fetch_assoc($resultIn);
                $dateIn  = $dataIn['trans_dt'];
                $cust_cd = $dataIn['cust_cd'];
                $mc_type = $dataIn['mc_type_id'];
                $mc_prob = $dataIn['mc_prob'];
                $srv_ctr = $dataIn['srv_ctr'];
                $status  = $dataIn['warr_status'];
                /*$sub_by  = $dataIn['cust_person'];
                $sub_ph  = $dataIn['cust_per_ph'];
                $rcv_by  = $dataIn['engg_invol'];*/

/////////////Customer Name
            $customer    = "select * from md_customers
                            where cust_cd = $cust_cd";

            $result1     = mysqli_query($db,$customer);

            $cust        = mysqli_fetch_assoc($result1);

/////////////Machine Type Name
            $machine    = "select * from md_mc_type
                           where mc_id = $mc_type";

            $result     = mysqli_query($db,$machine);

            $mc        = mysqli_fetch_assoc($result);

/////////////Machine Problem Name
            $problem    = "select * from md_problem
                           where sl_no = $mc_prob";

            $result     = mysqli_query($db,$problem);

            $prob       = mysqli_fetch_assoc($result);

/////////////Machine Problem Name
            $srv        = "select * from md_service_centre
                           where sl_no = $srv_ctr";

            $result     = mysqli_query($db,$srv);

            $srvName    = mysqli_fetch_assoc($result);

            }

    }
        /////////////
           /* $engg       = "select * from md_tech 
                           where emp_code = $tech";

            $result     = mysqli_query($db,$engg);

            $data       = mysqli_fetch_assoc($result);*/
?>		

<head>
    <title>Service Out</title>
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
            <h2 style="margin-left:60px;text-align:center">Service Out</h2>
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
                                        <label for="div_in_dt" class="col-sm-2 col-form-label">Device In Date:</label>

                                        <div class="col-sm-8">
                                            <input type="date"
                                                   name="div_in_dt"
                                                   class="form-control required"
                                                   id="div_in_dt"
                                                   value="<?php echo $dateIn; ?>"
                                                   readonly
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="trans_cd" class="col-sm-2 col-form-label">Ticket No.:</label>

                                        <div class="col-sm-8">
                                            <input type="text"
                                                   name="trans_cd"
                                                   class="form-control required"
                                                   id="trans_cd"
                                                   value="<?php echo $trans_cd; ?>"
                                                   readonly
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="sl_no" class="col-sm-2 col-form-label">Serial No.:</label>

                                        <div class="col-sm-8">
                                            <input type="text"
                                                   name="sl_no"
                                                   class="form-control required"
                                                   id="sl_no"
                                                   value="<?php echo $sl_no; ?>"
                                                   readonly
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
                                                    value="<?php echo $cust['cust_name']; ?>"
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
                                                    value="<?php echo $mc['mc_type'];?>"
                                                    readonly
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="mc_prob" class="col-sm-2 col-form-label">Problem Reported:</label>

                                        <div class="col-sm-8">
                                             <input type="text"
                                                   class= "form-control"
                                                   name = "mc_prob"
                                                   id   = "mc_prob"
                                                   value ="<?php echo $prob['problem_desc']; ?>"
                                                   readonly
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="mc_prob" class="col-sm-2 col-form-label">Service Center:</label>

                                        <div class="col-sm-8">
                                             <input type="text"
                                                   class= "form-control"
                                                   name = "srv_ctr"
                                                   id   = "srv_ctr"
                                                   value ="<?php echo $srvName['center_name']; ?>"
                                                   readonly
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="mc_prob" class="col-sm-2 col-form-label">Status:</label>

                                        <div class="col-sm-8">
                                             <input type="text"
                                                   class= "form-control"
                                                   name = "status"
                                                   id   = "status"
                                                   value ="<?php if($status=='O'){
                                                                    $sts = "Out of Warranty";
                                                                 }else{
                                                                    $sts = "In Warranty";    
                                                                 }
                                                                 echo $sts; 
                                                            ?>"
                                                   readonly
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="trans_dt" class="col-sm-2 col-form-label">Date:</label>

                                        <div class="col-sm-8">
                                            <input type="date"
                                                   name="trans_dt"
                                                   class="form-control required"
                                                   id="trans_dt"
                                                   value="<?php echo date('Y-m-d'); ?>"
                                                   readonly
                                            />
                                        </div>
                                    </div>

                                    

                                    

                                    

                                    

                                    

                                    <div class="form-group row">
                                        <label for="in_dt" class="col-sm-2 col-form-label">Service On:</label>

                                        <div class="col-sm-8">
                                            <input type="date"
                                                   class= "form-control"
                                                   name = "in_dt"
                                                   id   = "in_dt"
                                                   value="<?php echo $trans_dt; ?>"
                                                   readonly
                                            />
                                        </div>
                                    </div>

                                    

                                    

                                    <div class="form-group row">
                                        <label for="cust_person" class="col-sm-2 col-form-label">Technician:</label>

                                        <div class="col-sm-8">
                                            <input type="text"
                                                   class= "form-control"
                                                   name = "service_by"
                                                   id   = "service_by"
                                                   value ="<?php echo $data['tech_name']; ?>"
                                                   readonly
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="cust_person" class="col-sm-2 col-form-label">Delivered To:</label>

                                        <div class="col-sm-8">
                                            <input type="text"
                                                   class= "form-control"
                                                   name = "delv_to"
                                                   id   = "delv_to"
                                                   required
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="cust_person" class="col-sm-2 col-form-label">Phone No.:</label>

                                        <div class="col-sm-8">
                                            <input type="text"
                                                   class= "form-control"
                                                   name = "delv_ph"
                                                   id   = "delv_ph"
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="bill_no" class="col-sm-2 col-form-label">Bill No.:</label>

                                        <div class="col-sm-8">
                                            <input type="text"
                                                   class= "form-control"
                                                   name = "bill_no"
                                                   id   = "bill_no"
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="amount" class="col-sm-2 col-form-label">Amount:</label>

                                        <div class="col-sm-8">
                                            <input type="text"
                                                   class= "form-control"
                                                   name = "amount"
                                                   id   = "amount"
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

                                    <?php require("serviceTab_out.php");?>

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