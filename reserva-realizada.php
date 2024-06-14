<?php
session_start(); // Inicia la sesión al comienzo del archivo
include 'config/conexion.php';
include 'dashboard/class/travel.php';
$idreserva = isset($_GET['idreserva']) ? intval($_GET['idreserva']) : 0;

include 'dashboard/class/booking.php';
$reserva = Booking::getBookingAllId($idreserva);

if (!empty($reserva)) {
    // Asumiendo que el primer objeto en el array es la reserva principal
    $reservaPrincipal = $reserva[0];
    // Filtrar acompañantes eliminando duplicados por ID
    $acompanantes = array_slice($reserva, 1);
    $acompanantesUnicos = [];
    foreach ($acompanantes as $acompanante) {
        // Eliminar el pasajero principal de la lista de acompañantes
        if ($acompanante->nombrePasajero != $reservaPrincipal->nombrePasajero || 
            $acompanante->apellidosPasajero != $reservaPrincipal->apellidosPasajero) {
            $key = $acompanante->nombrePasajero . $acompanante->apellidosPasajero;
            if (!isset($acompanantesUnicos[$key])) {
                $acompanantesUnicos[$key] = $acompanante;
            }
        }
    }

    // Obtener los asientos únicos
    $asientosUnicos = [];
    foreach ($reserva as $r) {
        if (!in_array($r->asientoNumero, $asientosUnicos)) {
            $asientosUnicos[] = $r->asientoNumero;
        }
    }
}
// $fechaViajeFormateada = date('d \d\e M Y', strtotime($reservaPrincipal->fechaViaje));
// $fechaFinFormateada = date('d \d\e M Y', strtotime($reservaPrincipal->fechaFin));
// var_dump($reserva);

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
                        <p><?= $reservaPrincipal->nombreOrigen ?></p>
                        <span><?= $reservaPrincipal->fechaViajeFormat ?></span>
                    </div>
                    <div style="width: 20%;text-align: center;"></div>
                    <div style="width: 40%;text-align: center;">
                        <p><?= $reservaPrincipal->nombreDestino ?></p>
                        <span><?= $reservaPrincipal->fechaFinFormat ?></span>

                    </div>
                </div>
                <div class="codigo_cosas">
                    <div>CODIGO BOLETO: <?= $reservaPrincipal->correlativoViaje ?></div>
                    <br>
                    <div>PAGO: <p><?php
                       $precio_pagado = $reservaPrincipal->precio_pagado / 100;
                       $precio_formateado = number_format($precio_pagado, 2, '.', '');
                    ?><?= $precio_formateado ?> MXM</p></div>
                </div>
                <div class="boleto_asientos">
                    <p>ASIENTOS:</p>
                    <ul>
                    <?php foreach ($asientosUnicos as $asiento) { ?>
                            <li><img src="assets/img/svg/asiento_vacio.svg" alt=""><p><?= $asiento ?></p></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>  
            <div class="personas_listado" style="background-color: #d7d7d7;
                border-radius: 15px;
                padding: 20px;
                margin: 10px 0px;
                position: relative;
                top: -120px;">

                <h3>Comprador</h3>
                <p><b>Nombre:</b> <?= $reservaPrincipal->nombrePasajero ?></p>
                <p><b>Apellido:</b> <?= $reservaPrincipal->apellidosPasajero ?></p>
                <p><b>Correo:</b> <?= $reservaPrincipal->correoPasajero ?></p>
                <p><b>Celular:</b> <?= $reservaPrincipal->celularPasajero ?></p>

                <h3>Acompañantes</h3>
                <?php 
                $acompananteIndex = 1;
                foreach ($acompanantesUnicos as $acompanante) { ?>
                    <p><b><?= $acompananteIndex ?>:</b> <?= $acompanante->nombrePasajero ?> <?= $acompanante->apellidosPasajero ?></p>
                    <?php $acompananteIndex++; ?>
                <?php } ?>                    
            </div>
        </div>
    </section>
</body>
</html>