<?php
include 'config/conexion.php';
include 'dashboard/class/travel.php';
session_start(); // Inicia la sesión al comienzo del archivo
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
        .section_reserva_pay .ticket_personas{

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
                    <div class="border_azul"><img src="assets/img/svg/step_2_azul.svg" class="me-2" alt="">Datos de Pasajeros</div>
                </div>
                <div class="col-lg-1 text-center">
                    <img src="assets/img/svg/saltos.svg" alt="">
                </div>
                <div class="col-lg-2">
                    <div class="border_blanco"><img src="assets/img/svg/step_3.svg" class="me-2" alt="">Pago</div>
                </div>
            </div>
        </div>
    </section>
    <style>
        .mapa_asientos{
            margin: 50px 0px 0px;
        }
        .mapa_asientos ul{
            display: flex;
            align-items: center;
            padding: 0px;
            list-style: none;
        }
        .mapa_asientos ul li{
            margin: 0px 10px 0px 0px;
        }
        .mapa_asientos ul li img{
            margin: 0px 10px 0px 0px;
        }
        .auto_seleccionar{
            padding: 60px 0px;
            box-shadow: 0px 3px 6px 0px #888888;
        }
        .auto_seleccionar .auto_img{
            background: url(assets/img/svg/auto.png);
            width: 100%;
            height: 250px;
            background-position: center;
            background-repeat: no-repeat;
            background-size: contain;    
            position: relative;        
        }
        .auto_seleccionar .auto_img ul{
            padding: 47px 194px 47px 60px;
            list-style: none;
            position: absolute;
            width: 100%;
            height: 100%;
            margin: 0px;
            display: flex;
            flex-wrap: wrap;
        }
        .auto_seleccionar .auto_img ul li{
            display: flex;
            align-items: center;
        }
    </style>
    <section class="section_datos_personales">
        <form action="reserva" method="GET">
            <input type="hidden" name="idviaje" value="<?php echo $viajeid ?>">
            <input type="hidden" name="pasajeros" value="<?php echo $pasajeros ?>">            
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="datos_personas">
                            <h4>Seleccionar Asientos</h4>
                            <div class="mapa_asientos">
                                <ul>
                                    <li><p><img src="assets/img/svg/disponible.svg" alt="">Asiento Disponible</p></li>
                                    <li><p><img src="assets/img/svg/no-disponible.svg" alt="">Asiento no Disponible</p></li>
                                    <li><p><img src="assets/img/svg/seleccionado.svg" alt="">Asientos Seleccionado</p></li>
                                </ul>
                            </div>

                            <div class="auto_seleccionar">
                                <div class="auto_img">
                                    <ul>
                                        <li><a href=""><img src="assets/img/svg/asiento_vacio.svg" alt=""></a></li>
                                        <li><a href=""><img src="assets/img/svg/asiento_vacio.svg" alt=""></a></li>
                                        <li><a href=""><img src="assets/img/svg/asiento_vacio.svg" alt=""></a></li>
                                        <li><a href=""><img src="assets/img/svg/asiento_vacio.svg" alt=""></a></li>
                                        <li><a href=""><img src="assets/img/svg/asiento_vacio.svg" alt=""></a></li>
                                        <li><a href=""><img src="assets/img/svg/asiento_vacio.svg" alt=""></a></li>
                                        <li><a href=""><img src="assets/img/svg/asiento_vacio.svg" alt=""></a></li>
                                        <li><a href=""><img src="assets/img/svg/asiento_vacio.svg" alt=""></a></li>
                                        <li><a href=""><img src="assets/img/svg/asiento_vacio.svg" alt=""></a></li>
                                        <li><a href=""><img src="assets/img/svg/asiento_vacio.svg" alt=""></a></li>
                                        <li><a href=""><img src="assets/img/svg/asiento_vacio.svg" alt=""></a></li>
                                        <li><a href=""><img src="assets/img/svg/asiento_lleno.svg" alt=""></a></li>
                                        <li><a href=""><img src="assets/img/svg/asiento_vacio.svg" alt=""></a></li>
                                        <li><a href=""><img src="assets/img/svg/asiento_vacio.svg" alt=""></a></li>
                                        <li><a href=""><img src="assets/img/svg/asiento_seleccionado.svg" alt=""></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>                   
                    </div>
                    <div class="col-lg-6 px-5">
                        <?php include 'views/vista-resumen-ticket.php' ?>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <?php include 'app/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
 
    </body>
</html>