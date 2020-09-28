<?php 
include("includes/header.php");
include("includes/classes/User.php");
include("includes/classes/Post.php");


if(isset($_POST['post'])) {
	$post = new Post($con, $userLoggedIn);
	$post->submitPost($_POST['post_text'], 'none');
	header("Location: index.php");
}

?> 
	<div class="user_details column">
		<a href="<?php echo $userLoggedIn; ?>"> <img src="<?php echo $user['PROFILE_PIC']; ?>"> </a>

		<div class="user_details_left_right">
			<a href="<?php echo $userLoggedIn; ?>">
				<?php 
				echo $user['NAME'];
				?>
			</a>
			<br>
			<?php echo "@".$user['USERNAME']."<br>"; ?>
		</div>

	</div>

	<div class="main_column column">
		<form class="post_form" action="index.php" method="POST">
			<textarea name="post_text" id="post_text" placeholder="Got something to say?"></textarea>
			<input type="submit" name="post" id="post_button" value="Post">
			<hr>
			
		</form>

		<?php  

		$user_obj = new User($con, $userLoggedIn);
		echo $user_obj->getName();

		?>



	</div>



	</div>

</body>
</html>