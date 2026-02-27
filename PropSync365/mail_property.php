<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* LOAD PHPMailer */
require_once __DIR__ . '/PHPMailer/Exception.php';
require_once __DIR__ . '/PHPMailer/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/SMTP.php';

function sendPropertyStatusMail($toEmail,$toName,$subject,$message)
{
    $mail = new PHPMailer(true);

    try {

        /* SMTP SETTINGS */
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'propsync365@gmail.com';      // CHANGE
        $mail->Password   = 'icht wtta jqcx wlto';        // CHANGE
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        /* EMAIL INFO */
        $mail->setFrom('propsync365@gmail.com', 'PropSync365');
        $mail->addAddress($toEmail, $toName);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();

        return true;

    } catch (Exception $e) {
        return false;
    }
}
?>