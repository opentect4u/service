<?php
        ini_set("display_errors",1);
        error_reporting(E_ALL);

        require("../login/connect.php");
        require("../login/session.php");
        //require("../dash/menu.php");

        if($_SERVER['REQUEST_METHOD']=="GET"){
            $slno   = $_GET['mc_id'];

            $sql    = "select mc_id,mc_type,dev_type from md_mc_type 
                       where  mc_id=".$slno;

         
            $result = mysqli_query($db,$sql);

            if($result){
                if(mysqli_num_rows($result) > 0){
                    $data = mysqli_fetch_assoc($result);

                    $slno = $data['mc_id'];
                    $name = $data['mc_type'];
                    $type = $data['dev_type'];
                }
            }
        }

        if($_SERVER['REQUEST_METHOD']=="POST"){
            $slno     = checkInput($_POST['mc_id']);
            $name     = checkInput($_POST['mc_type']);
            $type     = checkInput($_POST['dev_type']);
            $crtby    = $_SESSION['userId'];
            $crtdt    = date('Y-m-d h:i:s');

            $sql      = "Update md_mc_type 
                         set mc_type ="."'".$name."'".
                             ",dev_type="."'".$type."'".
                             ",modified_by="."'".$crtby."'".
                             ",modified_dt="."'".$crtdt."'".
                          "where mc_id=".$slno;

            $update   = mysqli_query($db,$sql);

            if($update){
                $_SESSION['flag'] = true;
                header("location:machine.php");
            }
        }

        function checkInput($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
        }
?>      

<head>
    <title>Edit Device Types</title>
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
            <h2 style="margin-left:60px;text-align:center">Edit Device Details</h2>
            <hr class="new">

            <div class="card mb-3">

                <div class="card-body">

                    <div class="w3-responsive" style="margin-left:60px;">

                        <div class="wraper">

                            <div class="col-md-6 container form-wraper">

                                <form method="POST" id="form"
                                      action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >

                                    <div class="form-header">
                                        <h4>Device Type</h4>
                                    </div>

                                    <div class="form-group row">
                                        <label for="mc_id" class="col-sm-2 col-form-label">Sl.No.:</label>

                                        <div class="col-sm-8">
                                            <input type="text"
                                                   name="mc_id"
                                                   class="form-control required"
                                                   id="mc_id"
                                                   value ="<?php echo $slno;?>"
                                                   readonly
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="dev_type" class="col-sm-2 col-form-label">
                                               Device Type:
                                        </label>

                                        <div class="col-sm-8">
                                            <select class="form-control required"
                                                    name ="dev_type" id="dev_type">
                                                <option value="">Select Device Type</option>
                                                <option value="B"<?php echo($type=="B")?'selected':'';?>>ETIM Banking & Others</option>
                                                <option value="L"<?php echo($type=="L")?'selected':'';?>>Billing Machine</option>
                                                <option value="P"<?php echo($type=="P")?'selected':'';?>>Printer</option>
                                                <option value="O"<?php echo($type=="O")?'selected':'';?>>Ohers</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="mc_type" class="col-sm-2 col-form-label">Device Name:</label>

                                        <div class="col-sm-8">
                                            <input type="text"
                                                   name="mc_type"
                                                   class="form-control required"
                                                   id="mc_type"
                                                   value ="<?php echo $name;?>"
                                                   required
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">

                                        <div class="col-sm-10">
                                            <input type="submit" 
                                                   class="subbtn" 
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