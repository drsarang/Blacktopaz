<?php

require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

ob_start();

/*Add following to work with contact form*/

$first_name = $_POST['first_name_data'];				// First name from contact us form
$last_name = $_POST['last_name_data'];					// Last name from Contact us form 
$email = $_POST['email_data'];      					// Contact us form Email Data
$from = "sales.blacktopaz@gmail.com";					// >> SMTP Server data/mail provided
$from_passwd ="x";					// >> Sender Password
$from_name = "BlackTopaz";						// >> Sender Name
$subject = $_POST['subject_data'];  					// Subject from the Contact us form
$message = $_POST['message_data'];		  			// Message from the contact us form
$to = "x"; 					// >> Who to send to
$to_name = "x";						// >> Receiver's Name
$mail_subject = "Sales Blacktopaz";					// >> Subject for the mail received by receiver

/* HTML Mail Body */

$msg = '<html><body><table style="border-collapse:collapse;border-spacing:0" class="tg"><thead><tr><th style="background-color:#c0c0c0;border-color:black;border-style:solid;border-width:1px;color:#343434;font-family:Tahoma, Geneva, sans-serif !important;;font-size:16px;font-weight:bold;overflow:hidden;padding:10px 5px;text-align:left;vertical-align:top;word-break:normal">First Name</th><th style="background-color:#c0c0c0;border-color:black;border-style:solid;border-width:1px;color:#343434;font-family:Tahoma, Geneva, sans-serif !important;;font-size:16px;font-weight:normal;overflow:hidden;padding:10px 5px;text-align:left;vertical-align:top;word-break:normal">'.$first_name.'</th></tr></thead><tbody><tr><td style="border-color:black;border-style:solid;border-width:1px;color:#343434;font-family:Tahoma, Geneva, sans-serif !important;;font-size:16px;font-weight:bold;overflow:hidden;padding:10px 5px;text-align:left;vertical-align:top;word-break:normal">Last Name</td><td style="border-color:black;border-style:solid;border-width:1px;color:#343434;font-family:Tahoma, Geneva, sans-serif !important;;font-size:16px;overflow:hidden;padding:10px 5px;text-align:left;vertical-align:top;word-break:normal">'.$last_name.'</td></tr><tr><td style="background-color:#c0c0c0;border-color:black;border-style:solid;border-width:1px;color:#343434;font-family:Tahoma, Geneva, sans-serif !important;;font-size:16px;font-weight:bold;overflow:hidden;padding:10px 5px;text-align:left;vertical-align:top;word-break:normal">Email</td><td style="background-color:#c0c0c0;border-color:black;border-style:solid;border-width:1px;color:#343434;font-family:Tahoma, Geneva, sans-serif !important;;font-size:16px;overflow:hidden;padding:10px 5px;text-align:left;vertical-align:top;word-break:normal">'.$email.'</td></tr><tr><td style="border-color:black;border-style:solid;border-width:1px;color:#343434;font-family:Tahoma, Geneva, sans-serif !important;;font-size:16px;font-weight:bold;overflow:hidden;padding:10px 5px;text-align:left;vertical-align:top;word-break:normal">Subject</td><td style="border-color:black;border-style:solid;border-width:1px;color:#343434;font-family:Tahoma, Geneva, sans-serif !important;;font-size:16px;overflow:hidden;padding:10px 5px;text-align:left;vertical-align:top;word-break:normal">'.$subject.'</td></tr><tr><td style="background-color:#c0c0c0;border-color:black;border-style:solid;border-width:1px;color:#343434;font-family:Tahoma, Geneva, sans-serif !important;;font-size:16px;font-weight:bold;overflow:hidden;padding:10px 5px;text-align:left;vertical-align:top;word-break:normal">Message</td><td style="background-color:#c0c0c0;border-color:#000000;border-style:solid;border-width:1px;color:#343434;font-family:Tahoma, Geneva, sans-serif !important;;font-size:16px;overflow:hidden;padding:10px 5px;text-align:left;vertical-align:top;word-break:normal">'.$message.'</td></tr></tbody></table></body></html>';

$developmentMode = false;
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
    $mailer->Username = $from;
    $mailer->Password = $from_passwd;
    $mailer->SMTPSecure = 'tls';
    $mailer->Port = 587;

    $mailer->setFrom($from , $from_name);
    $mailer->addAddress($to , $to_name );

    $mailer->isHTML(true);
    $mailer->Subject = $mail_subject;
    $mailer->Body = $msg;
    $mail->SMTPDebug = 0;
    if($mailer->send()){
	    header( "Location:thankyou.html" );
	    ob_end();
    }
    else{
	    header( "Location:error.html" );
	    ob_end();
    }
    $mailer->ClearAllRecipients();
    echo "MAIL HAS BEEN SENT SUCCESSFULLY";

} catch (Exception $e) {
    echo "EMAIL SENDING FAILED. INFO: " . $mailer->ErrorInfo;
}
