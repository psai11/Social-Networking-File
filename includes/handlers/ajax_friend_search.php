<?php  
include("../../config/config.php");
include("../classes/User.php");

$query = $_POST['query'];
$userLoggedIn = $_POST['userLoggedIn'];

$names = explode(" ", $query);


if(strpos($query, "_") !== false) {
	$usersReturned = mysqli_query($con, "SELECT * FROM USER WHERE USERNAME LIKE '$query%' LIMIT 8");
}
else if(count($names) == 2) {
	$usersReturned = mysqli_query($con, "SELECT * FROM USER WHERE (NAME LIKE '%$names[0]%' AND NAME LIKE '%$names[1]%') LIMIT 8");
}
else {
	$usersReturned = mysqli_query($con, "SELECT * FROM USER WHERE (NAME LIKE '%$names[0]%') OR (USERNAME LIKE '%$names[0]%') LIMIT 8");
}

if($query != "") {
	while($row = mysqli_fetch_array($usersReturned)) {

		$user = new User($con, $userLoggedIn);

		if($row['USERNAME'] != $userLoggedIn) {
			$mutual_friends = $user->getMutualFriends($row['USERNAME']) . " friends in common";
		}
		else {
			$mutual_friends = "";
		}

		if($user->isFriend($row['USERNAME'])) {
			echo "<div class='resultDisplay'>
					<a href='messages.php?u=" . $row['USERNAME'] . "' style='color: #000'>
						<div class='liveSearchProfilePic'>
							<img src='" . $row['PROFILE_PIC'] . "'>
						</div>
					
						<div class='liveSearchText'>
							" . $row['NAME'] . "
							<p style='margin: 0;'>@" . $row['USERNAME'] . "</p> 
							<p id='grey'>" . $mutual_friends ."</p> 
						</div>
					</a>
				</div>";
		}
	}
}

?>