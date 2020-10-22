<?php  
if(isset($_POST['update_details'])) {

	$name = $_POST['name'];

	$message = "Details updated!<br><br>";

	$query = mysqli_query($con, "UPDATE USER SET NAME='$name' WHERE USERNAME='$userLoggedIn'");
}

else
	$message = "";

//****************************************************************

if(isset($_POST['update_password'])) {

	$old_password = strip_tags($_POST['old_password']);
	$new_password_1 = strip_tags($_POST['new_password_1']);
	$new_password_2 = strip_tags($_POST['new_password_2']);

	$password_query = mysqli_query($con, "SELECT PASSWORD FROM USER WHERE USERNAME='$userLoggedIn'");
	$row = mysqli_fetch_array($password_query);
	$db_password = $row['PASSWORD'];

	if(md5($old_password) == $db_password) {

		if($new_password_1 == $new_password_2) {

			$new_password_md5 = md5($new_password_1);
			$password_query = mysqli_query($con, "UPDATE USER SET PASSWORD='$new_password_md5' WHERE USERNAME='$userLoggedIn'");
			$password_message = "Password has been changed!<br><br>";


		}
		else {
			$password_message = "New password doesn't match!<br><br>";
		}

	}
	else {
		$password_message = "Old password is incorrect!<br><br>";
	}
}
else {
	$password_message = "";
}

?>