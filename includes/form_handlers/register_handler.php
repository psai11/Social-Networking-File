<?php

//Declaring variables:
$fname="";//full name
$username="";//username
$gender="";//gender
$password="";//password
$password2="";//confirm password
$date="";//sign up date
$error_array=array();//holds error message

if (isset($_POST["reg_button"])){
	//Registration Form Values
	
	//FULL NAME
	$fname=strip_tags($_POST['reg_fname']);//remove html tags
	$_SESSION['reg_fname'] = $fname; //Stores first name into  session variable

	//USERNAME
	$username=strip_tags($_POST['reg_username']);//remove html tags
	$_SESSION['reg_username'] = $username; //Stores username into session variable
	

	//gender
	$gender=strip_tags($_POST['reg_gender']);//remove html tags
	$gender=str_replace(' ','',$gender);
	$gender=ucfirst(strtolower($gender));
	$_SESSION['reg_gender'] = $gender; //Stores gender into session variable


	//password
	$password=strip_tags($_POST['reg_password']);//remove html tags
	$password2=strip_tags($_POST['reg_password2']);//remove html tags

	$date = date("Y-m-d"); //Current date

	//Gender check
	if ($gender == 'M' or $gender == 'F' or $gender == 'O'){}
	else{
		array_push($error_array,"Enter Gender in given format!</br>");
	}

	//pasword check
	if($password == $password2){}
	else {
		array_push($error_array,"Password don't match!</br>");
	}
	if(strlen($password)>30){
		array_push($error_array,"Password length too large!</br>");
	}

	//USERNAME CHECK if it aldready exist or not
	$username_chk = mysqli_query($con,"SELECT USERNAME FROM USER WHERE USERNAME='$username'");
	$num_rows = mysqli_num_rows($username_chk);
	if($num_rows>0) {
		array_push($error_array,"Nickname aldready exists!!</br>");
	}

	//NAME CHECK
	if(strlen($fname)>50) {
		array_push($error_array,"Name string too long!(Max 50 varchars!)</br>");
	}

	if(empty($error_array)) 
	{
		$password = md5($password);//Encrypt password before adding to database;

		//Profile Picture assigment
		$rand=rand(1,16); //Random nos between 1 and 16
		if ($rand ==1 )
			$profile_pic="assets/images/profile_pics/default/head_alizarin.png";
		else if ($rand ==2 )
			$profile_pic="assets/images/profile_pics/default/head_amethyst.png";
		else if ($rand ==3 )
			$profile_pic="assets/images/profile_pics/default/head_belize_hole.png";
		else if ($rand ==4 )
			$profile_pic="assets/images/profile_pics/default/head_carrot.png";
		else if ($rand ==5 )
			$profile_pic="assets/images/profile_pics/default/head_deep_blue.png";
		else if ($rand ==6 )
			$profile_pic="assets/images/profile_pics/default/head_emerald.png";
		else if ($rand ==7 )
			$profile_pic="assets/images/profile_pics/default/head_green_sea.png";
		else if ($rand ==8 )
			$profile_pic="assets/images/profile_pics/default/head_nephritis.png";
		else if ($rand ==9 )
			$profile_pic="assets/images/profile_pics/default/head_pete_river.png";
		else if ($rand ==10 )
			$profile_pic="assets/images/profile_pics/default/head_pomegranate.png";
		else if ($rand ==11 )
			$profile_pic="assets/images/profile_pics/default/head_pumpkin.png";
		else if ($rand ==12 )
			$profile_pic="assets/images/profile_pics/default/head_red.png";
		else if ($rand ==13 )
			$profile_pic="assets/images/profile_pics/default/head_sun_flower.png";
		else if ($rand ==14 )
			$profile_pic="assets/images/profile_pics/default/head_turqoise.png";
		else if ($rand ==15 )
			$profile_pic="assets/images/profile_pics/default/head_wet_asphalt.png";
		else if ($rand ==16 )
			$profile_pic="assets/images/profile_pics/default/head_wisteria.png";
	
		$query = mysqli_query($con,"INSERT INTO USER VALUES('','$username','$password','$fname','$gender','$date','$profile_pic',',')");

		array_push($error_array, "<span>You are all set! Go ahead and login!</span></br>");
	}

	
	

	

	//clear session variables
	$_SESSION['reg_fname']="";
	$_SESSION['reg_username']="";
	$_SESSION['reg_gender']="";
	


}
?>