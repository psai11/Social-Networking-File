<?php  
include("includes/header.php");
include("includes/form_handlers/settings_handler.php");
?>

<div class="main_column column">
	
	<h4>Acoount Settings</h4>
	<?php  
	echo "<img src='" . $user['PROFILE_PIC'] . "' id='small_profile_pic'>";	
	?>
	<br>
	<a href="upload.php">Upload new profile picture</a> <br><br><br>

	Modify the values and click 'Update Details' :
	<br>
	<br>

	<?php 
	$user_data_query = mysqli_query($con, "SELECT * FROM USER WHERE USERNAME='$userLoggedIn'");
	$row = mysqli_fetch_array($user_data_query);
	$name = $row['NAME'];
	?>

	<form action="settings.php" method="POST">
		<?php echo "Name:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"; ?> <input type="text" name="name" value="<?php echo $name; ?>" id="settings_input" required><br>

		<?php echo $message; ?>

		<input type="submit" name="update_details" id="save_details" value="Update Details" class="info settings_submit" required><br>
	</form>

	<h4>Change Password</h4>
	<form action="settings.php" method="POST">
		<?php echo "Old Password:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"; ?> <input type="password" name="old_password" id="settings_input" required><br>
		<?php echo "New Password:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"; ?> <input type="password" name="new_password_1" id="settings_input" required><br>
		<?php echo "Confirm New Password:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"; ?> <input type="password" name="new_password_2" id="settings_input" required><br>

		<?php echo $password_message; ?>

		<input type="submit" name="update_password" id="save_details" value="Update Password" class="info settings_submit"><br>
	</form>



</div>