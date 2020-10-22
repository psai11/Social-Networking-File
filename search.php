<?php  

include("includes/header.php");

if(isset($_GET['q'])) {
	$query = $_GET['q'];
}
else {
	$query = "";
}

if(isset($_GET['type'])) {
	$type = $_GET['type'];
}
else {
	$type = "name";
}
?>

<div class="main_column column" id="main_column">
	
	<?php  
	if($query == "")
		echo "You must enter something in the search box!";
	else {
		//If query contains an underscore, assume user is searching for usernames
		if($type == "username")
			$usersReturnedQuery = mysqli_query($con, "SELECT * FROM USER WHERE USERNAME LIKE '%$query%'");
		else{

			$names = explode(" ",$query);

			if(count($names) == 3)
				$usersReturnedQuery = mysqli_query($con, "SELECT * FROM USER WHERE (NAME LIKE '%$names[0]%' AND NAME LIKE '%$names[2]%')");
			else if(count($names) == 2)
				$usersReturnedQuery = mysqli_query($con, "SELECT * FROM USER WHERE (NAME LIKE '%$names[0]%' AND NAME LIKE '%$names[1]%')");
			else{
				$usersReturnedQuery = mysqli_query($con, "SELECT * FROM USER WHERE (NAME LIKE '%$names[0]%')");
			}
		}

		//Check if results were found
		if(mysqli_num_rows($usersReturnedQuery) == 0)
			echo "No users found with a " . $type . " like: " . $query ."<br><br>";
		else
			echo mysqli_num_rows($usersReturnedQuery) . " results found: <br> <br>";


		echo "<p id='grey'>Try searching for:</p>";
		echo "<a href='search.php?q=" . $query . "&type=name'>Names</a>, <a href='search.php?q=" . $query . "&type=username'>Usernames</a><br><br><hr id='search_hr'>";

		while($row = mysqli_fetch_array($usersReturnedQuery)) {
			$user_obj = new User($con, $user['USERNAME']);

			$button = "";
			$mutual_friends = "";

			if($user['USERNAME'] != $row['USERNAME']) {

				//Generate button depending on friendship status
				if($user_obj->isFriend($row['USERNAME']))
					$button = "<input type='submit' name='" . $row['USERNAME'] . "' class='danger' value='Remove Friend'>";
				else if($user_obj->didReceiveRequest($row['USERNAME'])) 
					$button = "<input type='submit' name='" . $row['USERNAME'] . "' class='warning' value='Respond to Request'>";
				else if($user_obj->didSendRequest($row['USERNAME']))
					$button = "<input type='submit' class='default' value='Request Sent'>";
				else
					$button = "<input type='submit' name='" . $row['USERNAME'] . "' class='success' value='Add Friend'>";
				$mutual_friends = $user_obj->getMutualFriends($row['USERNAME']) . " friends in common";

				//Button forms
				if(isset($_POST[$row['USERNAME']])) {

					if($user_obj->isFriend($row['USERNAME'])) {
						$user_obj->removeFriend($row['USERNAME']);
						header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
					}
					else if($user_obj->didReceiveRequest($row['USERNAME'])) {
						header("Location: requests.php");
					}
					else if($user_obj->didSendRequest($row['USERNAME'])) {

					}
					else {
						$user_obj->sendRequest($row['USERNAME']);
						header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
					}
				}


			}

			echo "<div class='search_result'>
					<div class='searchPageFriendButtons'>
						<form action='' method='POST'>
							" . $button . "
							<br>
						</form>
					</div>

					<div class='result_profile_pic'>
						<a href='" . $row['USERNAME'] . "'><img src='" . $row['PROFILE_PIC'] . "' style='height: 100px;'></a>
					</div>

						<a href='" . $row['USERNAME'] . "'>" . $row['NAME'] . "
							<p id='grey'> " . $row['USERNAME'] . "</p>

						</a>
						<br>
						" . $mutual_friends . "<br>

				</div>
				<hr id='search_hr'>";

		}//End while
		
	}

	?>


</div>