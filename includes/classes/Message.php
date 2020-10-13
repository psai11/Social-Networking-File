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

	public function sendMessage($user_to, $body, $date) {

		if($body != "") {
			$userLoggedIn = $this->user_obj->getUsername();
			$query = mysqli_query($this->con, "INSERT INTO MESSAGES VALUES('','$user_to','$userLoggedIn','$body','$date','no','no','no')");
		}
	}


	public function getMessages($otherUser) {
		$userLoggedIn = $this->user_obj->getUsername();
		$data = "";
 
		$query = mysqli_query($this->con, "UPDATE MESSAGES SET OPENED='yes' WHERE USER_TO='$userLoggedIn' AND USER_FROM='$otherUser'");
 
		$get_messages_query = mysqli_query($this->con, "SELECT * FROM MESSAGES WHERE (USER_TO='$userLoggedIn' AND USER_FROM='$otherUser') OR (USER_FROM='$userLoggedIn' AND USER_TO='$otherUser')");
 
		while($row = mysqli_fetch_array($get_messages_query)) {
			$user_to = $row['USER_TO'];
			$user_from = $row['USER_FROM'];
			$body = $row['BODY'];
			$id = $row['ID'];
 
			$div_top = ($user_to == $userLoggedIn) ? "<div class='message' id='green'>" : "<div class='message' id='blue'>";
			$data = $data . $div_top . $body . "</div><br><br><br>";
		}
		return $data;
	}


}

?>

