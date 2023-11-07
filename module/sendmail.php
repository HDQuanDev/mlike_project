<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../Mail/src/Exception.php';
require '../Mail/src/PHPMailer.php';
require '../Mail/src/SMTP.php';

function send_mail($mail){
    //global use;



// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
   // $mail->SMTPDebug = SMTP::DEBUG_SERVER;// Enable verbose debug output
    $mail->isSMTP();// gửi mail SMTP
    $mail->Host = 'ssl://svmlike.fun';// Set the SMTP server to send through
    $mail->SMTPAuth = true;// Enable SMTP authentication
    $mail->Username = 'mlike@svmlike.fun';// SMTP username
    $mail->Password = 'sbLv&eEDX8Ht'; // SMTP password
  //$mail->SMTPSecure = 'ssl';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;// Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port = 465; // TCP port to connect to

    //Recipients
    $mail->setFrom('mlke@svmlike.fun', 'Support MLIKE');
    $mail->addAddress('maiyeuem608@gmail.com', 'Lươn Thanh Sang'); // Add a recipient
    $mail->addReplyTo('quancp72h@gmail.com', 'Hứa Đức Quân');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz'); // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg'); // Optional name

    // Content
    $mail->CharSet = 'UTF-8';
    $mail->isHTML(true);   // Set email format to HTML
    $mail->Subject = 'Có đơn hàng like tay mới';
    $mail->Body = 'Vào check nào abc mail nef';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    $quan = 'done';
} catch (Exception $e) {
    $quan = "error";
}
return $quan;
}

echo send_mail('maiyeuem608@gmail.com');