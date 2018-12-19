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
<h1>Login</h1>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">

	<input type="text" name="user_id" placeholder="User Name" required />
	<input type="password" name="pwd" placeholder="password"  required />
	<input type="submit" name="submit" value="Log In" />
</form>
