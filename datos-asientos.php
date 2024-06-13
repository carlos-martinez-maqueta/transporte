<?php
include 'config/conexion.php';
include 'dashboard/class/travel.php';
include 'dashboard/class/plantilla.php';
include 'dashboard/class/mobility.php';
include 'dashboard/class/asientos.php';
session_start(); // Inicia la sesión al comienzo del archivo
include 'get/info-viaje.php';


$descuentoboleto = $totalboletos / 2;
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
 
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/mobile.css">
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
        .terminos_asientos{}
    </style>
  <body>
    <?php include 'app/header-home.php' ?>
 
    <section class="section_steps">
        <div class="container">
            <div class="row align-items-center justify-content-center justify-content-md-center ">
                <div class="col-xl-2 col-lg-3 col-md-4 col-3">
                    <div class="border_blanco"><img src="assets/img/svg/step_1.svg" class="me-2 img_icon" alt="">Seleccionar Boletos</div>
                </div>
                <div class="col-xl-1 col-lg-1 col-md-1 col-1 text-center">
                    <img src="assets/img/svg/saltos.svg" alt="">
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-3">
                    <div class="border_azul"><img src="assets/img/svg/step_2_azul.svg" class="me-2 img_icon" alt="">Datos de Pasajeros</div>
                </div>
                <div class="col-xl-1 col-lg-1 col-md-1 col-1 text-center">
                    <img src="assets/img/svg/saltos.svg" alt="">
                </div>
                <div class="col-xl-2 col-lg-3 col-md-2 col-3">
                    <div class="border_blanco"><img src="assets/img/svg/step_3.svg" class="me-2 img_icon" alt="">Pago</div>
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
            /* background: url(assets/img/svg/auto.png); */
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
        .section_datos_personales .item_conteo .precio_conteo b{
            text-decoration: line-through;
            font-weight: 600;
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
                            <style>
                                .bus-layout {
                                    display: grid;
                                    grid-template-columns: repeat(5, 1fr); /* 5 columnas */
                                    grid-gap: 10px;
                                    max-width: 600px;
                                    margin: auto;
                                }
                                .asiento {
                                    position: relative;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                     
                                    height: 50px;
                                    width: 50px;
                                }
                                .asiento.reservado span{
                                    color: #ffffff;
                                }
                                .asiento img {
                                    width: 100%;
                                    height: auto;
                                }
                                .asiento.disponible{
                                    cursor: pointer;
                                }
                                .driver-seat {
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    border: 1px solid black;
                                    font-size: 11px;
                                    height: 50px;
                                    width: 50px;
                                }
                                .empty-space {
                                    height: 50px;
                                    width: 50px;
                                }
                            </style>
                            <div class="auto_seleccionar">
                                <div class="auto_img">
                                    <div class="d-flex col-12 justify-content-center ">
                                        <div class=" ">
                                            <div class="bus-layout">
                                            <?php
                                                    // Asignación del mapa de asientos
                                                    $seat_map = [
                                                        [1, 1, 1, 1, 2],  // 2 es el asiento del conductor
                                                        [1, 1, 1, 1, 0], 
                                                        [1, 0, 0, 0, 0],  // 0 son espacios vacíos
                                                        [1, 1, 1, 0, 1]
                                                    ];

                                                    $index = 0;
                                                    foreach ($seat_map as $row) {
                                                        foreach ($row as $seat) {
                                                            if ($seat === 1) {
                                                                if (isset($asientos[$index])) {
                                                                    $asiento = $asientos[$index];
                                                                    $estado = $asiento->estado;
                                                                    $imgSrc = "assets/img/svg/asiento_vacio.svg"; // Asiento disponible por defecto
                                                                    if ($estado === "ocupado") {
                                                                        $imgSrc = "assets/img/svg/asiento_ocupado.svg"; // Asiento ocupado
                                                                    } elseif ($estado === "reservado") {
                                                                        $imgSrc = "assets/img/svg/asiento_seleccionado.svg"; // Asiento reservado
                                                                    }
                                                                    ?>
<div class="asiento <?= $estado ?>" id="<?= htmlspecialchars($asiento->asiento); ?>" data-id="<?= htmlspecialchars($asiento->id); ?>">
    <img src="<?= $imgSrc ?>" alt="">
    <div style="position: absolute; top: 16px;left: 12px;">
        <span style="font-size: 9px;"><?= htmlspecialchars($asiento->asiento); ?></span>
    </div>
</div>
                                                                    <?php 
                                                                    $index++; 
                                                                }
                                                            } elseif ($seat === 2) {
                                                                echo '<div class="driver-seat">Piloto</div>';
                                                            } elseif ($seat === 0) {
                                                                echo '<div class="empty-space"></div>';
                                                            }
                                                        }
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                   
                    </div>
                    <div class="col-lg-6 px-lg-5">
                        <?php include 'views/vista-resumen-ticket.php' ?>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <?php include 'app/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        // Pasar la variable PHP a JavaScript e imprimir en la consola
        var totalBoletos = <?= json_encode($descuentoboleto) ?>;
        totalBoletos *= 100;
        // Guardar el valor en localStorage
        localStorage.setItem('totalBoletos', totalBoletos);
    </script>
    <script>
        document.getElementById('save-data').addEventListener('click', function() {
            const viajeid = document.querySelector('[name="idviaje"]').value;
            const pasajeros = parseInt(document.querySelector('[name="pasajeros"]').value);
            const checkbox = document.getElementById('flexCheckDefault');
            const selectedSeatsCount = document.querySelectorAll('.asiento.reservado').length;

            if (!checkbox.checked) {
                alert('Debes aceptar los términos y condiciones.');
                checkbox.focus();
                return;
            }

            if (selectedSeatsCount < pasajeros) {
                alert(`Debes seleccionar ${pasajeros} asientos.`);
                return;
            }

            // Redirigir al siguiente paso del formulario
            window.location.href = `reserva?idviaje=${viajeid}&pasajeros=${pasajeros}`;
        });

        document.addEventListener('DOMContentLoaded', function() {
    // Limpiar el localStorage cuando se carga la página
    localStorage.removeItem('reservedSeats');

    const seats = document.querySelectorAll('.asiento');
    const urlParams = new URLSearchParams(window.location.search);
    const maxSeats = parseInt(urlParams.get('pasajeros')) || 1;
    let selectedSeats = [];

    seats.forEach(function(seat) {
        seat.addEventListener('click', function() {
            const seatId = seat.getAttribute('id'); // Obtener el nombre del asiento
            const seatName = seat.getAttribute('data-id'); // Obtener el ID del asiento

            if (seat.classList.contains('disponible')) {
                if (selectedSeats.length < maxSeats) {
                    seat.classList.remove('disponible');
                    seat.classList.add('reservado');
                    seat.querySelector('img').src = 'assets/img/svg/asiento_seleccionado.svg';

                    // Guardar el objeto asiento en localStorage
                    selectedSeats.push({ id: seatId, asiento: seatName });
                    localStorage.setItem('reservedSeats', JSON.stringify(selectedSeats));
                } else {
                    alert('Has alcanzado el número máximo de asientos que puedes seleccionar.');
                }
            } else if (seat.classList.contains('reservado')) {
                seat.classList.remove('reservado');
                seat.classList.add('disponible');
                seat.querySelector('img').src = 'assets/img/svg/asiento_vacio.svg';

                // Eliminar el asiento del arreglo seleccionado
                selectedSeats = selectedSeats.filter(seat => seat.id !== seatId);
                localStorage.setItem('reservedSeats', JSON.stringify(selectedSeats));
            }
        });
    });

    // Restaurar asientos reservados desde localStorage
    function restoreReservedSeats() {
        let reservedSeats = JSON.parse(localStorage.getItem('reservedSeats')) || [];
        reservedSeats.forEach(function(seat) {
            const seatElement = document.getElementById(seat.id);
            if (seatElement) {
                seatElement.classList.remove('disponible');
                seatElement.classList.add('reservado');
                seatElement.querySelector('img').src = 'assets/img/svg/asiento_seleccionado.svg';
            }
        });
    }

    restoreReservedSeats();
});



    </script>
    </body>
</html>