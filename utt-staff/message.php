<?php
	session_start();
	ob_start();
?>

<center>
	<br/><br/><br/>
	<h3><?php echo $_SESSION["strMessage"] ?></h3>
	<?php echo $_SESSION["strMessage2"]; ?>
</center>
<?php
	$_SESSION["strHeading"] = "";
	$_SESSION["strMessage"] = "";
	$_SESSION["strMessage2"] = "";
?>