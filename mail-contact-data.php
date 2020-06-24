<?php

require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/*Add following to work with contact form*/
/*
$first_name = $_POST['first_name_data'];		// First name from contact us form
$last_name = $_POST['last_name_data'];			// Last name from Contact us form 
$email = $_POST['email_data'];      			// Contact us form Email Data
$from = ""; 						// >> SMTP Server data/mail provided
$headers= "From: " . $from;         			// Header of the mail content Fixed
$subject = $_POST['subject_data'];  			// Subject of the Contact us form
$message = $_POST['message_data'];  			// Message from the contact us form
$to = ""; 						// >> Who to send to
$msg = "First Name : ".$first_name."</br>Last Name : ".$last_name."</br>Contact Email : ".$email."</br>Message :".$message;
*/

$developmentMode = true;
$mailer = new PHPMailer($developmentMode);

try {
    $mailer->SMTPDebug = 2;
    $mailer->isSMTP();

    if ($developmentMode) {
    $mailer->SMTPOptions = [
        'ssl'=> [
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        ]
    ];
    }


    $mailer->Host = 'smtp.gmail.com';
    $mailer->SMTPAuth = true;
    $mailer->Username = 'SendersApp@email.com';
    $mailer->Password = 'SendersAppPassword';
    $mailer->SMTPSecure = 'tls';
    $mailer->Port = 587;

    $mailer->setFrom('senders@email.com', 'Name');
    $mailer->addAddress('receivers@email.com', 'Name');

    $mailer->isHTML(true);
    $mailer->Subject = 'PHPMailer Test';
    $mailer->Body = 'This is a <b>SAMPLE<b> email sent through <b>PHPMailer<b>';

    $mailer->send();
    $mailer->ClearAllRecipients();
    echo "MAIL HAS BEEN SENT SUCCESSFULLY";

} catch (Exception $e) {
    echo "EMAIL SENDING FAILED. INFO: " . $mailer->ErrorInfo;
}
