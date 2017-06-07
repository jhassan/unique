<?php
	include_once("config.php");
	session_start();
	
	$strNewLoginx = mysql_real_escape_string($conn,$_POST['strNewLoginx']);
	$strNewPassword = mysql_real_escape_string($conn,$_POST['strNewPassword']);
	// set login / password as session vars
	$_SESSION["strLogin"] = $strNewLoginx;
	$_SESSION["strPassword"] = md5($strNewPassword);
//print_r($_SESSION); die;
	header("Location: home");
?>