<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';
require './vendor/phpmailer/phpmailer/src/Exception.php';
require './vendor/phpmailer/phpmailer/src/PHPMailer.php';
require './vendor/phpmailer/phpmailer/src/SMTP.php';



function sendMailer($mailexpediteur,$passwordmail,$mailrecepteur,$object,$message)
{
  ///////////////
  // POUR QUE CELA FONCTIONNE AVEC GMAIL : https://myaccount.google.com/security // "Accès moins sécurisé à des applications" doit être activé sur votre compte.
  ///////////////

  $mail = new PHPMailer(true);

  try {

      $mail->SMTPDebug = 0;
      // Mettre 4 pour faire des test

      $mail->isSMTP();

      //// Host gmail = 'smtp.gmail.com';
      $mail->Host = 'smtp.laposte.net';
      $mail->SMTPAuth = true;
      $mail->Username = $mailexpediteur;
      $mail->Password = $passwordmail;
      $mail->SMTPSecure = 'ssl';

      $mail->Port = 465;


      $mail->setFrom($mailexpediteur);
      $mail->addAddress($mailrecepteur);

      // Content
      $mail->isHTML(true);
      $mail->Subject = $object;
      $mail->Body = $message;


      $mail->send();
      echo 'Message envoyé';
  } catch (Exception $e) {
      echo "Mail ne peut être envoyé, erreur : {$mail->ErrorInfo}";
  }
}
