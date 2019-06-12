<?php
		ini_set("display_errors",1);
		error_reporting(E_ALL);

		require("../login/connect.php");
		require("../login/session.php");
		require("../dash/menu.php");

        if($_SERVER['REQUEST_METHOD']=="GET"){
            $transDt  = $_GET['trans_dt'];
            $transCd  = $_GET['trans_no'];

            $sql     = "Select * from td_parts_trans where trans_dt = '$transDt' and trans_no = $transCd";

            $result  = mysqli_query($db,$sql);

            $data    = mysqli_fetch_assoc($result);

            $saleDt  = $data['arrival_dt'];
            $invNo   = $data['bill_no'];
            $rkms    = $data['remarks'];
            $srvCtr  = $data['serv_ctr'];

            $result1  =  mysqli_query($db,$sql);
        }

        if($_SERVER['REQUEST_METHOD']=="POST"){

            $transDt      = $_POST['trans_dt'];
            $transCd      = $_POST['trans_cd'];

            $billNo       = checkInput($_POST['bill_no']);
            $rkms         = checkInput($_POST['remarks']);
            $slctr        = $_POST['sale_ctr'];

            $comp           = implode('*/*',$_POST["comp_name"]);
            $comp           = explode('*/*',$comp);
            $compqty        = $_POST['c_qty'];

            $crtby        = $_SESSION['userId'];
            $crtdt        = date('Y-m-d h:i:s');

            for($i = 0; $i < sizeof($comp); $i++){

                $update       = "update td_parts_trans
                                 set    bill_no         = '$billNo',
                                        comp_qty        = -$compqty[$i],
                                        serv_ctr        = $slctr,
                                        remarks         = '$rkms',
                                        modified_by     = '$crtby',
                                        modified_dt     = '$crtdt'
                                  where trans_dt        = '$transDt'
                                  and   trans_no        =  $transCd
                                  and   trans_type      =  'L'
                                  and   comp_sl_no      =  $comp[$i]"; 

                 echo $update;                  

            $result       = mysqli_query($db,$update);

             if($result){
                    $_SESSION['flag'] = true;
                    header("location:../stock/partsIn.php");
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
                   
        $serviceCenter  = mysqli_query($db,$select);
?>		

<head>
    <title>Edit Component Sale</title>
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
            <h2 style="margin-left:60px;text-align:center">Edit Component Sale</h2>
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
                                        <label for="trans_cd" class="col-sm-2 col-form-label">Transaction No.:</label>

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
                                        <label for="bill_no" class="col-sm-2 col-form-label">Bill No.:</label>

                                        <div class="col-sm-8">
                                            <input type="text"
                                                   class= "form-control"
                                                   name = "bill_no"
                                                   id   = "bill_no"
                                                   value = "<?php echo $invNo; ?>"
                                                   required
                                            />
                                        </div>
                                    </div> 

                                    <div class="form-group row">
                                        <label for="mc_type" class="col-sm-2 col-form-label">Service Center:</label>

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
                                         <label for="remarks" class="col-sm-2 col-form-label">Remarks:</label>

                                         <div class="col-sm-8">
                                            <textarea type="text" class= "form-control" name = "remarks" id = "remarks" required><?php echo $rkms; ?></textarea>
                                        </div>
                                    </div> 

                                    <div class="form-group row">

                                    <?php require("../stock/partsIntabEdit.php");?>

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