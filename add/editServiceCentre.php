<?php
        ini_set("display_errors",1);
        error_reporting(E_ALL);

        require("../login/connect.php");
        require("../login/session.php");
        //require("../dash/menu.php");

        if($_SERVER['REQUEST_METHOD']=="GET"){
            $slno   = $_GET['sl_no'];

            $sql    = "select sl_no,center_name,address,cnct_no,email,in_charge from md_service_centre
                       where  sl_no=".$slno;

         
            $result = mysqli_query($db,$sql);

            if($result){
                if(mysqli_num_rows($result) > 0){
                    $data = mysqli_fetch_assoc($result);

                    $slno   = $data['sl_no'];
                    $name   = $data['center_name'];
                    $adr    = $data['address'];
                    $phno   = $data['cnct_no'];
                    $email  = $data['email'];
                    $charge = $data['in_charge'];
                }
            }
        }

        if($_SERVER['REQUEST_METHOD']=="POST"){
            $slno     = checkInput($_POST['sl_no']);
            $name     = checkInput($_POST['center_name']);
            $adr      = checkInput($_POST['addr']);
            $phno     = checkInput($_POST['cnct_no']);
            $email    = checkInput($_POST['email']);
            $charge    = checkInput($_POST['in_charge']);

            $crtby    = $_SESSION['userId'];
            $crtdt    = date('Y-m-d h:i:s');

            $sql      = "Update md_service_centre
                         set center_name ="."'".$name  ."'".
                           ",address     ="."'".$adr   ."'".
                           ",cnct_no     ="."'".$phno  ."'".
                           ",email       ="."'".$email ."'".
                             ",in_charge="."'".$charge ."'".
                             ",modified_by="."'".$crtby."'".
                             ",modified_dt="."'".$crtdt."'".
                          "where sl_no=".$slno;

            $update   = mysqli_query($db,$sql);

            if($update){
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
?>      

<head>
    <title>Edit Service Center</title>
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
            <h2 style="margin-left:60px;text-align:center">Edit Service Center</h2>
            <hr class="new">

            <div class="card mb-3">

                <div class="card-body">

                    <div class="w3-responsive" style="margin-left:60px;">

                        <div class="wraper">

                            <div class="col-md-6 container form-wraper">

                                <form method="POST" id="form"
                                      action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >

                                    <div class="form-header">
                                        <h4>Service Center Details</h4>
                                    </div>

                                    <div class="form-group row">
                                        <label for="sl_no" class="col-sm-2 col-form-label">Sl.No.:</label>

                                        <div class="col-sm-8">
                                            <input type="text"
                                                   name="sl_no"
                                                   class="form-control required"
                                                   id="sl_no"
                                                   value ="<?php echo $slno;?>"
                                                   readonly
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="center_name" class="col-sm-2 col-form-label">
                                               Name:
                                        </label>

                                        <div class="col-sm-8">
                                            <input type="text"
                                                   name="center_name"
                                                   class="form-control required"
                                                   id="center_name"
                                                   value ="<?php echo $name;?>"
                                                   required
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">   
                                         <label for="cnct_no" class="col-sm-2 col-form-label">Phone No.:</label>

                                         <div class="col-sm-8">
                                            <input type="text"
                                                   class= "form-control"
                                                   name = "cnct_no"
                                                   id   = "cnct_no"
                                                   value ="<?php echo $phno;?>"
                                            />
                                        </div>
                                    </div> 

                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">Email:</label>

                                        <div class="col-sm-8">
                                            <input type="text"
                                                   class= "form-control"
                                                   name = "email"
                                                   id   = "email"
                                                   value ="<?php echo $email;?>"
                                            />
                                        </div>
                                    </div> 

                                    <div class="form-group row">
                                        <label for="in_charge" class="col-sm-2 col-form-label">In Charge</label>

                                        <div class="col-sm-8">
                                            <input type="text"
                                                   class= "form-control"
                                                   name = "in_charge"
                                                   id   = "in_charge"
                                                   value ="<?php echo $charge;?>"
                                            />
                                        </div>
                                    </div> 

                                    <div class="form-group row">    
                                        <label for="address" class="col-sm-2 col-form-label">
                                               Address:
                                        </label>

                                        <div class="col-sm-8">
                                            <textarea type="text"class= "form-control"name = "addr"id   = "addr"><?php echo $adr;?></textarea>
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