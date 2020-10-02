<?php 
class Post {
	private $user_obj;
	private $con;

	public function __construct($con, $user){
		$this->con = $con;
		$this->user_obj = new User($con, $user);
	}

	public function submitPost($body, $user_to) {
		$body = strip_tags($body); //removes html tags
		$body = mysqli_real_escape_string($this->con, $body);
		$body = str_replace('\r\n', '\n', $body);
		$body = nl2br($body);
		$check_empty = preg_replace('/\s+/','', $body); //Deletes all spaces

		if($check_empty != "") {

			//Current date and time
			$date_added = date("Y-m-d H:i:s");
			//Get username
			$added_by = $this->user_obj->getUsername();

			//If user is on own profile, user_to is 'none'
			if($user_to == $added_by) {
				$user_to= "none";
			}

			//insert post in DB
			$query = mysqli_query($this->con, "INSERT INTO MEDIA VALUES('','$body','$added_by','$user_to','$date_added','no','0')");
			$returned_id = mysqli_insert_id($this->con);

			//insert notification
		}
	}


	public function loadPostsFriends() {

		$str = ""; //String to return
		$data_query = mysqli_query($this->con, "SELECT * FROM MEDIA WHERE DELETED='no' ORDER BY ID DESC");

		if(mysqli_num_rows($data_query) > 0) {

			while($row = mysqli_fetch_array($data_query)) {
				$id = $row['ID'];
				$body = $row['BODY'];
				$added_by = $row['ADDED_BY'];
				$date_time = $row['DATE_ADDED'];

				//Prepare user_to string so it can be included even if not posted to user
				if($row['USER_TO'] == 'none') {
					$user_to = "";
				} 
				else {
					$user_to_obj = new User($con,$row['USER_TO']);
					$user_to_name = $user_to_obj->getName();
					$user_to = "to <a href='" .$row['USER_TO']."'>".$user_to_name . "</a>";
				}




				$user_details_query = mysqli_query($this->con, "SELECT USERNAME,PROFILE_PIC FROM USER WHERE USERNAME='$added_by'");
				$user_row = mysqli_fetch_array($user_details_query);
				$username = $user_row['USERNAME'];
				$profile_pic = $user_row['PROFILE_PIC'];


				//TimeFrame
				$date_time_now = date("Y-m-d H:i:s");
				$start_date = new DateTime($date_time); // Time of post
				$end_date = new DateTime($date_time_now); // Current time
				$interval = $start_date->diff($end_date); // Difference between dates
				if ($interval->y >= 1) {
					if ($interval == 1)
						$time_message = $interval->y . " year ago"; //1 year ago
					else
						$time_message = $interval->y . " years ago"; //1+ year ago
				}
				else if ($interval-> m >=1) {
					if ($interval->d == 0) {
						$days = " ago";
					}
					else if($interval->d == 1) {
						$days = $interval->d . " day ago";
					}
					else {
						$days = $interval->d . " days ago";
					}

					if ($interval->m == 1) {
						$time_message = $interval->m . " month". $days;
					}
					else {
						$time_message = $interval->m . " months". $days;
					}

				}
				else if($interval->d >=1) {
					if($interval->d == 1) {
						$time_message = "Yesterday";
					}
					else {
						$time_message = $interval->d . " days ago";
					}
				}
				else if ($interval->h >= 1) {
					if($interval->h == 1) {
						$time_message = $interval->h . " hour ago";
					}
					else {
						$time_message = $interval->h . " hours ago";
					}
				}
				else if ($interval->i >= 1) {
					if($interval->i == 1) {
						$time_message = $interval->i . " minute ago";
					}
					else {
						$time_message = $interval->i . " minutes ago";
					}
				}

				else {
					if($interval->s < 30) {
						$time_message = " Just now";
					}
					else {
						$time_message = $interval->s . " seconds ago";
					} 
				}
				$str .= "<div class='status_posts'>
							<div class='post_profile_pic'>
								<img src='$profile_pic' width='50'>
							</div>

							<div class='posted_by' style='color:#ACACAC;'>
								<a href='$added_by'> @$username </a> $user_to &nbsp;&nbsp;&nbsp;&nbsp;$time_message
							</div>
							<div id='post_body'>
								$body
								<br>
							</div>

						</div>
						<hr>";

			}

		}

		echo $str;

	}
}

?>