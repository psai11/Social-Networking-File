<?php
	require 'config/config.php'; 
	include("includes/classes/User.php");
	include("includes/classes/Post.php");
	include("includes/classes/Notification.php");

	if (isset($_SESSION['username'])){
		$userLoggedIn = $_SESSION['username'];
		$user_details_query = mysqli_query($con, "SELECT * FROM USER WHERE USERNAME='$userLoggedIn'");
		$user = mysqli_fetch_array($user_details_query);
	}
	else {
		header("Location: register.php");
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

	<style type="text/css">
		* {
			font-family: Arial, Helvetica, Sans-serif;
		}

		body {
			background-color: #fff;
		}

		form {
			position: absolute;
			top: 0;
		}

	</style>

	<?php  
	//Get id of post
	if(isset($_GET['post_id'])) {

		$post_id = $_GET['post_id'];
	}

	$get_likes = mysqli_query($con, "SELECT LIKES,ADDED_BY FROM MEDIA WHERE ID='$post_id'");
	$row = mysqli_fetch_array($get_likes);
	$total_likes = $row['LIKES'];
	$user_liked = $row['ADDED_BY']; 

	$user_details_query = mysqli_query($con, "SELECT * FROM USER WHERE USERNAME='$user_liked'");
	$row = mysqli_fetch_array($user_details_query);

	//Like button
	if(isset($_POST['like_button'])) {
		$total_likes++;
		$query = mysqli_query($con, "UPDATE MEDIA SET LIKES='$total_likes' WHERE ID='$post_id'");
		$insert_user = mysqli_query($con, "INSERT INTO MEDIA_LIKES VALUES('','$userLoggedIn','$post_id')");

		//Insert Notification
		if($user_liked != $userLoggedIn) {
			$notification = new Notification($con, $userLoggedIn);
			$notification->insertNotification($post_id, $user_liked, "like");
		}
	}
	//Unlike button
	if(isset($_POST['unlike_button'])) {
		$total_likes--;
		$query = mysqli_query($con, "UPDATE MEDIA SET LIKES='$total_likes' WHERE ID='$post_id'");
		$insert_user = mysqli_query($con, "DELETE FROM MEDIA_LIKES WHERE USERNAME='$userLoggedIn' AND POST_ID='$post_id'");
	}


	//Check for previous likes
	$check_query = mysqli_query($con, "SELECT * FROM MEDIA_LIKES WHERE USERNAME='$userLoggedIn' AND POST_ID='$post_id'");
	$num_rows = mysqli_num_rows($check_query);

	if($num_rows > 0) {
		echo '<form action="like.php?post_id='.$post_id.'" method="POST">
				<input type="submit" class="comment_like" name="unlike_button" value="Unlike">
				<div class="like_value">
					'.$total_likes.' Likes
				</div>
			</form>
		';
	}
	else {
		echo '<form action="like.php?post_id='.$post_id.'" method="POST">
				<input type="submit" class="comment_like" name="like_button" value="Like">
				<div class="like_value">
					'.$total_likes.' Likes
				</div>
			</form>
		';

	}

	?>

</body>
</html>