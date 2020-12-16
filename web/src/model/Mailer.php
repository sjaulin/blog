<?php

namespace App\src\model;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer
{

    public function sendmail($from_mail, $from_name, $to_mail, $to_name, $subject, $message)
    {
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
            $mail->isSMTP(); // Send using SMTP
            $mail->Host       = SMTP_HOST; // Set the SMTP server to send through
            $mail->SMTPAuth   = true; // Enable SMTP authentication
            $mail->Username   = SMTP_USERNAME; // SMTP username
            $mail->Password   = SMTP_PASSWORD; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            $mail->CharSet = 'UTF-8';

            //Recipients
            $mail->setFrom(SITE_FROM_MAIL, SITE_FROM_NAME);
            $mail->addAddress($to_mail, $to_name);
            $mail->addReplyTo($from_mail, $from_name);

            // Content
            $mail->Subject = !empty($subject) ? $subject : 'Message from site';
            $mail->Body    = !empty($message) ? $message : '';
            $mail->AltBody = !empty($message) ? strip_tags($message) : '';

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
