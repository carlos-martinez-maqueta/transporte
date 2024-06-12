<?php
include 'config/conexion.php';
include 'dashboard/class/travel.php';
session_start(); // Inicia la sesión al comienzo del archivo
include 'get/info-viaje.php';
 
 


require_once 'mailer/lib/PHPMailer/Exception.php';
require_once 'mailer/lib/PHPMailer/PHPMailer.php';
require_once 'mailer/lib/PHPMailer/SMTP.php';
require_once 'mailer/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


    $nombre = 'Carlos Martinez';


        // Envío de correo electrónico
        $correo = "cmartinez.meneses1@gmail.com"; // Cambia esta dirección de correo
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'mail.valuepay.online';
        $mail->SMTPAuth = true;
        $mail->Username = 'no-reply@valuepay.online';
        $mail->Password = 'gwkdWZvQ26cPzKi';
        $mail->Port = 587;

        $mail->setFrom('no-reply@valuepay.online', 'NOTIFICACIONES CONEXA');
        // $mail->addAddress($correo);
        $mail->addAddress($correo);
        $mail->Subject = 'XXX';
        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true);

        $messages =  '
        <div style="max-width: 450px;">
            <img src="https://kingdomyouube.com/images/logo.png" alt="">
            <h2>Estimado '.$nombre.',</h2>
            <p>Gracias por reservar en Transporte Safe. <br> 
                El detalle de su reserva está detallado en el siguiente QR, <br> queremos expresarle nuestra gratitud y confianza. </p> 
            
            
            <img src="https://kingdomyouube.com/images/cas.png" alt="" style="width: 150px;">
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
<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
 
    <link rel="stylesheet" href="assets/css/main.css">
  </head>
  <body>

    <?php include 'app/header-home.php' ?>
    <style>
        .sections_pay_done .pay_done h3{
            margin: 10px 0px 30px;
            color: #034A26;
        }
        .sections_pay_done .pay_done .send_mail{
            padding: 20px;
            background-color: #31bb73a3;
            color: #034A26;
            
        }
        .sections_pay_done .pay_done .div_borders .resumen_ticket{
             background-color: #ffffff;
            /*padding: 30px;
            border-radius: 15px; */
        }
        .sections_pay_done .pay_done .div_borders .ticket_personas{
            background-color: #ffffff;
        }
        .sections_pay_done .pay_done .div_borders .ticket_personas .item_conteo{
            padding: 0px;
        }
        .sections_pay_done .pay_done .div_borders .ticket_personas .btn_next_step{
            display: none;
        }
    </style>
    <section class="sections_pay_done py-5 section_datos_personales">
        <div class="container">
            <div class="row     align-items-center">
                <div class="col-lg-6">
                    <div><img src="assets/img/login.png" alt=""></div>
                </div>
                <div class="col-lg-6">
                    <div class="pay_done">
                        <h3>Gracias por tu Compra!</h3>

                        <p class="send_mail">Tus boletos serán enviados a <b>correo@gmail.com</b></p>
                        <div class="div_borders">
                            <?php include 'views/vista-resumen-ticket.php' ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <?php include 'app/footer.php' ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/contenido.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    </body>
</html>