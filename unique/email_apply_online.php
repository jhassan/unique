<?php
if($_POST) {
 // error_reporting(E_ALL);
 // ini_set('display_errors', 1);
 
if(isset($_FILES) && (bool) $_FILES) {
  //print_r($_FILES); die;
	$allowedExtensions = array("pdf","doc","docx","gif","jpeg","jpg","png","rtf","txt");
	
	$files = array();
	foreach($_FILES as $name=>$file) {
		$file_name = $file['name']; 
		$temp_name = $file['tmp_name'];
		$file_type = $file['type'];
		// $path_parts = pathinfo($file_name, PATHINFO_EXTENSION);
		// //$ext = pathinfo($filename, PATHINFO_EXTENSION);
		// $ext = $path_parts['extension'];
		// if(!in_array($ext,$allowedExtensions)) {
		// 	die("File $file_name has the extensions $ext which is not allowed");
		// }
		array_push($files,$file);
	}
	
	// email fields: to, from, subject, and so on
	$to = "ceo@uniquegroup.com.pk";
	$from = $_POST['email']; 
	$subject = $_POST['owner_name']."-".$_POST['company_name']; 
	$message = $_POST['descriptions'];
	$headers = "From: $from";
	
	// boundary 
	$semi_rand = md5(time()); 
	$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
	 
	// headers for attachment 
	$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
	 
	// multipart boundary 
	$message = "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-Type: text/plain; charset=\"iso-8859-1\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n"; 
	$message .= "--{$mime_boundary}\n";
	 
	// preparing attachments
	for($x=0;$x<count($files);$x++){
		$file = fopen($files[$x]['tmp_name'],"rb");
		$data = fread($file,filesize($files[$x]['tmp_name']));
		fclose($file);
		$data = chunk_split(base64_encode($data));
		$name = $files[$x]['name'];
		$message .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"$name\"\n" . 
		"Content-Disposition: attachment;\n" . " filename=\"$name\"\n" . 
		"Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
		$message .= "--{$mime_boundary}\n";
	}
	// send
	 
	$ok = mail($to, $subject, $message, $headers); 
	if ($ok) { 
		//echo "<p>mail sent to $to!</p>"; 
		header("Location: apply_online.php?msg=1");
	} else { 
		//echo "<p>mail could not be sent!</p>"; 
		header("Location: apply_online.php?msg=0");
	} 
}	



}   
// $name = strip_tags(htmlspecialchars($_POST['name']));
// $email_address = strip_tags(htmlspecialchars($_POST['email']));
// $subject = strip_tags(htmlspecialchars($_POST['subject']));
// $message = strip_tags(htmlspecialchars($_POST['message']));
   
// // Create the email and send the message
// $to = 'ceo@uniquegroup.com.pk'; // Add your email address inbetween the '' replacing yourname@yourdomain.com 
// //$to = 'jawadjee0519@gmail.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - - This is where the form will send a message to.
// $email_subject = "Contact Form:  $name";
// $email_body = "You have received a new message from contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\Subject: $subject\n\nMessage:\n$message";
// $headers = "From: info@toursview.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
// $headers .= "Reply-To: $email_address";   
// mail($to,$email_subject,$email_body,$headers);
// //return true;         
// header("Location: contacts?msg=true")
?>
