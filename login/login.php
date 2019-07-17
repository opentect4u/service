<?php
	ini_set("display_errors",1);
	error_reporting(E_ALL);

	require("connect.php");
	session_start();

	if($_SERVER['REQUEST_METHOD']=="POST"){	

		$userId	= $_POST['username'];
		$pawd	= $_POST['pass'];

		$sql 	= "select * from md_users where user_id = '$userId' and user_status='A'";

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

					$_SESSION['last_time'] = time();	

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

					//Set Session Variable
					$_SESSION['flag'] = false;

					mysqli_close($sql);	
					header("Location:dash/dashboard.php");		
				}

			}
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Synergic Service Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="./login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="./login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="./login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./login/css/util.css">
	<link rel="stylesheet" type="text/css" href="./login/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form p-l-55 p-r-55 p-t-178"
				      method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
				>
					<span class="login100-form-title">
						Sign In
					</span>

					<div class="wrap-input100 validate-input m-b-16" data-validate="Please enter username">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate= "Please enter password">
						<input class="input100" type="password" id="pwd" name="pass" placeholder="Password">
						<i class="fa fa-eye-slash" style="margin-top: -35px; position: absolute; margin-left: 350px; cursor: pointer;" aria-hidden="true" id="eye"></i>
						<span class="focus-input100">

						</span>
					</div>

					<div class="text-right p-t-13 p-b-23">
						<span class="txt1">
							Forgot
						</span>

						<a href="#" class="txt2">
							Username / Password?
						</a>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Sign in
						</button>
					</div>

					<!--<div class="flex-col-c p-t-170 p-b-40">
						<span class="txt1 p-b-9">
							Don’t have an account?
						</span>

						<a href="#" class="txt3">
							Sign up now
						</a>
					</div>-->
				</form>
			</div>
		</div>
	</div>
	
	
<!--===============================================================================================-->
	<script src="./login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="./login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="./login/vendor/bootstrap/js/popper.js"></script>
	<script src="./login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="./login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="./login/vendor/daterangepicker/moment.min.js"></script>
	<script src="./login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="./login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="./login/js/main.js"></script>

</body>
</html>

<script>
	$(document).ready(function(){
		$("#eye").hover(function(){
			var iptype = $("#pwd").attr("type");

			if(iptype == "password"){
				$("#pwd").attr("type","text");
				$("#eye").attr("class","fa fa-eye");
			}else{
				$("#pwd").attr("type","password");	
				$("#eye").attr("class","fa fa-eye-slash");
			}
		});
	});
</script>
