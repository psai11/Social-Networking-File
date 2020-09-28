<?php
ob_start(); //Turns on output buffering
session_start();

$timezone = date_default_timezone_set("Asia/Kolkata");

$con=mysqli_connect("localhost","root","","social");

?>