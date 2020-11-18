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

       // $select1 = "select mc_id,mc_type from md_mc_type order by mc_type";

      //  $tech   = mysqli_query($db,$select1);
?>		

<head>
    <title>Warranty Status</title>
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
            <h2 style="margin-left:60px;text-align:center">Warranty Status</h2>
            <hr class="new">

            <div class="card mb-3">

                <div class="card-body">

                    <div class="w3-responsive" style="margin-left:60px;">

                        <div class="wraper">

                            <div class="col-md-6 container form-wraper">

                                <form method="POST" id="form"
                                      action="warranty_status.php" >

                                    <div class="form-header">
                                        <h4>Supply Serial No.</h4>
                                    </div>

                                   <!-- <div class="form-group row">
                                        <label for="mc_type" class="col-sm-2 col-form-label">Item:</label>

                                        <div class="col-sm-6">
                                            <Select class="form-control required"
                                                    name ="mc_type"
                                                    id="mc_type">
                                                <option value="">Select Item</option>
                                                <?php
                                                    /*while($data = mysqli_fetch_assoc($tech)){
                                                        echo ("<option value=".$data['mc_id'].">".
                                                               $data['mc_type']."</option>");
                                                    }*/
                                                ?>    
                                            </Select>
                                        </div>
                                    </div>-->

                                    <div class="form-group row">
                                        <label for="sl_no" class="col-sm-2 col-form-label">Serial No.:</label>

                                        <div class="col-sm-6">
                                            <input type="text"
                                                   name="sl_no"
                                                   class="form-control required"
                                                   id="sl_no"
                                                   required
                                            />
                                        </div>
                                    </div>

                                    

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

<script>
    $(document).ready(function(){
        $("#sl_no").on('change',function(){
            var sl_no = $("#sl_no").val();

            $.get("/service/others/checkSlNo.php",{sl_no:sl_no},function(data){

                if(data > 0){
                    $("#sl_no").css("border","1px solid #ccc");
                    $("#subbtn").attr("disabled",false);
                    return true;
                }else{
                    $("#sl_no").val('');
                    $("#sl_no").css("border","1px solid red");
                    alert("Invalid Serial No.");
                    $("#subbtn").attr("disabled",true);
                    return false;
                }
            });
        });

    });
</script>
