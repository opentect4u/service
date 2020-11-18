<?php
        ini_set("display_errors",1);
        error_reporting(E_ALL);

        require("../login/connect.php");
        require("../login/session.php");
        require("../dash/menu.php");

        function checkInput($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
        }

        $select = "select mc_id,mc_type from md_mc_type";
                   
        $device = mysqli_query($db,$select);

        /*$select1 = "select sl_no,parts_desc from md_parts";

        $parts   = mysqli_query($db,$select1);*/

        /*$select1 = "select sl_no,center_name from md_service_centre";
                   
        $serviceCenter = mysqli_query($db,$select1);*/
?>		

<head>
    <title>Device Ledger All Branch</title>
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
            <h2 style="margin-left:60px;text-align:center">Device Ledger All Branch</h2>
            <hr class="new">

            <div class="card mb-3">

                <div class="card-body">

                    <div class="w3-responsive" style="margin-left:60px;">

                        <div class="wraper">

                            <div class="col-md-6 container form-wraper">

                                <form method="POST" id="form"
                                      action="new_device_ledger_all.php" >

                                    <div class="form-header">
                                        <h4>Supply Date & Device</h4>
                                    </div>

                                    <div class="form-group row">
                                        <label for="from_dt" class="col-sm-2 col-form-label">From Date:</label>

                                        <div class="col-sm-6">
                                            <input type="date"
                                                   name="from_dt"
                                                   class="form-control required"
                                                   id="from_dt"
                                                   value=<?php echo date('Y-m-d'); ?>
                                                   required
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="to_dt" class="col-sm-2 col-form-label">To Date:</label>

                                        <div class="col-sm-6">
                                            <input type="date"
                                                   name="to_dt"
                                                   class="form-control required"
                                                   id="to_dt"
                                                   value=<?php echo date('Y-m-d'); ?>
                                                   required
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="parts_desc" class="col-sm-2 col-form-label">Device Name:</label>

                                        <div class="col-sm-6">
                                            <Select class="form-control required"
                                                    name ="device_desc"
                                                    id="device_desc">
                                                <option value="">Select Device</option>
                                                <?php

                                                    while($data = mysqli_fetch_assoc($device)){
                                                        echo ("<option value=".$data['mc_id'].">".
                                                               $data['mc_type']."</option>");
                                                    }
                                                ?>    
                                            </Select>
                                        </div>
                                    </div>

                                    <!--<div class="form-group row">
                                        <label for="serv_ctr" class="col-sm-2 col-form-label">Service Center:</label>

                                        <div class="col-sm-6">
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
                                    </div>-->

                                    <div class="form-group row">

                                    <div class="form-group row">

                                        <div class="col-sm-10">
                                            <input type="submit" 
                                                   class="subbtn"
                                                   style="margin-left: 25px;"
                                                   id = "subbtn"
                                                   value="Submit" />
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
