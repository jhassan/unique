<?
	ini_set("register_globals", 1);
	session_start();
	
	// set login / password as session vars
	$_SESSION["strLogin"] = $strNewLoginx;
	$_SESSION["strPassword"] = "";

	header("Location: index");
?>