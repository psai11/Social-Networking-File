<?php  
require '../../config/config.php'; 

	if (isset($_GET['post_id']))
		$post_id = $_GET['post_id'];

	if (isset($_POST['result'])) {
		if ($_POST['result'] == 'true')
			$query = mysqli_query($con, "UPDATE MEDIA SET DELETED='yes' WHERE ID='$post_id'");
	}
	
?>