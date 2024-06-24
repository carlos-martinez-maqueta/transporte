<?php
include 'config/conexion.php';
include 'class/staff.php';
include 'class/user.php';
include 'class/origin.php';
include 'class/home.php';
include 'class/mobility.php';
include 'class/destination.php';
include 'class/expenses.php';
include 'class/pay.php';
include 'class/booking.php';
include 'class/travel.php';
include 'core/Security.php';

$id = $_GET["id"];

// Obtener el viaje con el ID proporcionado
$viaje = Travel::getMarvelId($id);

// Obtener todas las reservas asociadas a ese viaje
$reservas = Booking::getAllReservasByTravelId($id);

// Inicializar un array para almacenar los pasajeros
$allPasajeros = [];

// Iterar sobre todas las reservas
foreach ($reservas as $reserva) {
    // Obtener los pasajeros de cada reserva
    $pasajeros = Booking::getPasajerosByReservaId($reserva->id);

    // Agregar los pasajeros al array general
    $allPasajeros = array_merge($allPasajeros, $pasajeros);
}
// $allPasajeros ahora contiene todos los pasajeros de todas las reservas

// Arrays de días y meses en español
$dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
$meses = array(
    1 => 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
);

// Convertir la fecha
$fecha = strtotime($viaje->fecha_salida);
$diaSemana = $dias[date('w', $fecha)];
$dia = date('d', $fecha);
$mes = $meses[date('n', $fecha)];
$anio = date('Y', $fecha);
$fechaSalida = "$diaSemana, $dia de $mes del $anio";
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Asistencia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<style>
    .title {
        font-family: "Lora", serif;
        color: #fff;
        font-weight: bold;
    }

    .subtitle {
        font-family: "Lora", serif;
        color: #fff;
    }

    .fonts {
        font-family: "Lora", serif;
    }

    /* Estilos para la lista de checkboxes */
    .list-group-item {
        border: none;
        padding: 10px;
    }

    .form-check-input {
        margin-right: 10px;
    }

    /* Estilos para el título y subtítulo */
    .title {
        color: #fff;
        font-size: 2rem;
        margin-top: 20px;
    }

    .subtitle {
        color: #fff;
        font-size: 1.5rem;
        margin-bottom: 20px;
    }
</style>

<body>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xl-12 px-0">
                    <div class="py-5" style="background: #1979E6;">
                        <h1 class="text-center title">Asistencia</h1>
                        <p class="text-center subtitle mb-3 fs-5">Viaje: <?php echo $viaje->correlativo; ?></p>
                        <h4 class="text-start subtitle ms-3">Hora: <?php echo $viaje->hora_salida; ?></h4>
                        <h4 class="text-start subtitle ms-3">Fecha: <?php echo $fechaSalida; ?></h4>
                        <h4 class="text-start subtitle ms-3">Tipo de viaje: <?php echo $viaje->tipo; ?></h4>
                    </div>
                    <div class="px-3 pt-3">
                        <p class="fonts">Pasajeros:</p>
                        <ul class="list-group">
                            <?php foreach ($allPasajeros as $pasajero) : ?>
                                <li class="list-group-item mb-3 shadow">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="fonts"><?php echo "{$pasajero->nombre} {$pasajero->apellidos}"; ?></span><br>
                                            <span class="fonts"><?php echo $pasajero->celular; ?></span><br>
                                            <span class="fonts">Origen: <?php echo $pasajero->puntoOrigen; ?></span><br>
                                            <span class="fonts">Destino: <?php echo $pasajero->puntoDestino; ?></span><br>
                                        </div>
                                        <div class="form-check form-switch">
                                            <?php
                                            $checked = ($pasajero->asistencia == 1) ? 'checked' : '';
                                            ?>
                                            <input class="form-check-input" type="checkbox" id="asistencia-<?php echo $pasajero->id; ?>" data-pasajero-id="<?php echo $pasajero->id; ?>" <?php echo $checked; ?>>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $(".form-check-input").click(function() {
                var pasajeroId = $(this).data("pasajero-id");
                var estadoAsistencia = $(this).prop("checked") ? 1 : 0;

                $.ajax({
                    url: "actualizar_asistencia.php",
                    method: "POST",
                    data: {
                        pasajero_id: pasajeroId,
                        estado_asistencia: estadoAsistencia
                    },
                    success: function(response) {
                        console.log("Asistencia actualizada correctamente");
                    },
                    error: function(xhr, status, error) {
                        console.error("Error al actualizar la asistencia");
                    }
                });
            });
        });
    </script>

</body>

</html>