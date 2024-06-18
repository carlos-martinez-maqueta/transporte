<?php
require_once 'mailer/lib/PHPMailer/Exception.php';
require_once 'mailer/lib/PHPMailer/PHPMailer.php';
require_once 'mailer/lib/PHPMailer/SMTP.php';
require_once 'mailer/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

            // Envío de correo electrónico
            $enviomail = "cmartinez.meneses1@gmail.com"; // Cambia esta dirección de correo
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'mail.valuepay.online';
            $mail->SMTPAuth = true;
            $mail->Username = 'no-reply@valuepay.online';
            $mail->Password = 'gwkdWZvQ26cPzKi';
            $mail->Port = 587;
        
            $mail->setFrom('no-reply@valuepay.online', 'Transporte Safe');
            // $mail->addAddress($correo);
            $mail->addAddress($enviomail);
            $mail->Subject = 'Gracias por tu compra - Transporte Safe';
            $mail->CharSet = 'UTF-8';
            $mail->isHTML(true);
        
            $messages =  '
            <div style="max-width: 450px;">
                <img src="https://transportesafe.com/assets/img/logo.png" alt="">
                <h2>Estimado '.$nombre.',</h2>
                <p>Gracias por reservar en Transporte Safe. <br> 
                    El detalle de su reserva está detallado en el siguiente QR, <br> queremos expresarle nuestra gratitud y confianza. </p> 
                
                
                <img src="https://transportesafe.com/post/qr_user/'.$qr_filename.'" alt="" style="width: 150px;">
            </div>
            ';
        
            $mail->Body = $messages;
        
            // Enviar el correo de confirmación
            if ($mail->send()) {
                echo 'El correo de confirmación se ha enviado correctamente.';
            } else {
                echo 'Hubo un error al enviar el correo de confirmación: ' . $mail->ErrorInfo;
            }

?>