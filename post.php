<?php  
include("includes/header.php");

if(isset($_GET['id'])) {
	$id = $_GET['id'];
}
else {
	$id = 0;
}
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
	
	<div class="posts_area">
		
		<?php  
			$post = new Post($con, $userLoggedIn);
			$post->getSinglePost($id);
		?>

	</div>

</div>