<?php  
include("includes/header.php");

$message_obj = new Message($con, $userLoggedIn);

if(isset($_GET['u']))
	$user_to = $_GET['u'];
else {
	$user_to = $message_obj->getMostRecentUser();
	if($user_to == false)
		$user_to = 'new';
}

if($user_to != "new")
	$user_to_obj = new user($con, $user_to);
?>

<div class="user_details column">
	<a href="<?php echo $userLoggedIn; ?>"> <img src="<?php echo $user['PROFILE_PIC']; ?>"> </a>

	<div class="user_details_left_right">
		<?php 
		echo $user['NAME'];
		?>
		<br>
		<a href="<?php echo $userLoggedIn; ?>">
			<?php echo "@".$user['USERNAME']."<br>"; ?>
		</a>
	</div>
</div>

<div class="main_column column" id="main_column">
	<?php  
	if($user_to != "new")
		echo "<h4>You and <a href='$user_to'>" . $user_to_obj->getName() . "</a></h4><hr><br>";
	?>

	<div class="loaded_messages">
		<form action="" method="POST">
			<?php  
			if($user_to == "new") {
				echo "Select the friend you'd like to chat with... <br><br>";
				echo "To <input type='text' >";
				echo "<div class='results'></div>";
			}
			else {
				echo "<textarea name='message_body' id='message_textarea' placeholder='Write your message here...'></textarea>";
				echo "<input type='submit' name='post_message' class='info' id='message_submit' value='Send'>";
			}

			?>
		</form>
		
	</div>



</div>