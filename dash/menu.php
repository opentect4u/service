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
  <button class="dropdown-btn">Add New
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <ul>
      <li><a href="../add/customer.php">Customer</a></li> 
      <li><a href="../add/machine.php">Device</a></li>
      <li><a href="../add/parts.php">Parts</a></li>
      <li><a href="../add/service.php">Service Center</a></li>
      <li><a href="../add/problem.php">Problems</a></li>
      <li><a href="../add/tech.php">Technician</a></li>
  </ul>
  </div>
  <hr class="new">
  <button class="dropdown-btn">Stock
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <ul>
      <li><a href="../stock/partsIn.php">Component Stock</a></li>
     <!-- <li><a href="../transfer/partsTrf.php">Transfer Parts</a></li>
      <li><a href="../damage/partsDamage.php">Damage Parts</a></li>-->
    </ul>  
  </div>
  <hr class="new">
  <button class="dropdown-btn">Service
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <ul>
      <li><a href="../booking/book.php">Device In</a></li>
      <li><a href="../booking/service.php">Device Service</a></li>
      <li><a href="../service_out/service_out.php">Device Out</a></li>
    </ul>  
  </div>
  <hr class="new">
  <button class="dropdown-btn">Reports 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <ul>
      <li><a href="../reports/as_on_dt.php">Component Stock</a></li>
      <li><a href="#">Component Ledger</a></li>
      <li><a href="#">Due Service Details</a></li>
      <li><a href="#">Engineers' Service Detail</a></li>
    </ul>  
  </div>
  <!--<hr class="new">
  <button class="dropdown-btn">Approve 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <ul>
      <li><a href="../approve/approve.php">Parts In/Out</a></li>
      <li><a href="#">Stock Transfer</a></li>
      <li><a href="#">Stock Damage</a></li>
      <li><a href="#">Service In</a></li>
      <li><a href="#">Service Out</a></li>
    </ul>  
  </div>-->
  <hr class="new">
  <a href="#">User Maintenance</a>
  <!--<hr class="new">
  <a href="#">Contact</a>-->
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
