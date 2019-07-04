<?php
      ini_set("display_errors",1);
      error_reporting(E_ALL);

      require("../login/connect.php"); 
      require("../dash/nav.php")
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../css/menu.css">

</head>
<body>

<div class="sidenav">
  <a href="../dash/dashboard.php">Home</a>
  <hr class="new">

<?php if($_SESSION['userType']=='A') { ?>

  <button class="dropdown-btn">Add New
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <ul>
      <li><a href="../add/customer.php">Customer</a></li> 
      <li><a href="../add/machine.php">Device Type</a></li>
      <li><a href="../add/parts.php">Parts</a></li>
      <li><a href="../add/service.php">Service Center</a></li>
      <li><a href="../add/version.php">Device Version</a></li>
      <li><a href="../add/problem.php">Problems</a></li>
      <li><a href="../add/tech.php">Technician</a></li>
  </ul>
  </div>
  <hr class="new">
<?php } ?>
  <button class="dropdown-btn">Stock
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <ul>
      <li><a href="../stock/partsIn.php">Component</a></li>
      <li><a href="../device/device.php">Device</a></li>
      <li><a href="../sale/deviceSale.php">Device Sale</a></li>
    </ul>  
  </div>

<?php if($_SESSION['userType']=='A' || $_SESSION['userType']=='E') { ?>
  <hr class="new">
  <button class="dropdown-btn">Service
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <ul>
      <li><a href="../booking/book.php">Device In</a></li>
      <li><a href="../booking/service.php">Device Service</a></li>
      <li><a href="../service_out/service_out.php">Device Out</a></li>
      <li><a href="../track/slNo.php">Track Device History</a></li>
    </ul>  
  </div>
<?php } ?>

  <hr class="new">
  <button class="dropdown-btn">Reports 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <ul>
      <li><a href="../reports/as_on_dt.php">Stock</a></li>
      <li><a href="../reports/parts_dt.php">Component Ledger</a></li>
      <li><a href="../reports/service_dt.php">Due Service Details</a></li>
      <li><a href="../reports/engg_dt.php">Technician's Service Detail</a></li>
      <li><a href="../reports/cust_dt.php">Customer Wise Device Submitted</a></li>
      <li><hr></li>
      <li><a href="../reports/status.php">Warranty Status</a></li>
      <li><a href="../reports/item_dt.php">Item Wise Sale</a></li>
      <li><a href="../reports/cust_sale_dt.php">Customer Wise Sale</a></li>
      <li><a href="../reports/invoice_dt.php">Date Wise Invoice</a></li>
      <li><a href="../reports/new_device_dt.php">Device Ledger</a></li>
      <li><a href="../reports/trf_device_dt.php">Device Transfer</a></li>
    </ul>  
  </div>

  <hr class="new">
  <button class="dropdown-btn">User Maintenance 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <ul>
      <?php if($_SESSION['userType']=='A') { ?>
        <li><a href="../user/user.php">Add User</a></li>
      <?php } ?>
      
      <li><a href="../user/cngPwd.php">Change Password</a></li>
    </ul>  
  </div>
  <hr class="new">
  <a href="../dash/logout.php">Logout</a>
</div>



<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
</script>


</body>
</html> 
