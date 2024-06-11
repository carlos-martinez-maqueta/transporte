<?php
session_start(); // Inicia la sesión al comienzo del archivo
include 'config/conexion.php';
include 'dashboard/class/travel.php';

include 'get/info-viaje.php';
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
    <style>
        body{
            background-color: #ffffff;
        }
        header{
            border-bottom: 1px solid #000000;
        }
    </style>
  <body>
    <?php include 'app/header-home.php' ?>
 
    <section class="section_steps">
        <div class="container">
            <div class="row align-items-center justify-content-md-center">
                <div class="col-lg-2">
                    <div class="border_blanco"><img src="assets/img/svg/step_1.svg" class="me-2" alt="">Seleccionar Boletos</div>
                </div>
                <div class="col-lg-1 text-center">
                    <img src="assets/img/svg/saltos.svg" alt="">
                </div>
                <div class="col-lg-2">
                    <div class="border_blanco"><img src="assets/img/svg/step_2_done.svg" class="me-2" alt="">Datos de Pasajeros</div>
                </div>
                <div class="col-lg-1 text-center">
                    <img src="assets/img/svg/saltos.svg" alt="">
                </div>
                <div class="col-lg-2">
                    <div class="border_azul"><img src="assets/img/svg/step_pago.svg" class="me-2" alt="">Pago</div>
                </div>
            </div>
        </div>
    </section>
 
    <section class="section_datos_personales section_reserva_pay">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 px-5">
                    <?php include 'views/vista-resumen-ticket.php' ?>
                </div>
                <div class="col-lg-6">
                    <!-- Display a payment form -->
                    <div id="checkout" class="">
                        <!-- Checkout will insert the payment form here -->
                    </div>
                </div>                
            </div>
        </div>
    </section>
    <style>
        .container_cupones{
            padding: 30px;
            box-shadow: 0px 3px 6px 0px #888888;
            margin: 0px 0px 30px 0px;
        }
        .container_cupones h3{
            font-size: 24px;
            color: #6E6E6E;
            font-weight: 400;
        }
        .container_cupones .input_cupon{
            width: 70%;
        }
        .container_cupones .input_cupon input{
            height: 50px;
            border: 1px solid #575757;
        }
        .container_cupones .button_cupon{
            width: 30%;
            text-align: center;
        }
        .container_cupones .button_cupon button{
            height: 50px;
            background-color: #D9D9D9;
            color: #000000;
            width: 90%;
        }
        .section_reserva_pay .item_conteo{
            justify-content: space-between !important;
            color: #828282 !important;
            padding: 20px 10px !important;
        }
        .section_reserva_pay .ticket_personas .list_tickets_total{
            margin: 10px 0px;
        }
        .section_reserva_pay .ticket_personas .btn_next_step{
            display: none;
        }
        .ticket_reserva p{
            font-size: 13px;
            color: #4E4E4E;
        }
        .ticket_reserva p a{
            color: #4E4E4E;
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
    <?php include 'app/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="stripe/index.js" defer></script>
    <!-- <script>
        const totalBoletos = 
        console.log("Total Boletos:", totalBoletos); // Debug: Verifica que el valor se captura correctamente
    </script> -->
    </body>
</html>