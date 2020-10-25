<?php 
class Post {
	private $user_obj;
	private $con;

	public function __construct($con, $user){
		$this->con = $con;
		$this->user_obj = new User($con, $user);
	}

	public function submitPost($body, $user_to, $imageName) {
		$body = strip_tags($body); //removes html tags
		$body = mysqli_real_escape_string($this->con, $body);
		$body = str_replace('\r\n', '\n', $body);
		$body = nl2br($body);
		$check_empty = preg_replace('/\s+/','', $body); //Deletes all spaces

		if($check_empty != "") {

			$body_array = preg_split("/\s+/", $body);

			foreach ($body_array as $key => $value) {
				
				if(strpos($value, "www.youtube.com/watch?v=") !== false) {

					$link = preg_split("!&!", $value);

					$value = preg_replace("!watch\?v=!", "embed/" , $link[0]);
					$value = "<br><iframe width=\'420\' height=\'315\' src=\'" . $value . "\'></iframe><br>";
					$body_array[$key] = $value;
				}


			}
			$body = implode(" ", $body_array);

			//Current date and time
			$date_added = date("Y-m-d H:i:s");
			//Get username
			$added_by = $this->user_obj->getUsername();

			//If user is on own profile, user_to is 'none'
			if($user_to == $added_by) {
				$user_to= "none";
			}

			//insert post in DB
			$query = mysqli_query($this->con, "INSERT INTO MEDIA VALUES('','$body','$added_by','$user_to','$date_added','no','0', '$imageName')");
			$returned_id = mysqli_insert_id($this->con);

			//insert notification
			if($user_to != 'none') {
				$notification = new Notification($this->con, $added_by);
				$notification->insertNotification($returned_id, $user_to, "profile_post");
			}
			
			$stopWords = "a about above across after again against all almost alone long already also although always among am an and another any anybody anyone anything anywhere are area areas around as ask asked asking asks at away b back backed backing backs be became because become becomes been before began behind being beings best better between big both but by c came can cannot case cases certain certainly clear clearly come could d did differ different differently do does done down down downed downing downs during e each early either end ended ending ends enough even evenly ever every everybody everyone everything everywhere f face faces fact facts far felt few find finds first for four from full fully further furthered furthering furthers g gave general generally get gets give given gives go going good goods guys got great greater greatest group grouped grouping groups h had has have having he her here herself high hi higher highest him himself his how however i im if important in interest interested interesting interests into is it its itself j just k keep keeps kind knew know known knows large largely last later latest least less let lets like likely long longer longest m made make making man many may me member members men might more most mostly mr mrs much must my myself n necessary need needed needing needs never new new newer newest next no nobody non noone not nothing now nowhere number numbers o of off often old older oldest on once one only open opened opening opens or order ordered ordering orders other others our out over p part parted parting parts per perhaps place places point pointed pointing points possible present presented presenting presents problem problems put puts q quite r rather really right right room rooms s said same saw say says second seconds see seem seemed seeming seems sees several shall she should show showed showing shows side sides since small smaller smallest so some somebody someone something somewhere state states still still such sure t take taken than that the their them then there therefore these they thing things think thinks this those though thought thoughts three through thus to today together too took toward turn turned turning turns two u under until up upon us use used uses v very w want wanted wanting wants was way ways we well wells went were what when where whether which while who whole whose why will with within without work worked working works would x y year years yet you young younger youngest your yours z lol haha omg hey ill iframe wonder else like hate sleepy reason for some little yes bye choose isnt season amazing img";

			$stopWords = preg_split("/[\s,]+/", $stopWords);

			$no_puntuation = preg_replace("/[^a-zA-Z 0-9]+/", "", $body);

			if (strpos($no_puntuation, "height") === false && strpos($no_puntuation, "width") === false && strpos($no_puntuation, "http") === false) {

				$no_puntuation = preg_split("/[\s,]+/", $no_puntuation);

				foreach ($stopWords as $value) {
					foreach ($no_puntuation as $key => $value2) {
						
						if(strtolower($value) == strtolower($value2))
							$no_puntuation[$key] = "";


					}
				}

				foreach ($no_puntuation as $value) {
					$this->calculateTrend(ucfirst($value));
				}
			}
		}
	}

	public function calculateTrend($term) {

		if($term != '') {
			$query = mysqli_query($this->con ,"SELECT * FROM TRENDS WHERE TITLE='$term'");

			if(mysqli_num_rows($query) == 0)
				$insert_query = mysqli_query($this->con, "INSERT INTO TRENDS VALUES('$term','1')");
			else 
				$insert_query = mysqli_query($this->con, "UPDATE TRENDS SET HITS=HITS+1 WHERE TITLE='$term'");
		}
	}


	public function loadPostsFriends($data,$limit) {

		$page = $data['page'];
		$userLoggedIn = $this->user_obj->getUsername();

		if ($page == 1) 
			$start = 0;
		else
			$start = ($page - 1) * $limit;


		$str = ""; //String to return
		$data_query = mysqli_query($this->con, "SELECT * FROM MEDIA WHERE DELETED='no' ORDER BY ID DESC");

		if(mysqli_num_rows($data_query) > 0) {

			$num_iterations = 0; //number of results checked not necessarily posted
			$count = 1;			

			while($row = mysqli_fetch_array($data_query)) {
				$id = $row['ID'];
				$body = $row['BODY'];
				$added_by = $row['ADDED_BY'];
				$date_time = $row['DATE_ADDED'];
				$imagePath = $row['IMAGE'];

				//Prepare user_to string so it can be included even if not posted to user
				if($row['USER_TO'] == 'none') {
					$user_to = "";
				} 
				else {
					$user_to_obj = new User($this->con,$row['USER_TO']);
					$user_to_name = $user_to_obj->getName();
					$user_to = "to <a href='" .$row['USER_TO']."'>".$user_to_name . "</a>";
				}

				$user_logged_obj = new User($this->con,$userLoggedIn);
				if($user_logged_obj->isFriend($added_by)) {

					if($num_iterations++ < $start) 
						continue;


					//Once 10 posts have been loaded, break
					if($count > $limit) {
						break;
					}
					else {
						$count++;
					}

					if($userLoggedIn == $added_by)
						$delete_button = "<button class='delete_button btn-danger' id='post$id'>X</button>";
					else
						$delete_button = "";


					$user_details_query = mysqli_query($this->con, "SELECT NAME,PROFILE_PIC FROM USER WHERE USERNAME='$added_by'");
					$user_row = mysqli_fetch_array($user_details_query);
					$name = $user_row['NAME'];
					$profile_pic = $user_row['PROFILE_PIC'];


					?>
					<script>
						function toggle<?php echo $id; ?>(event) {
							if(!event)
								event=window.event;
							var target = $(event.target);
							if (!target.is("a")) {
								var element = document.getElementById("toggleComment<?php echo $id; ?>");

								if(element.style.display == "block") 
									element.style.display = "none";
								else 
									element.style.display = "block";
							}
						}

					</script>
					<?php

					$comments_check = mysqli_query($this->con, "SELECT * FROM MEDIA_COMMENTS WHERE POST_ID='$id'");
					$comments_check_num = mysqli_num_rows($comments_check);


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

					if($imagePath != "") {
						$imageDiv = "<div class='postedImage'>
										<img src='$imagePath'>
									</div>";
					}
					else {
						$imageDiv = "";
					}

					$str .= "<div class='status_posts' onClick='javacript:toggle$id()'>
								<div class='post_profile_pic'>
									<img src='$profile_pic' width='50'>
								</div>

								<div class='posted_by' style='color:#ACACAC;'>
									<a href='$added_by'> $name </a> $user_to &nbsp;&nbsp;&nbsp;&nbsp;$time_message
									$delete_button
								</div>
								<div id='post_body'>
									$body
									<br>
									$imageDiv
									<br>
									<br>	
								</div>

								<div class='newsfeedPostOptions'>
									Comments($comments_check_num)&nbsp;&nbsp;&nbsp;
									<iframe src='like.php?post_id=$id' scrolling='no'> </iframe>
								</div>

							</div>
							<div class='post_comment' id='toggleComment$id' style='display:none;'>
								<iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
							</div>
							<hr>";
				}

				?>
				<script>
					
					$(document).ready(function() {


						$('#post<?php echo $id; ?>').on('click',function() {
							bootbox.confirm("Are you sure you want to delete this post?", function(result) {

								$.post("includes/form_handlers/delete_post.php?post_id=<?php echo $id; ?>", {result:result});
								
								if(result)
									location.reload();
							});
						});


					});

				</script>
				<?php

			}//End While loop

			if($count > $limit)
				$str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
							<input type='hidden' class='noMorePosts' value='false'>";
			else
				$str .= "<input type='hidden' class='noMorePosts' value='true'><p style='text->align: centre;'> No more posts to show! </p>";



		}

		echo $str;
	}


	public function loadProfilePosts($data,$limit) {

		$page = $data['page'];
		$profileUsername = $data['profileUsername'];
		$userLoggedIn = $this->user_obj->getUsername();

		if ($page == 1) 
			$start = 0;
		else
			$start = ($page - 1) * $limit;


		$str = ""; //String to return
		$data_query = mysqli_query($this->con, "SELECT * FROM MEDIA WHERE DELETED='no' AND ((ADDED_BY='$profileUsername' AND USER_TO='none') OR USER_TO='$profileUsername') ORDER BY ID DESC");

		if(mysqli_num_rows($data_query) > 0) {

			$num_iterations = 0; //number of results checked not necessarily posted
			$count = 1;			

			while($row = mysqli_fetch_array($data_query)) {
				$id = $row['ID'];
				$body = $row['BODY'];
				$added_by = $row['ADDED_BY'];
				$date_time = $row['DATE_ADDED'];


				if($num_iterations++ < $start) 
					continue;


				//Once 10 posts have been loaded, break
				if($count > $limit) {
					break;
				}
				else {
					$count++;
				}

				if($userLoggedIn == $added_by)
					$delete_button = "<button class='delete_button btn-danger' id='post$id'>X</button>";
				else
					$delete_button = "";


				$user_details_query = mysqli_query($this->con, "SELECT NAME,PROFILE_PIC FROM USER WHERE USERNAME='$added_by'");
				$user_row = mysqli_fetch_array($user_details_query);
				$name = $user_row['NAME'];
				$profile_pic = $user_row['PROFILE_PIC'];


				?>
				<script>
					function toggle<?php echo $id; ?>(event) {
						if(!event)
							event=window.event;
						var target = $(event.target);
						if (!target.is("a")) {
							var element = document.getElementById("toggleComment<?php echo $id; ?>");

							if(element.style.display == "block") 
								element.style.display = "none";
							else 
								element.style.display = "block";
						}
					}

				</script>
				<?php

				$comments_check = mysqli_query($this->con, "SELECT * FROM MEDIA_COMMENTS WHERE POST_ID='$id'");
				$comments_check_num = mysqli_num_rows($comments_check);


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
				$str .= "<div class='status_posts' onClick='javacript:toggle$id()'>
							<div class='post_profile_pic'>
								<img src='$profile_pic' width='50'>
							</div>

							<div class='posted_by' style='color:#ACACAC;'>
								<a href='$added_by'> $name </a>  &nbsp;&nbsp;&nbsp;&nbsp;$time_message
								$delete_button
							</div>
							<div id='post_body'>
								$body
								<br>
								<br>
								<br>	
							</div>

							<div class='newsfeedPostOptions'>
								Comments($comments_check_num)&nbsp;&nbsp;&nbsp;
								<iframe src='like.php?post_id=$id' scrolling='no'> </iframe>
							</div>

						</div>
						<div class='post_comment' id='toggleComment$id' style='display:none;'>
							<iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
						</div>
						<hr>";
				

				?>
				<script>
					
					$(document).ready(function() {


						$('#post<?php echo $id; ?>').on('click',function() {
							bootbox.confirm("Are you sure you want to delete this post?", function(result) {

								$.post("includes/form_handlers/delete_post.php?post_id=<?php echo $id; ?>", {result:result});
								
								if(result)
									location.reload();
							});
						});


					});

				</script>
				<?php

			}//End While loop

			if($count > $limit)
				$str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
							<input type='hidden' class='noMorePosts' value='false'>";
			else
				$str .= "<input type='hidden' class='noMorePosts' value='true'><p style='text->align: centre;'> No more posts to show! </p>";



		}

		echo $str;
	}

	public function getSinglePost($post_id) {

		$userLoggedIn = $this->user_obj->getUsername();
		$opened_query = mysqli_query($this->con, "UPDATE NOTIFICATIONS SET OPENED='yes' WHERE USER_TO='$userLoggedIn' AND LINK LIKE '%=$post_id'");

		$str = ""; //String to return
		$data_query = mysqli_query($this->con, "SELECT * FROM MEDIA WHERE DELETED='no' AND ID='$post_id'");

		if(mysqli_num_rows($data_query) > 0) {	

			$row = mysqli_fetch_array($data_query); 
				$id = $row['ID'];
				$body = $row['BODY'];
				$added_by = $row['ADDED_BY'];
				$date_time = $row['DATE_ADDED'];

				//Prepare user_to string so it can be included even if not posted to user
				if($row['USER_TO'] == 'none') {
					$user_to = "";
				} 
				else {
					$user_to_obj = new User($this->con,$row['USER_TO']);
					$user_to_name = $user_to_obj->getName();
					$user_to = "to <a href='" .$row['USER_TO']."'>".$user_to_name . "</a>";
				}

				$user_logged_obj = new User($this->con,$userLoggedIn);
				if($user_logged_obj->isFriend($added_by)) {

					if($userLoggedIn == $added_by)
						$delete_button = "<button class='delete_button btn-danger' id='post$id'>X</button>";
					else
						$delete_button = "";


					$user_details_query = mysqli_query($this->con, "SELECT NAME,PROFILE_PIC FROM USER WHERE USERNAME='$added_by'");
					$user_row = mysqli_fetch_array($user_details_query);
					$name = $user_row['NAME'];
					$profile_pic = $user_row['PROFILE_PIC'];


					?>
					<script>
						function toggle<?php echo $id; ?>(event) {
							if(!event)
								event=window.event;
							var target = $(event.target);
							if (!target.is("a")) {
								var element = document.getElementById("toggleComment<?php echo $id; ?>");

								if(element.style.display == "block") 
									element.style.display = "none";
								else 
									element.style.display = "block";
							}
						}

					</script>
					<?php

					$comments_check = mysqli_query($this->con, "SELECT * FROM MEDIA_COMMENTS WHERE POST_ID='$id'");
					$comments_check_num = mysqli_num_rows($comments_check);


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
					$str .= "<div class='status_posts' onClick='javacript:toggle$id()'>
								<div class='post_profile_pic'>
									<img src='$profile_pic' width='50'>
								</div>

								<div class='posted_by' style='color:#ACACAC;'>
									<a href='$added_by'> $name </a> $user_to &nbsp;&nbsp;&nbsp;&nbsp;$time_message
									$delete_button
								</div>
								<div id='post_body'>
									$body
									<br>
									<br>
									<br>	
								</div>

								<div class='newsfeedPostOptions'>
									Comments($comments_check_num)&nbsp;&nbsp;&nbsp;
									<iframe src='like.php?post_id=$id' scrolling='no'> </iframe>
								</div>

							</div>
							<div class='post_comment' id='toggleComment$id' style='display:none;'>
								<iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
							</div>
							<hr>";


				?>
				<script>
					
					$(document).ready(function() {


						$('#post<?php echo $id; ?>').on('click',function() {
							bootbox.confirm("Are you sure you want to delete this post?", function(result) {

								$.post("includes/form_handlers/delete_post.php?post_id=<?php echo $id; ?>", {result:result});
								
								if(result)
									location.reload();
							});
						});


					});

				</script>
				<?php
				}
				else {
					echo "<p>You can not see this post because you are not friends with this user.</p>";
					return;
				}

		}

		else {
			echo "<p>No post found. If you clicked a link, it may be broken.</p>";
			return;
		}

		echo $str;
	}
}

?>