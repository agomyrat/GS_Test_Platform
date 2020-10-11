<?php

use PHPMailer\PHPMailer\PHPMailer;

function sendMail($address, $dataArray)
{
    require 'vendor/phpmailer/Exception.php';
    require 'vendor/phpmailer/PHPMailer.php';
    require 'vendor/phpmailer/SMTP.php';
    // echo $dataArray['html'];
    // echo ($dataArray['text']);
    // die;
    if (!empty($dataArray['html']) && !empty($dataArray['text'])) {
        $html = $dataArray['html'];
        $text = $dataArray['text'];
        // echo $html;
        // echo $text;die;
        $username = isset($dataArray['username']) ? $dataArray['username'] : '';
        $subject = isset($dataArray['subject']) ? $dataArray['subject'] : 'testSpace';
        try {
            $mail = new PHPMailer(true);
            // mail account settigns
            $mail->isSMTP();
            $mail->charSet = "UTF-8";
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'testspace.tm@gmail.com';                     // SMTP username
            $mail->Password   = '1234567890mm';                               // SMTP password
            $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged

            //mail boldy
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $html;
            $mail->AltBody = $text;


            //Recipients
            $mail->setFrom('testspace.tm@gmail.com', 'testSpace');
            $mail->addAddress($address, $username);     // Add a recipient


            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo 'haysy mail template ugratmalydygy belli dal';
    }
}
