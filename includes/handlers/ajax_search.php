<?php  
include("../../config/config.php");
include("../../includes/classes/User.php");

$query = $_POST['query'];
$userLoggedIn = $_POST['userLoggedIn'];

$names = explode(" ",$query);

//If query contains an underscore, assume user is searching for usernames
if(strpos($query, '_') !== false)
	$usersReturnedQuery = mysqli_query($con, "SELECT * FROM USER WHERE USERNAME LIKE '$query' LIMIT 8");
//If there are two words. assume they are first and last names respectively
else if(count($names) == 2) {
	$usersReturnedQuery = mysqli_query($con, "SELECT * FROM USER WHERE (NAME LIKE '%$names[0]%' AND NAME LIKE '%$names[1]%') LIMIT 8");
}
//If there is only one word
else {
	$usersReturnedQuery = mysqli_query($con, "SELECT * FROM USER WHERE (NAME LIKE '%$names[0]%') OR (USERNAME LIKE '%$names[0]%') LIMIT 8");
}


if($query != "") {
	while($row = mysqli_fetch_array($usersReturnedQuery)) {
		$user = new User($con, $userLoggedIn);

		if($row['USERNAME'] != $userLoggedIn)
			$mutual_friends = $user->getMutualFriends($row['USERNAME']) . " friends in common";
		else
			$mutual_friends = $user->getNumOfFriends() . " friends in common";

		echo "<div class='result_display'>
				<a href='" . $row['USERNAME'] . "' style='color: #1485BD'>
					<div class='liveSearchProfilePic'>
						<img src='" . $row['PROFILE_PIC'] . "'>
					</div>

					<div class='liveSearchText'>
						" . $row['NAME'] . "
						<p>" . $row['USERNAME'] . "</p>
						<p id='grey'>" . $mutual_friends . "</p>
 					</div>
				</a>
				</div>";
	}
}

?>