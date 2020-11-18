<?php
      ini_set("display_errors",1);
      error_reporting(E_ALL);

      require_once("../login/connect.php");
      
      $sql    = "select user_name from md_users where user_id = '".$_SESSION['userId']."'";

      $result = mysqli_query($db,$sql);
      $row    = mysqli_fetch_assoc($result);
      $user   = $row['user_name'];

      $date   = date('d/m/Y h:i:sA');

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/nav.css">
<style>

</style>
</head>
<body>

<div class="topnav" id="myTopnav">
  <a style="pointer-events: none;cursor: default;">User : <?php echo $user; ?></a>
</div>

</body>
</html>