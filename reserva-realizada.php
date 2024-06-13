<?php
session_start(); // Inicia la sesión al comienzo del archivo
include 'config/conexion.php';
include 'dashboard/class/travel.php';
$idreserva = isset($_GET['idreserva']) ? intval($_GET['idreserva']) : 0;

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
        padding: 10px 20px 30px;
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
</style>
<body>
    <section>
        <div style="max-width: 450px;background-color: #f2f2f2;border-radius: 15px;margin: auto;padding: 10px;">
            <div><img src="assets/img/boleto.png" alt="" style="width: 100%;border-radius: 15px;"></div>
            <div class="boleto">
                <div class="cabza">
                    <div style="width: 40%;text-align: center;">
                        <p>PERU</p>
                        <span>2024-06-11 23:36:00</span>
                    </div>
                    <div style="width: 20%;text-align: center;"></div>
                    <div style="width: 40%;text-align: center;">
                        <p>COLOMBIA</p>
                        <span>2024-06-11 23:36:00</span>
                    </div>
                </div>
                <div class="codigo_cosas">
                    <div>CODIGO BOLETO: TSB-001</div>
                    <br>
                    <div>PAGO: <p>500 MXM</p></div>
                </div>
                <div class="boleto_asientos">
                    <p>ASIENTOS:</p>
                    <ul>
                        <li><img src="assets/img/svg/asiento_vacio.svg" alt=""><p>A1</p></li>
                        <li><img src="assets/img/svg/asiento_vacio.svg" alt=""><p>A2</p></li>
                        <li><img src="assets/img/svg/asiento_vacio.svg" alt=""><p>A3</p></li>
                    </ul>
                </div>
            </div>  
            <div style="background-color: #d7d7d7;
            border-radius: 15px;
            padding: 10px;
            margin: 10px 0px;
            position: relative;
            top: -120px;">

                <h3>Comprador</h3>
                <p><b>Nombre:</b> Carlos Smith</p>
                <p><b>Apellido:</b> Martinez Meneses</p>
                <p><b>Correo:</b> cmartinez.meneses1@gmail.com</p>

                <h3>Acompañantes</h3>
                <p><b>1:</b> Miguel Martinez</p>
                <p><b>2:</b> Angel Martinez</p>                
            </div>
        </div>
    </section>
</body>
</html>