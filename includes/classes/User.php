<?php 
class User {
	private $user;
	private $con;

	public function __construct($con, $user){
		$this->con = $con;
		$user_details_query = mysqli_query($con, "SELECT * FROM USER WHERE USERNAME='$user'");
		$this->user = mysqli_fetch_array($user_details_query);
	}

	public function getUsername() {
		return $this->user['USERNAME'];
	}

	public function getNumberOfFriendRequests() {
		$username = $this->user['USERNAME'];
		$query = mysqli_query($this->con, "SELECT * FROM FRIEND_REQUESTS WHERE USER_TO='$username'");
		return mysqli_num_rows($query);
	}

	public function getName() {
		return $this->user['NAME'];
	}

	public function getProfilePic() {
		return $this->user['PROFILE_PIC'];
	}

	public function getFriendArray() {
		return $this->user['FRIEND_ARRAY'];
	}

	public function getNumOfFriends() {
		$query = $this->user['FRIEND_ARRAY'];
		$names = explode(",",$query);
		return count($names);
	}

	public function isFriend($username_to_check) {
		$usernameComma = "," . $username_to_check . ",";

		if(strstr($this->user['FRIEND_ARRAY'], $usernameComma) || $username_to_check == $this->user['USERNAME']) {
			return true;
		}
		else {
			return false;
		}
	}

	public function didReceiveRequest($user_from) {
		$user_to = $this->user['USERNAME'];
		$check_request_query = mysqli_query($this->con, "SELECT * FROM FRIEND_REQUESTS WHERE USER_TO='$user_to' AND USER_FROM='$user_from'");
		if (mysqli_num_rows($check_request_query) > 0) {
			return true;
		}
		else {
			return false;
		}
	}

	public function didSendRequest($user_to) {
		$user_from = $this->user['USERNAME'];
		$check_request_query = mysqli_query($this->con, "SELECT * FROM FRIEND_REQUESTS WHERE USER_TO='$user_to' AND USER_FROM='$user_from'");
		if (mysqli_num_rows($check_request_query) > 0) {
			return true;
		}
		else {
			return false;
		}
	}

	public function removeFriend($user_to_remove) {
		$logged_in_user = $this->user['USERNAME'];

		$query = mysqli_query($this->con, "SELECT FRIEND_ARRAY FROM USER WHERE USERNAME='$user_to_remove'");
		$row = mysqli_fetch_array($query);
		$friend_array_username = $row['FRIEND_ARRAY']; 

		$new_friend_array = str_replace($user_to_remove.",", "", $this->user['FRIEND_ARRAY']);
		$remove_friend = mysqli_query($this->con, "UPDATE USER SET FRIEND_ARRAY='$new_friend_array' WHERE USERNAME='$logged_in_user'");

		$new_friend_array = str_replace($this->user['USERNAME'].",", "", $friend_array_username);
		$remove_friend = mysqli_query($this->con, "UPDATE USER SET FRIEND_ARRAY='$new_friend_array' WHERE USERNAME='$user_to_remove'");
	}

	public function sendRequest ($user_to) {
		$user_from = $this->user['USERNAME'];
		$query = mysqli_query($this->con, "INSERT INTO FRIEND_REQUESTS VALUES('','$user_to','$user_from')");
	}

	public function getMutualFriends($user_to_check) {
		$mutualFriends = 0;
		$user_array = $this->user['FRIEND_ARRAY'];
		$user_array_explode = explode(",", $user_array);

		$query = mysqli_query($this->con, "SELECT FRIEND_ARRAY FROM USER WHERE USERNAME='$user_to_check'");
		$row = mysqli_fetch_array($query);
		$user_to_check_array = $row['FRIEND_ARRAY'];
		$user_to_check_array_explode = explode(",", $user_to_check_array);


		foreach ($user_array_explode as $i) {
			
			foreach ($user_to_check_array_explode as $j) {
				
				if ($i == $j && $i != "" && $i!==" ") {
					$mutualFriends++;
				}

			}

		}
		return $mutualFriends;
	}

}

?>