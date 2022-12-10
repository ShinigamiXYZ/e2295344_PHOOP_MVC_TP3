<?php

/***
 * 
 * Source multiple
 * Principalement sur ->
 * https://packagist.org/packages/phpmailer/phpmailer
 * https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting
 * https://stackoverflow.com/questions/66506373/how-to-hide-the-logs-of-phpmailer
 * 
 */

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
class ModelMail {
    public function SendEmail(){


        //Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);


    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;  /* SMTP::DEBUG_SERVER;   */    //toggle for troubleshooting      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'shinigami.gym@gmail.com';                     //SMTP username
    $mail->Password   = 'hmppixfxnyaijwvy';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients

    $mail->addAddress($_POST['email']);   
 
  

    
    //Content
    $mail->isHTML(true);                                
    $mail->Subject = 'Bienvenue';
    $mail->Body    = 'Bonjour, ' . $_POST['nom'] . ' et bienvenu dans la famille du Shinigami Gym';
 
    $mail->send();
   /*  echo 'Message has been sent'; Toggle in troubleshooting mode*/ 

    }
}