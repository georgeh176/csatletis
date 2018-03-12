<?php
include_once 'include/database.php';
include_once 'include/function.php';
include_once 'include/email-content.php';
$to      = 'georgehapenciuc@gmail.com';
$subject = 'the subject';
$from = "admin@csatletis.xyz";
// To send HTML mail, the Content-type header must be set

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Create email headers
$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
$message = $accept_mail_content;

    if(mail($to, $subject, $message, $headers)){
        echo 'Your mail has been sent successfully.';
    } else{
        echo 'Unable to send email. Please try again.';
    }
?>
