<?php
		ini_set("display_errors",1);
		error_reporting(E_ALL);

		require("../login/connect.php");
		require("../login/session.php");
		require("../dash/menu.php");

        if($_SERVER['REQUEST_METHOD']=="POST"){

            $transDt      = $_POST['trans_dt'];

            $billNo         = checkInput($_POST['bill_no']);
            $arvdt          = $_POST['trans_dt'];

            $comp           = implode('*/*',$_POST["comp_name"]);
            $comp           = explode('*/*',$comp);
            $compqty        = $_POST['c_qty'];
            $serv           = $_POST['srv_ctr'];
            $srvto          = $_POST['srv_to'];
            $trfmd          = $_POST['trf_mode'];
            $rkms           = $_POST['remarks'];
            $crtby          = $_SESSION['userId'];
            $crtdt          = date('Y-m-d h:i:s');

            for($i = 0; $i < sizeof($comp); $i++){

                 $select       = "select ifnull(max(trans_no),0) + 1 trans_no
                                  from td_parts_stock
                                  where trans_dt = '$transDt'";

                 $no          = mysqli_query($db,$select);

                 $trans_no     = mysqli_fetch_assoc($no);

                 $transNo      = $trans_no['trans_no']; 

                 $sql          = "insert into td_parts_stock(trans_dt,trans_no,trans_type,bill_no,arrival_dt,
                                  comp_sl_no,comp_qty,serv_ctr,srv_to,balance,trf_mode,remarks,created_by,created_dt)
                                  values('$transDt',$transNo,'T','$billNo','$arvdt',$comp[$i],$compqty[$i],
                                          $serv,$srvto,0,'$trfmd','$rkms','$crtby','$crtdt')";

                 $result       = mysqli_query($db,$sql);

                if($result){
                    $_SESSION['flag'] = true;
                    header("location:partsTrf.php");
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
        $serviceCenter1 = mysqli_query($db,$select);



?>		

<head>
    <title>Transfer Components</title>
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
            <h2 style="margin-left:60px;text-align:center">Transfer Components</h2>
            <hr class="new">

            <div class="card mb-3">

                <div class="card-body">

                    <div class="w3-responsive" style="margin-left:60px;">

                        <div class="wraper">

                            <div class="col-md-6 container form-wraper">

                                <form method="POST" id="form"
                                      action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >

                                    <div class="form-header">
                                        <h4>Transfer Details</h4>
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
                                        <label for="bill_no" class="col-sm-2 col-form-label">Transfer No.:</label>

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
                                         <label for="trf_mode" class="col-sm-2 col-form-label">Transfer Mode:</label>

                                         <div class="col-sm-8">
                                            <Select class="form-control required"
                                                   name  = "trf_mode"
                                                   id    = "trf_mode">
                                              <option value="C">Courier</option>
                                              <option value="T">Transport</option>
                                              <option value="M">Manual</option>
                                             </Select> 
                                        </div>
                                    </div> 


                                    <div class="form-group row">
                                        <label for="serv_ctr" class="col-sm-2 col-form-label">Service Center From:</label>

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
                                        <label for="srv_to" class="col-sm-2 col-form-label">Service Center To:</label>

                                        <div class="col-sm-8">
                                            <Select class="form-control required"
                                                    name ="srv_to"
                                                    id="srv_to">
                                                <option value="">Select Service Center</option>
                                                <?php

                                                    while($data1 = mysqli_fetch_assoc($serviceCenter1)){
                                                        echo ("<option value=".$data1['sl_no'].">".
                                                               $data1['center_name']."</option>");
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

                                    <?php require("partsIntab.php");
                                          ?>

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
