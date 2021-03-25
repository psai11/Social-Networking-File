<!DOCTYPE html>

<?php
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';

?>

<html>
<head>
	<title>PSC-Network</title>
	<link rel="stylesheet" type="text/css" href="assets\css\register_style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>
</head>
<body>

	<?php

	if(isset($_POST['reg_button'])){
		echo '
		<script>
			$(document).ready(function() {
				$("#first").hide();
				$("#second").show();
			});
		</script>
		';
	}

	?>

	<div class="wrapper">

		<div class="login_box">
			<div class="login_header">
				<h1>Welcome!</h1>
				Login or Signup below!
			</div>

			<div id="first">
				<form action="register.php" method="POST">
					<input type="text" name="log_username" placeholder="Username"value="<?php 
					if(isset($_SESSION['log_username'])){
						echo $_SESSION['log_username'];
					}
					?>"required>
					<br>
					<input type="password" name="log_password" placeholder="Password"required>
					<br>
					<input type="submit" name="login_button" value="Login">	
					<br>
					<?php if(in_array("Username or Password Incorect!!<br>", $error_array)){
						echo "Username or Password Incorect!!<br>";
					}
					?>
					<br>
					<a href="#" id="signup" class="signup">Need an account? Register here!</a>
				</form>
			</div>
			
			<div id="second">
				<form action="register.php" method="POST">
					<br>
					<input type="text" name="reg_fname" placeholder="Enter Full Name" value="<?php 
					if(isset($_SESSION['reg_fname'])){
						echo $_SESSION['reg_fname'];
					}
					?>"required> 
					<br>
					<?php if(in_array("Name string too long!(Max 50 varchars!)</br>", $error_array)){
						echo"Name string too long!(Max 50 varchars!)</br>";
					}
					?>

					<input type="text" name="reg_username" placeholder="Enter Nickname" value="<?php 
					if(isset($_SESSION['reg_username'])){
						echo $_SESSION['reg_username'];
					}
					?>"required> 
					<br>
					<?php if(in_array("Nickname aldready exists!!</br>", $error_array)){
						echo"Nickname aldready exists!!</br>";
					}
					?>

					<input type="text" name="reg_gender" placeholder="Gender('M','F','O')" value="<?php 
					if(isset($_SESSION['reg_gender'])){
						echo $_SESSION['reg_gender'];
					}
					?>"required> 
					<br>
					<?php if(in_array("Enter Gender in given format!</br>", $error_array)){
						echo"Enter Gender in given format!</br>";
					}
					?>


					<input type="password" name="reg_password" placeholder="Enter Password" required>
					<br>
					<input type="password" name="reg_password2" placeholder="Confirm Password" required>
					<br>
					<?php if(in_array("Password don't match!</br>", $error_array)){
						echo"Password don't match!</br>";
					}
					else if(in_array("Password length too large!</br>", $error_array)){
						echo"Password length too large!</br>";
					}
					?>


					<input type="submit" name="reg_button" value="Register">
					<br>
					
					<?php if(in_array("<span>You are all set! Go ahead and login!</span></br>", $error_array)){
						echo"<span>You are all set! Go ahead and login!</span></br>";
					}
					?>

					<a href="#" id="signin" class="signin">Aldready have an account? Sign in here!</a>
				</form>

			</div>

			
		</div>
	
	</div>
</body>
</html>
