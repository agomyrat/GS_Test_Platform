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
    $mail->Body    = '
                    <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Verify Email</title>
  </head>

<body style="background-color: #f5f5f5;padding-bottom:20px;">
  <div class="content" style="background-color: #fff; max-width: 600px; width: 98%; margin: 2em auto; padding:10px; ">
    <div style="text-align: center;">
      <img src="https://previews.123rf.com/images/bbtreesubmission/bbtreesubmission1711/bbtreesubmission171104909/90802424-postman-delivery-mail-vector-illustration-.jpg" alt="" style="width: 98%; max-width: 400px;" />
    </div>
    <div style="text-align: center; text-transform: uppercase; font-size: 35px; word-break: break-word;    font-family: Roboto, Tahoma, Verdana, Segoe, sans-serif; color: #052d3d;">
      Lorem, ipsum dolor.
    </div>
    <div style="text-align: center; font-size: 20px;margin: 15px auto; font-weight: bold; word-break: break-word;    font-family: Roboto, Tahoma, Verdana, Segoe, sans-serif; color: #2190e3;">
      Agamyrat Chariyev.
    </div>
    <p style="text-align: center; font-family: Roboto, Tahoma, Verdana, Segoe, sans-serif;font-size:14px;">
      Bu Email TestSpace test platformasy tarapyndan iberildi. Test
      platformasynda acan hasabynyzy aktiwlesdirmek ucin asakdaky duwma
      basmagynyzy hayys edyaris
      <br><br>
      <div style="display: inherit; margin:10px auto; border-radius: 5px; padding:10px 20px; background-color:#fc7318; width:80px; text-align: center;">
        <a href="" style="font-size: 13px; text-decoration: none; color:#fff;font-family: Roboto, Tahoma, Verdana, Segoe, sans-serif;font-weight: bold;">
          AKTIW ET
        </a>
      </div>
    </p>  
  </div>
  <div class="footer" style="text-align: center; padding:14px 5px;font-size:14px; max-width: 400px; width: 98%; margin: 2em auto; color:#555555;font-family: Roboto, Tahoma, Verdana, Segoe, sans-serif;">
    Bu mail testSpace platformasyndan atomatiki şekilde atyldy. Mumkin bolsa bu  maily jogaplamaň
    <br>
    <br>
    <hr>
    <br>

    Turkmenistar | Ashgabat | +993 63384289
  </div>
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
