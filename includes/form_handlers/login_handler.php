<?php

if (isset($_POST['login_button']))
{

	$username=strip_tags($_POST['log_username']);
	$_SESSION['log_username'] =$username; //store username into session variable
	$password=md5($_POST['log_password']); //Get Password

	$check_database_query = mysqli_query($con, "SELECT * FROM USER WHERE USERNAME='$username' AND PASSWORD='$password'");
	$check_login_query = mysqli_num_rows($check_database_query);
	if ($check_login_query == 1){
		$row = mysqli_fetch_array($check_database_query);
		$username=$row['USERNAME'];



		$_SESSION['username'] = $username;
		header("Location: index.php");
		exit();
	}
	else
		array_push($error_array, "Username or Password Incorect!!<br>");
	$_SESSION['log_username']="";
}
?>

