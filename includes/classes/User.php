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

	public function getName() {
		return $this->user['NAME'];
	}

	public function getProfilePic() {
		return $this->user['PROFILE_PIC'];
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




}

?>