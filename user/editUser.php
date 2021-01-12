<?php
    ini_set("display_errors",1);
    error_reporting(E_ALL);

    require("../login/connect.php");
    require("../login/session.php");
    //require("../dash/menu.php");

        if($_SERVER['REQUEST_METHOD']=="GET"){
            $userId     = $_GET['user_id'];

            $sql        = "select * from md_users where user_id = '$userId'";
            $result     = mysqli_query($db,$sql);
            $data       = mysqli_fetch_assoc($result);

            $userType   = $data['user_type'];
            $userName   = $data['user_name'];
            $userStatus = $data['user_status'];
        }

        if($_SERVER['REQUEST_METHOD']=="POST"){
            $userId     = checkInput($_POST['user_id']);
            $userName   = checkInput($_POST['user_name']);
            $userType   = checkInput($_POST['user_type']);
            $userStatus = checkInput($_POST['user_status']);
            $crtby      = $_SESSION['userId'];
            $crtdt      = date('Y-m-d h:i:s');

            $sql        = "update md_users
                           set    user_type    ='$userType',
                                  user_name    ='$userName',
                                  user_status  ='$userStatus',
                                  modified_by  ='$crtby',
                                  modified_dt  ='$crtdt'
                           where  user_id      ='$userId'";
                          
            $result   = mysqli_query($db,$sql);

            if($result){
                $_SESSION['flag'] = true;
                header("location:user.php");
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
    <title>Edit User</title>
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
            <h2 style="margin-left:60px;text-align:center">Edit User</h2>
            <hr class="new">

            <div class="card mb-3">

                <div class="card-body">

                    <div class="w3-responsive" style="margin-left:60px;">

                        <div class="wraper">

                            <div class="col-md-6 container form-wraper">

                                <form method="POST" id="form"
                                      action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >

                                    <div class="form-header">
                                        <h4>User Details</h4>
                                    </div>

                                    <div class="form-group row">
                                        <label for="user_id" class="col-sm-2 col-form-label">User ID:</label>

                                        <div class="col-sm-8">
                                            <input type="text"
                                                   name="user_id"
                                                   class="form-control required"
                                                   id="user_id"
                                                   value="<?php echo $userId; ?>"
                                                   readonly
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="user_name" class="col-sm-2 col-form-label">Name:</label>

                                        <div class="col-sm-8">
                                            <input type="text"
                                                   class= "form-control"
                                                   name = "user_name"
                                                   id   = "user_name"
                                                   value = "<?php echo $userName; ?>"
                                            />
                                        </div>
                                    </div> 

                                    <div class="form-group row">
                                        <label for="user_type" class="col-sm-2 col-form-label">User Type:</label>

                                        <div class="col-sm-8">
                                            <Select class="form-control required"
                                                    name ="user_type"
                                                    id="user_type">
                                                <option value="A"<?php echo($userType=='A')?'selected':'';?>>
                                                        Admin
                                                </option>
                                                <option value="G"<?php echo($userType=='S')?'selected':'';?>>
                                                        Stock
                                                </option>
                                                <option value="G"<?php echo($userType=='E')?'selected':'';?>>
                                                        Service
                                                </option>
                                            </Select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="user_status" class="col-sm-2 col-form-label">Status:</label>

                                        <div class="col-sm-8">
                                            <Select class="form-control required"
                                                    name ="user_status"
                                                    id="user_status">
                                                <option value="A"<?php echo($userStatus=='A')?'selected':'';?>>
                                                        Active
                                                </option>
                                                <option value="D"<?php echo($userStatus=='D')?'selected':'';?>>
                                                        Deactivate
                                                </option>
                                            </Select>
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

<?php
        require("../dash/footer.php");
?> 
