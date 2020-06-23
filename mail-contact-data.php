<?php

$first_name = $_POST['first_name_data'];		// First name from contact us form
$last_name = $_POST['last_name_data'];			// Last name from Contact us form 
$email = $_POST['email_data'];      			// Contact us form Email Data
$from = ""; 						// >> SMTP Server data/mail provided
$headers= "From: " . $from;         			// Header of the mail content Fixed
$subject = $_POST['subject_data'];  			// Subject of the Contact us form
$message = $_POST['message_data'];  			// Message from the contact us form
$to = ""; 						// >> Who to send to
$msg = "First Name : ".$first_name."</br>Last Name : ".$last_name."</br>Contact Email : ".$email."</br>Message :".$message;

$msg = wordwrap($msg,1200);

if(mail($to, $subject, $msg, $header))
{
	echo ("Success");
}
else
{
	echo("failed");
}
echo "<h1><center>Thank You<center></h1>";
?>
