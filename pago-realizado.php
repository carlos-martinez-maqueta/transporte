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
           
        }
        .sections_pay_done .pay_done .div_borders .ticket_personas .btn_next_step{
            display: none;
        }
        .terminos_asientos{
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

                        <p class="send_mail">Tus boletos serán enviados a <b id="correo"></b></p>
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
    <script>
        function reservar() {
            // Obtener datos del localStorage
            const viaje_id = localStorage.getItem('viaje');
            const asientos_reservados = localStorage.getItem('asientos_reservados');
            const precio = localStorage.getItem('totalBoletos');
            const reservadoas = localStorage.getItem('reservedSeats');
            const acompanantes = localStorage.getItem('acompanantes');

            const correo = localStorage.getItem('correo');
            const apellidos = localStorage.getItem('apellidos');
            const telefono = localStorage.getItem('telefono');
            const nombre =localStorage.getItem('nombre');

            // Preparar los datos a enviar
            const data = {
                viaje_id: viaje_id,
                asientos_reservados: asientos_reservados,
                precio: precio,
                reservadoas: reservadoas,
                acompanantes: acompanantes,
                correo: correo,
                apellidos: apellidos,
                telefono: telefono,
                nombre: nombre
            };

            // Enviar los datos usando fetch
            fetch('post/pagado.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.text())
            .then(data => {
                console.log('Success:', data);
                
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }

        document.addEventListener('DOMContentLoaded', (event) => {
            reservar();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtener los datos desde localStorage
            const correo = localStorage.getItem('correo');
            
            // Inyectar los datos en el HTML
            if (correo) {
                document.getElementById('correo').textContent = correo;
            } else {
                document.getElementById('correo').textContent = 'No se encontró el correo en localStorage';
            }
        });
    </script>    
    </body>
</html>