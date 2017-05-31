<?php
	include_once("functions.php");
	include_once("../utt-staff/log_array.php");
	ini_set("register_globals", 1);
	session_start();
	
	// set login / password as session vars
	$_SESSION["strLogin"] = $strNewLoginx;
	$_SESSION["strPassword"] = "";

	// Logout log
	activity_log($_SESSION["client_id"], 3, 0);

	$arr = array('status_id' => 0);
	$nLastID = UpdateRec('tbllog', "user_id = '".$_SESSION["client_id"]."'",$arr);

	header("Location: index");
?>