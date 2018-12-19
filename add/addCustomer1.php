<?php
		ini_set("display_errors",1);
		error_reporting(E_ALL);

		require("../login/connect.php");
		require("../login/session.php");
		require("../dash/menu.php");
?>		

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.4/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.7/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--<link rel="stylesheet" href="../css/editor.dataTables.min.css">
    <link rel="stylesheet" href="../css/sb-admin.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/button.css">--->
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

    <div class="wraper">      

        <div class="col-md-6 container form-wraper">

            <form method="POST" 
                id="form"
                action="" >

                <div class="form-header">
                
                    <h4>Employee Details</h4>
                
                </div>

                <div class="form-group row">

                    <label for="emp_name" class="col-sm-2 col-form-label">Employee Name:</label>

                    <div class="col-sm-6">

                        <input type="text"
                                name="emp_name"
                                class="form-control required"
                                id="emp_name"
                        />

                    </div>

                    <label for="emp_code" class="col-sm-2 col-form-label">Sl No.:</label>

                    <div class="col-sm-2">

                        <input type="text"
                                name="emp_code"
                                class="form-control required"
                                id="emp_code"
                        />

                    </div>

                </div>

                <div class="form-group row">

                    <label for="emp_catg" class="control-lebel col-sm-2 col-form-label">Category:</label>

                        <div class="col-sm-10">

                        <!--    <select
                                class="form-control required"
                                name="emp_catg"
                                id="emp_catg"
                            >

                                <option value="">Select Category</option>

                                <?php foreach($category_dtls as $c_list) {

                                ?>
                                    <option value="<?php echo $c_list->category_code ?>" ><?php echo $c_list->category_type; ?></option>

                                <?php

                                }

                                ?>

                            </select>  --> 

                        </div>
                </div>

                <div class="form-group row">

                    <label for="join_dt" class="col-sm-2 col-form-label">Joining Date:</label>

                    <div class="col-sm-10">

                        <input type="date"
                            class="form-control"
                            name="join_dt"
                            id="join_dt"
                        />

                    </div>

                </div>

                <div class="form-group row">

                    <label for="email" class="col-sm-2 col-form-label">Email:</label>

                    <div class="col-sm-4">

                        <input type="email"
                            class= "form-control required"
                            name = "email"
                            id   = "email"
                        />

                    </div>

                    <label for="phn_no" class="col-sm-2 col-form-label">Phone No.:</label>

                    <div class="col-sm-4">

                        <input type="text"
                            class= "form-control"
                            name = "phn_no"
                            id   = "phn_no"
                        />

                    </div>

                </div> 

                <div class="form-group row">

                    <label for="designation" class="col-sm-2 col-form-label">Designation:</label>

                    <div class="col-sm-4">

                        <input type="text"
                            class= "form-control required"
                            name = "designation"
                            id   = "designation"
                        />

                    </div>

                    <label for="department" class="col-sm-2 col-form-label">Department:</label>

                    <div class="col-sm-4">

                        <input type="text"
                            class= "form-control"
                            name = "department"
                            id   = "department"
                        />

                    </div>

                </div> 

                <div class="form-group row">

                    <label for="location" class="col-sm-2 col-form-label">Address:</label>

                    <div class="col-sm-10">

                        <textarea type="text"
                            class= "form-control"
                            name = "location"
                            id   = "location"
                        ></textarea>

                    </div>

                </div>  

                <div class="form-header">
                
                    <h4>Salary Details</h4>
                
                </div>

                <div class="form-group row">

                    <label for="band_pay" class="col-sm-2 col-form-label band_pey">Band Pay:</label>

                    <div class="col-sm-10">

                        <input type="text"
                            class= "form-control required"
                            name = "band_pay"
                            id   = "band_pay"
                        />

                    </div>

                </div> 

                <div class="form-group row grade_pey">

                    <label for="grade_pay" class="col-sm-2 col-form-label">Grade Pay:</label>

                    <div class="col-sm-10">

                        <input type="text"
                            class= "form-control"
                            name = "grade_pay"
                            id   = "grade_pay"
                        />

                    </div>

                </div> 

                <div class="form-group row grade_pey">

                    <label for="ma" class="col-sm-2 col-form-label">Medical Allowance:</label>

                    <div class="col-sm-10">

                        <input type="text"
                            class= "form-control"
                            name = "ma"
                            id   = "ma"
                        />

                    </div>

                </div> 

                <div class="form-group row">

                    <label for="p_tax_id" class="col-sm-2 col-form-label">P-TAX:</label>

                    <div class="col-sm-10">

                      <!--  <select type="text"
                            class= "form-control required"
                            name = "p_tax_id"
                            id   = "p_tax_id"
                        >
                            
                            <option value="">Select</option>

                        <?php

                            foreach($ptax_dtls as $p_list) {?>

                                <option value="<?php echo $p_list->sl_no; ?>"><?php echo $p_list->tax_amt; ?></option>

                        <?php  

                            }

                        ?>

                        </select>-->

                    </div>

                </div> 

                <div class="form-group row">

                    <label for="ir_pay" class="col-sm-2 col-form-label">IR:</label>

                    <div class="col-sm-10">

                        <input type="text"
                            class= "form-control required"
                            name = "ir_pay"
                            id   = "ir_pay"
                        />

                    </div>

                </div> 

                <div class="form-group row">

                    <label for="d_flag" class="col-sm-2 col-form-label">Deduction Flag:</label>
                    
                    <div class="radio">
                        
                        <label><input type="radio" value="Y" name="d_flag" checked>Yes</label>
                    
                    </div>

                    <div class="radio">

                        <label><input type="radio" value="N" name="d_flag">No</label>

                    </div>

                </div>

                <div class="form-header">
                
                    <h4>Banking Details</h4>
                
                </div> 

                <div class="form-group row">

                    <label for="bank_name" class="col-sm-2 col-form-label">Bank Name:</label>

                    <div class="col-sm-10">

                        <input type="text"
                            class= "form-control"
                            name = "bank_name"
                            id   = "bank_name"
                        />

                    </div>

                </div> 

                <div class="form-group row">

                    <label for="bank_ac_no" class="col-sm-2 col-form-label">A/C No.:</label>

                    <div class="col-sm-10">

                        <input type="text"
                            class= "form-control"
                            name = "bank_ac_no"
                            id   = "bank_ac_no"
                        />

                    </div>

                </div> 

                <div class="form-group row">

                    <label for="pf_ac_no" class="col-sm-2 col-form-label">PF A/C No.:</label>

                    <div class="col-sm-10">

                        <input type="text"
                            class= "form-control"
                            name = "pf_ac_no"
                            id   = "pf_ac_no"
                        />

                    </div>

                </div> 

                <div class="form-group row">

                    <div class="col-sm-10">

                        <input type="submit" class="btn btn-info" value="Save" />

                    </div>

                </div>

            </form>

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
