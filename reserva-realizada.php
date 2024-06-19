<?php
include 'config/conexion.php';
include 'dashboard/class/travel.php';
include 'dashboard/class/origin.php';
include 'dashboard/class/mobility.php';
include 'dashboard/class/asientos.php';
include 'dashboard/class/booking.php';

session_start(); // Inicia la sesión al comienzo del archivo
include 'get/info-viaje-dos.php';

$reserva = isset( $_GET['reserva']) ?  $_GET['reserva'] : null;

$objReserva = Booking::getBookingVentasId($reserva);
$objAsiento = Booking::getSeatsPassengersId($reserva);
$objPersonas = Booking::getBookingPassengersId($reserva);
// var_dump($objPersonas);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
    .boleto{
        background: url(assets/img/fondo-boleto.png);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        border-radius: 15px;
        padding: 18px 20px 30px;
        position: relative;
        top: -133px;
        width: 90%;
        margin: auto;
    }
    .boleto p{
        font-weight: bold;
    }
    .codigo_cosas{
        padding: 10px 20px;
        margin: 25px 0px 20px;
        font-weight: bold;
        align-items: center;
        justify-content: space-between !important;
        border-bottom: 2px dotted #8e8e8e;
    }
    .codigo_cosas p{
        font-size: 40px;
        margin: 0px;
        color: #054ab3;
    }
    .cabza{
        display: flex;
        align-items: center;
        padding: 10px 10px 10px;
        background-color: #f2f2f2;
        border-radius: 15px;
    }
    .boleto_asientos ul{
        display: flex;
        align-items: center;
        padding: 0px;
        margin: auto;
        list-style: none;
        width: fit-content;
    }
    .boleto_asientos ul li{
        position: relative;
        width: auto;
    }
    .boleto_asientos ul li p{
        position: absolute;
        top: 13px;
        font-size: 12px;
        left: 10px;
    }
    h3{
        text-transform: uppercase;
        font-size: 16px;
    }
    .personas_listado p{
        font-size: 14px;
    }
</style>
<body>
    <section>
        <div style="max-width: 450px;background-color: #f2f2f2;border-radius: 15px;margin: auto;padding: 10px;">
            <div><img src="assets/img/boleto.png" alt="" style="width: 100%;border-radius: 15px;"></div>
            <div class="boleto">
                <div class="cabza">
                    <div style="width: 40%;text-align: center;">
                        <p><?=$ticketObj->origen;?></p>
                        <span><?=$ticketObj->hora_salida;?></span>
                    </div>
                    <div style="width: 20%;text-align: center;"></div>  
                    <div style="width: 40%;text-align: center;">
                        <p><?=$ticketObj->destino;?></p>
                        <span><?=$ticketObj->hora_llegada;?></span>

                    </div>
                </div>
                <div class="codigo_cosas">
                    <div>CODIGO BOLETO: <?=$viajeObj->correlativo?></div>
                    <br>
                    <div>PAGO: <p><?=$objReserva->precio_pagado;?> MXM</p></div>
                </div>
                <div class="boleto_asientos">
                    <p>ASIENTOS:</p>
                    <ul>
                        <?php
                            foreach ($objAsiento as $asiento) {
                                echo "<li><img src='assets/img/svg/asiento_vacio.svg' alt=''><p>{$asiento->asiento}</p></li>";
                            }
                        ?>
                      
                    </ul>
                </div>
            </div>  
            <div class="personas_listado" style="background-color: #d7d7d7;
                border-radius: 15px;
                padding: 20px;
                margin: 10px 0px;
                position: relative;
                top: -120px;">

                <?php $comprador = $objPersonas[0]; 
            echo "<h3>Comprador</h3>";
            echo "<p><b>Nombre:</b> {$comprador->nombre}</p>";
            echo "<p><b>Apellido:</b> {$comprador->apellidos}</p>";
            echo "<p><b>Correo:</b> " . ($comprador->correo ? $comprador->correo : 'N/A') . "</p>";
            echo "<p><b>Celular:</b> " . ($comprador->celular ? $comprador->celular : 'N/A') . "</p>";

 
                                
                if (count($objPersonas) > 1) {
            echo "<h3>Acompañantes</h3>";
            for ($i = 1; $i < count($objPersonas); $i++) {
                $acompanante = $objPersonas[$i];?>
                <div class="d-flex">
                    <div class="me-2"><p><b>Nombre:</b>  <?=$acompanante->nombre?> </p></div> 
                    <div class="me-2"><p><b>Apellido:</b>  <?=$acompanante->apellidos?> </p> </div>
                </div>
                <?php  }
        }?>
            </div>
        </div>
    </section>
</body>
</html>