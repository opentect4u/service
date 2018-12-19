<?php
	ini_set("display_errors",1);
	error_reporting(E_ALL);

	require("connect.php");
	session_start();

	if($_SERVER['REQUEST_METHOD']=="POST"){	

		$userId	= $_POST['user_id'];
		$pawd	= $_POST['pwd'];

		$sql 	= "select * from md_users where user_id = '$userId'";

		$result = mysqli_query($db,$sql);

		if($result){
			if(mysqli_num_rows($result) > 0 ){

				$row = mysqli_fetch_assoc($result);
				$pwd = password_verify($pawd,$row['password']);

				if($pwd){
					$_SESSION['userId'] 	= $row['user_id'];
					$uId			= $_SESSION['userId'];
					$_SESSION['userType']	= $row['user_type'];
					$time			= date('Y-m-d h:i:s');
					$server			= $_SERVER['REMOTE_ADDR'];		

					$insert = "insert into td_audit_trail(login_dt,user_id,user_name,terminal_name)
						   values('$time','$uId','$name','$server')";
					$result = mysqli_query($db,$insert);

					$maxSl	= "select max(sl_no)sl_no from td_audit_trail where user_id='$uId'";
					$result = mysqli_query($db,$maxSl);

					if($result){
					   if(mysqli_num_rows($result) > 0 ){
					  	$slNo = mysqli_fetch_assoc($result);
						$_SESSION['sl_no'] = $slNo['sl_no'];
					   }
					}

					mysqli_close($sql);	
					header("Location:dash/dashboard.php");
					
				}

			}
		}
	}
?>
<head>
<link rel="stylesheet" type="text/css" href="./css/login.css">
<script src="./login.js"></script>
</head>
<div class="wrapper">
	<div class="container">
		<h1>Welcome</h1>
		
		<form class="form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
		<input type="text"style="height:40px;" name="user_id" placeholder="Username">
			<input type="password" name="pwd" placeholder="Password">
			<button type="submit" id="login-button" >Log In </button>
		</form>
	</div>
	
	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div>
