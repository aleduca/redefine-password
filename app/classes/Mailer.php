<?php

namespace app\classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    public function send(string $from, string $to, string $token)
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '62a10a41445609';
            $mail->Password = 'b31431694ea877';
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            //Recipients
            $mail->setFrom($from);
            $mail->addAddress($to);

            $message = <<<HTML
                <p>Olá {$to}</p>

                <p>Você pediu para redefinir sua senha do site tal, clique no link abaixo</p>
                <p><a href="http://localhost:8000/password/redefine/{$token}">Redefinir sua senha</a></p>
            HTML;

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Redefina sua senha';
            $mail->Body = $message;
            $mail->CharSet = 'UTF-8';

            return $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
