<?php

use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

//atyljak mail maglumatlary
$username = 'Agamyrat Chariyev';
$email = 'agamyrat.chariyev@gmail.com';
$link = '/access/verifymailaddress/dj8j8d28dn3Hs2355dDA';
$url = 'http://testspace.com.tm';

try {
    $mail = new PHPMailer(true);
    // mail account settigns
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'testspace.tm@gmail.com';                     // SMTP username
    $mail->Password   = '1234567890mm';                               // SMTP password
    $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged



    //mail boldy
    $mail->isHTML(true);
    $mail->Subject = 'Here is the subject';
    $mail->Body    = '<!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8" />
                        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                        <link rel="stylesheet" href="css/verification.css" />
                        <link
                        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;700&display=swap"
                        rel="stylesheet"
                        />
                        <title>Verify Email</title>
                    </head>
                    
                    <body style="background-color: #f5f5f5;">
                        <div
                        class="content"
                        style="
                            background-color: #fff;
                            max-width: 600px;
                            width: 98%;
                            margin: 2em auto;
                        "
                        >
                        <div style="text-align: center;">
                            <img src="https://previews.123rf.com/images/bbtreesubmission/bbtreesubmission1711/bbtreesubmission171104909/90802424-postman-delivery-mail-vector-illustration-.jpg" alt="" style="width: 98%; max-width: 400px;" />
                        </div>
                        <h2 style="text-align: center;">Lorem, ipsum dolor.</h2>
                        <p style="text-align: center;">
                            Bu Email TestSpace test platformasy tarapyndan iberildi. Test
                            platformasynda acan hasabynyzy aktiwlesdirmek ucin asakdaky duwma
                            basmagynyzy hayys edyaris
                        <div style="font-size: 14px; display: inline-block; margin:10px auto;color:#fff;border-radius: 5px; padding:10px 10px; background-color:#fc7318;"><strong><a href="""></a> AKTIW ET</strong></div>
                        </p>
                        </div>
                        <p class="footer" style="text-align: center; padding-top:15px">
                        
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus odit impe
                        <hr>
                        Turkmenistar Ashgabat tel:+993 63384289
                        </p>
                    </body>
                    </html>
                    ';
    $mail->AltBody = 'Bu mail testSpace.com.tm sahypasyndan atyldy. Sizin linkynyz:' . $url . $link;


    //Recipients
    $mail->setFrom('testspace.tm@gmail.com', 'Test Space');
    $mail->addAddress($email, $username);     // Add a recipient


    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
