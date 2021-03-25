<?php
ob_start(); //Turns on output buffering
session_start();

//mysql://b34e89eb4cc429:9acd5de4@us-cdbr-east-03.cleardb.com/heroku_e854bec6d943ac0?reconnect=true

//Get Heroku ClearDB connection information
$cleardb_url = parse_url(getenv("us-cdbr-east-03.cleardb.com"));
//$cleardb_server = $cleardb_url["host"];
//$cleardb_username = $cleardb_url["user"];
//$cleardb_password = $cleardb_url["pass"];
//$cleardb_db = substr($cleardb_url["path"],1);

$timezone = date_default_timezone_set("Asia/Kolkata");

$con=mysqli_connect("us-cdbr-east-03.cleardb.com","b34e89eb4cc429","9acd5de4","heroku_e854bec6d943ac0");

?>