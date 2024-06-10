<?php
session_start(); // Inicia la sesión al comienzo del archivo

// Supongamos que el nombre del usuario está almacenado en $_SESSION['user']
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
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
    
    <style>
        .section_terminos h3{
            font-size: 36px;
            font-weight: bold;
            margin: 0px 0px 50px;
        }
        .section_terminos p{
            font-size: 15px;
        }
    </style>
    <section class="section_terminos py-5">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-8 ">
                    <h3 class="text-center">Términos y Condiciones de Transporte SAFE</h3>

                    <p>
                    <b>1. Introducción</b> <br>
Bienvenido a [Nombre de la Agencia de Viajes]. Estos términos y condiciones describen las reglas y regulaciones para el uso de los servicios de nuestra agencia de viajes. Al acceder y utilizar nuestros servicios, usted acepta estar sujeto a estos términos y condiciones.
<br><br>
<b>2. Reservas y Pagos</b><br>
<b>2.1. Proceso de Reserva</b><br>
Las reservas de viajes pueden realizarse a través de nuestro sitio web, por teléfono o en nuestras oficinas.
Se requiere proporcionar información precisa y completa al momento de la reserva.<br>
<b>2.2. Pagos</b><br>
El pago completo debe realizarse al momento de la reserva, a menos que se indique lo contrario.<br>
Aceptamos varios métodos de pago, incluidos tarjetas de crédito, transferencias bancarias y pagos en efectivo.<br>
<b>3. Política de Cancelación y Reembolsos</b><br>
<b>3.1. Cancelación por Parte del Cliente</b><br>
Las cancelaciones deben realizarse por escrito y estar sujetas a las políticas de cancelación específicas de cada proveedor de servicios (aerolíneas, hoteles, etc.).<br>
Pueden aplicarse cargos por cancelación y las tarifas no reembolsables pueden no ser reembolsadas.<br>
<b>3.2. Cancelación por Parte de la Agencia</b><br>
Nos reservamos el derecho de cancelar cualquier reserva por razones imprevistas. En tales casos, se ofrecerá un reembolso completo o una opción alternativa de viaje.<br>
<b>4. Responsabilidad</b><br>
<b>4.1. Responsabilidad del Cliente</b><br>
Es responsabilidad del cliente asegurarse de que todos los documentos de viaje, como pasaportes y visados, estén en regla.<br>
Los clientes deben seguir todas las leyes y regulaciones locales durante el viaje.<br>
<b>4.2. Responsabilidad de la Agencia</b><br>
Actuamos como intermediarios entre el cliente y los proveedores de servicios de viaje. <br>No somos responsables de ningún daño, pérdida o gasto adicional debido a demoras, cancelaciones o cambios por parte de los proveedores.<br>
<b>5. Cambios y Modificaciones</b><br>
<b>5.1. Cambios en la Reserva</b><br>
Los cambios en las reservas están sujetos a la disponibilidad y pueden implicar cargos adicionales.<br>
Cualquier solicitud de cambio debe realizarse por escrito y puede estar sujeta a las políticas de los proveedores de servicios.<br>
<b>5.2. Modificaciones en los Términos y Condiciones</b><br>
Nos reservamos el derecho de modificar estos términos y condiciones en cualquier momento. <br>Las modificaciones serán efectivas inmediatamente después de su publicación en nuestro sitio web.<br>
<b>6. Protección de Datos</b><br>
<b>6.1. Recopilación y Uso de Información Personal</b><br>
Recopilamos y utilizamos información personal de acuerdo con nuestra Política de Privacidad.<br>
La información personal se utiliza exclusivamente para facilitar la reserva y la prestación de servicios de viaje.<br>
<b>7. Propiedad Intelectual</b><br>
Todo el contenido de nuestro sitio web, incluyendo textos, gráficos, logotipos y software, es propiedad de [Nombre de la Agencia de Viajes] y está protegido por las leyes de derechos de autor.<br>
<b>8. Ley Aplicable y Jurisdicción</b><br>
Estos términos y condiciones se regirán e interpretarán de acuerdo con las leyes del país en el que operamos.<br>
Cualquier disputa que surja en relación con estos términos y condiciones estará sujeta a la jurisdicción exclusiva de los tribunales del país.<br>
<b>9. Contacto</b><br>
Si tiene alguna pregunta o inquietud sobre estos términos y condiciones, por favor contáctenos en [correo electrónico de contacto] o llame a [número de teléfono de contacto].                        
                    </p>
                </div>
            </div>
        </div>
    </section>

    <?php include 'app/footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
 
    </body>
</html> 