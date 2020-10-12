<?php 
class Message {
	private $user_obj;
	private $con;

	public function __construct($con, $user){
		$this->con = $con;
		$this->user_obj = new User($con, $user);
	}
	public function getMostRecentUser() {
		$userLoggedIn = $this->user_obj->getUsername();

		$query = mysqli_query($this->con, "SELECT USER_TO,USER_FROM FROM MESSAGES WHERE USER_TO='$userLoggedIn' OR USER_FROM='$userLoggedIn' ORDER BY ID DESC LIMIT 1");

		if(mysqli_num_rows($query) == 0)
			return false;
		$row = mysqli_fetch_array($query);
		$user_to = $row['USER_TO'];
		$user_from = $row['USER_FROM'];

		if($user_to != $userLoggedIn)
			return $user_to;
		else
			return $user_from;
			
	}

}

?>

