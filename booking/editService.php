<?php
		ini_set("display_errors",1);
		error_reporting(E_ALL);

		require("../login/connect.php");
		require("../login/session.php");
		require("../dash/menu.php");

        if($_SERVER['REQUEST_METHOD']=="GET"){
            $trans_dt = $_GET['trans_dt'];
            $trans_cd = $_GET['trans_cd'];
            $sl_no    = $_GET['sl_no'];

            $sql    = "select * from td_mc_trans 
                       where trans_dt = '$trans_dt' 
                       and   trans_cd =  $trans_cd
                       and   sl_no    =  '$sl_no'
                       and   trans_type = 'I'";


            $result = mysqli_query($db,$sql);

            $data   = mysqli_fetch_assoc($result);

            $cust_cd = $data['cust_cd'];
            $mc_type = $data['mc_type_id'];
            $mc_prob = $data['mc_prob'];
            $srv_ctr = $data['srv_ctr'];

            $customer    = "select * from md_customers
                            where cust_cd = $cust_cd";

            $result1     = mysqli_query($db,$customer);

            $cust        = mysqli_fetch_assoc($result1);

            $machine    = "select * from md_mc_type
                           where mc_id = $mc_type";

            $result     = mysqli_query($db,$machine);

            $mc        = mysqli_fetch_assoc($result);


            $problem    = "select * from md_problem
                           where sl_no = $mc_prob";

            $result     = mysqli_query($db,$problem);

            $prob        = mysqli_fetch_assoc($result);

        }

        if($_SERVER['REQUEST_METHOD']=="POST"){
            $transDt      = $_POST['trans_dt'];
            $transCd      = $_POST['trans_cd'];
            $slNo         = $_POST['sl_no'];
            $rcvDt        = $_POST['in_dt'];
            $srv          = $_POST['srv_ctr'];
            
            $sql    = "select * from td_mc_trans 
                       where trans_dt = '$rcvDt' 
                       and   trans_cd =  $transCd
                       and   sl_no    =  '$slNo'
                       and   trans_type = 'I'
                       and   approval_status = 'U'";

            $result = mysqli_query($db,$sql);

            $data   = mysqli_fetch_assoc($result);

            $custCd       = $data['cust_cd'];
            $trans        = 'S';
            $mcType       = $data['mc_type_id'];
            
            $prob         = $data['mc_prob'];
            $warr         = $data['warr_status'];
            //$srv          = $data['srv_ctr'];
            $cust         = $data['cust_person'];
            $ph           = $data['cust_per_ph'];
            $tech         = $_POST['service_by'];
            $rkms         = $_POST['remarks'];
             
            $crtby        = $_SESSION['userId'];
            $crtdt        = date('Y-m-d h:i:s');

            $sql          = "insert into td_mc_trans(trans_dt,
                                                     trans_cd,
                                                     cust_cd,
                                                     trans_type,
                                                     mc_type_id,
                                                     sl_no,
                                                     mc_prob,
                                                     warr_status,
                                                     mc_qty,
                                                     srv_ctr,
                                                     cust_person,
                                                     cust_per_ph,
                                                     engg_invol,
                                                     remarks,
                                                     approval_status,
                                                     created_by,
                                                     created_dt)
                                             values('$transDt',
                                                     $transCd,
                                                     $custCd,
                                                    '$trans',
                                                     $mcType,
                                                    '$slNo',
                                                     $prob,
                                                    '$warr',
                                                     0,
                                                     $srv,
                                                    '$cust',
                                                    '$ph',
                                                    '$tech',
                                                    '$rkms',
                                                    'U',
                                                    '$crtby',
                                                    '$crtdt')";

           // echo $sql;

            $result         = mysqli_query($db,$sql);

            $updt = "Update td_mc_trans
                     set    approval_status = 'A',
                            approved_by     = '$crtby',
                            approved_dt     = '$crtdt'
                     where  trans_dt        = '$rcvDt'
                     and    trans_cd        = $transCd
                     and    sl_no           = '$slNo'
                     and    trans_type      = 'I'
                     and    approval_status = 'U'";

            $result1       = mysqli_query($db,$updt);


            $parts         = implode('*/*',$_POST["comp_sl_no"]);
            $parts         = explode('*/*',$parts);

            $qty           = implode('*/*',$_POST["comp_qty"]);
            $qty           = explode('*/*',$qty);


            $trans_no     = "select ifnull(max(trans_no),0) + 1 trans_no
                               from td_parts_trans
                               where trans_dt = '$transDt'";

            $No         = mysqli_query($db,$trans_no);

            $row        = mysqli_fetch_assoc($No);

            $transNo    = $row['trans_no'];

            
if ($_POST["comp_sl_no"][0] > 0){

            for($i = 0; $i < sizeof($parts); $i++){

                $partSelect = "select sl_no,parts_desc from md_parts where sl_no  = $parts[$i]";
                   
                $partsData  = mysqli_query($db,$partSelect);

                $data       = mysqli_fetch_assoc($partsData);

                $partsDesc  = $data['parts_desc'];

                $out        = "insert into td_parts_trans(trans_dt,
                                                          trans_no,
                                                          trans_type,
                                                          bill_no,
                                                          arrival_dt,
                                                          comp_sl_no,
                                                          parts_desc,
                                                          comp_qty,
                                                          serv_ctr,
                                                          remarks,
                                                          sl_no,
                                                          created_by,
                                                          created_dt)
                                                   values('$transDt',
                                                           $transNo,
                                                           'O',
                                                           '$transCd',
                                                           '$transDt',
                                                           $parts[$i],
                                                           '$partsDesc',
                                                           -$qty[$i],
                                                            $srv,
                                                           '$rkms',
                                                           '$slNo', 
                                                           '$crtby',
                                                           '$crtdt')";
              
                $result2       = mysqli_query($db,$out);

            }
           } 

            if($result){
                    $_SESSION['flag'] = true;
                    header("location:service.php");
                }
            
        }

        function checkInput($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
        }


        $sql    = "select * from md_tech";
        $tech   = mysqli_query($db,$sql);

      

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
                                                   value="<?php echo date('Y-m-d'); ?>"
                                                   required
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
                                        <div class="col-sm-8">
                                             <input type="hidden"
                                                    name="srv_ctr"
                                                    class="form-control required"
                                                    id="srv_ctr"
                                                    value="<?php echo $srv_ctr;?>"
                                                    readonly
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="in_dt" class="col-sm-2 col-form-label">Received On:</label>

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
                                        <label for="mc_prob" class="col-sm-2 col-form-label">Problem:</label>

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
                                        <label for="mc_prob" class="col-sm-2 col-form-label">Status:</label>

                                        <div class="col-sm-8">
                                             <input type="text"
                                                   class= "form-control"
                                                   name = "status"
                                                   id   = "status"
                                                   value ="<?php if($data['warr_status']=='O'){
                                                                    $status = "Out of Warranty";
                                                                 }else{
                                                                    $status = "In Warranty";    
                                                                 }
                                                                 echo $status; 
                                                            ?>"
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