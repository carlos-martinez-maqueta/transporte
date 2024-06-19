<?php

include 'config/conexion.php';
include 'dashboard/class/travel.php';
include 'dashboard/class/origin.php';
include 'dashboard/class/destination.php';

session_start(); // Inicia la sesión al comienzo del archivo

$travelList = Travel::getTravelAll();
//var_dump($travelList);

// Supongamos que el nombre del usuario está almacenado en $_SESSION['user']
$user = isset($_SESSION['cliente']) ? $_SESSION['cliente'] : null;

// Separa el valor de 'destino' en $id y $tipo
list($id, $tipo) = explode('-', $_GET['destino']);

try {
    // Filtrar tbl_viajes_puntos para obtener viaje_id
    $query = "SELECT viaje_id FROM tbl_viajes_puntos WHERE puntos_id = :id AND tipo = :tipo";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
    $stmt->execute();
    
    $selected_viaje_id = null;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $viaje_id = $row['viaje_id'];

        // Consulta para verificar si el viaje tiene un count menor o igual a 0 en otra_tabla
        $count_query = "SELECT COUNT(*) AS count FROM tbl_viajes WHERE id = :viaje_id";
        $count_stmt = $conn->prepare($count_query);
        $count_stmt->bindParam(':viaje_id', $viaje_id, PDO::PARAM_INT);
        $count_stmt->execute();
        $count_row = $count_stmt->fetch(PDO::FETCH_ASSOC);
        $count = $count_row['count'];

        // Si el count es menor o igual a 0, continúa con el siguiente resultado
        if ($count <= 0) {
            continue;
        }

        $ticketObj = Travel::getPointsFechHomeId($viaje_id, $id);

        var_dump($ticketObj);

        // Hacer algo con el viaje_id seleccionado
        echo "El viaje con viaje_id $viaje_id tiene un count mayor a 0 en otra_tabla.";

        // Por ejemplo, podrías almacenar el viaje_id en una variable para usarlo más tarde
        $selected_viaje_id = $viaje_id;
        break; // Rompe el bucle ya que hemos encontrado un resultado válido
    }

    if ($selected_viaje_id === null) {
        echo "No se encontraron resultados válidos para el punto_id $id y tipo $tipo en tbl_viajes_puntos.";
    }

} catch (PDOException $e) {
    die("PDO Error: " . $e->getMessage());
}













$fecha = isset($_GET['fecha']) ? $_GET['fecha'] : '';
$pasajeros = isset($_GET['pasajeros']) ? $_GET['pasajeros'] : 1; // Por defecto, 1 pasajero si no se especifica

// $origenes = Origin::getOriginId($origen); 
// $destinos = Destination::getDestinationId($destino); 

$originList = Origin::getOriginAll();
$destinoList = Destination::getDestinationAll();

// var_dump($origenes)

$today = date("Y-m-d");
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transportes Safe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/destinos.css">
    <link rel="stylesheet" href="assets/css/mobile.css">
</head>
<style>
    body {
        background-color: #ffffff;
    }

    header {
        border-bottom: 1px solid #000000;
    }
</style>

<body>

    <?php include 'app/header-home.php' ?>

    <section class="banner_div_destinos py-4">
        <div class="">
            <div class="buscador_home container">
                <div class="row justify-content-md-center justify-content-center">
                    <div class="col-10 row_buscador">
                        <form action="destinos" method="GET">
                            <div class="row">
                                <div class="col-lg col-6  mb-lg-0 mb-3">
                                    <div class="form-floating">
                                        <select class="form-select" id="" name="origen" aria-label="Floating label select example">
                                            <?php if ($origen) { ?>
                                                <option value="<?= $origenes->id ?>"><?= $origenes->nombre ?></option>
                                                <?php
                                                foreach ($originList as $origin) {
                                                    echo '<option value="' . $origin->id . '">' . $origin->nombre . '</option>';
                                                }
                                                ?>
                                            <?php } else { ?>
                                                <option value="">Seleccionar</option>
                                                <?php
                                                foreach ($originList as $origin) {
                                                    echo '<option value="' . $origin->id . '">' . $origin->nombre . '</option>';
                                                }
                                                ?>
                                            <?php } ?>

                                        </select>
                                        <label for="">Origen</label>
                                    </div>
                                </div>
                                <div class="col-lg col-6  mb-lg-0 mb-3">
                                    <div class="form-floating">
                                        <select class="form-select" id="" name="destino" aria-label="Floating label select example">
                                            <?php if ($destino) { ?>
                                                <option value="<?= $destinos->id ?>"><?= $destinos->nombre ?></option>
                                                <?php
                                                foreach ($destinoList as $origin) {
                                                    echo '<option value="' . $origin->id . '">' . $origin->nombre . '</option>';
                                                }
                                                ?>
                                            <?php } else { ?>
                                                <option value="">Seleccionar</option>
                                                <?php
                                                foreach ($destinoList as $origin) {
                                                    echo '<option value="' . $origin->id . '">' . $origin->nombre . '</option>';
                                                }
                                                ?>
                                            <?php } ?>
                                        </select>
                                        <label for="">Destino</label>
                                    </div>
                                </div>
                                <div class="col-lg col-6  mb-lg-0 mb-3">

                                    <div class="form-floating">

                                        <?php
                                        if ($origen) { ?>
                                            <input type="date" class="form-control" id="" value="<?php echo $fecha ?>" name="fecha" placeholder="">
                                        <?php   } else { ?>
                                            <input type="date" class="form-control" id="" value="<?php echo $today; ?>" name="fecha" placeholder="">
                                        <?php } ?>
                                        <label for="">Fecha</label>
                                    </div>

                                </div>
                                <div class="col-lg col-6  mb-lg-0 mb-3">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="" value="<?php echo $pasajeros ?>" name="pasajeros" placeholder="">
                                        <label for="">Pasajeros</label>
                                    </div>
                                </div>
                                <div class="col-lg col-12  mb-lg-0 mb-3 text-center">
                                    <button type="submit" class="btn btn-dark"><img class="mx-2" src="assets/img/buscar.svg" alt="">Buscar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section_ticket">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-lg-12">
                    <?php

                    foreach ($travelList as $origin) {
                        $fecha_inicio = new DateTime($origin->fecha_inicio);
                        $fecha_fin = new DateTime($origin->fecha_fin);

                        $diferencia = $fecha_inicio->diff($fecha_fin);

                        // Calcula la diferencia total en horas
                        $diferencia_horas = $diferencia->h + ($diferencia->days * 24);

                        // Agrega los minutos a la diferencia total
                        $diferencia_minutos = $diferencia->i;

                        //SACAR LAS HORAS DE INICIO Y FIN
                        $fecha_inicios = new DateTime($origin->fecha_inicio);
                        $hora_inicio = $fecha_inicios->format('H:i'); // Formato de 24 horas: HH:mm

                        $fecha_fin = new DateTime($origin->fecha_fin);
                        $hora_fin = $fecha_fin->format('H:i'); // Formato de 24 horas: HH:mm


                        setlocale(LC_TIME, 'es_ES.UTF-8'); // Establecer el idioma a español

                        $fecha_inicioss = new DateTime($origin->fecha_inicio);
                        $fecha_formateada = strftime('%d de %B de %Y', $fecha_inicioss->getTimestamp());
                    ?>
                        <div class="row row_ticket" id=" ">
                            <div class="col-lg-1 col-md-1 col-2 col_id">
                                <div class="id_p_ticket">
                                    <p>#<?= $origin->correlativo ?> </p>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-10 col_info pt-lg-2">
                                <div class="info_uno justify-content-between d-flex">
                                    <h6>Transporte SAFE</h6>

                                    <p>Estimación: <?= $diferencia_horas ?> hr <?= $diferencia_minutos ?> m </p>
                                    <span>Hacientos Disponibles <?= $origin->count ?></span>
                                </div>
                                <div class="info_dos">
                                    <div class="anchos_w">
                                        <p><?= $origin->nombreOrigen ?></p>
                                        <span><?= $hora_inicio ?></span>
                                    </div>
                                    <div class="anchos_w">
                                        <p class="linea_sepa"></p>
                                    </div>
                                    <div class="anchos_w text-center">
                                        <img src="assets/img/svg/camion.svg" alt="">
                                        <p><?= $diferencia_horas ?> hr <?= $diferencia_minutos ?> m </p>
                                    </div>
                                    <div class="anchos_w">
                                        <p class="linea_sepa"></p>
                                    </div>
                                    <div class="anchos_w text-end">
                                        <p><?= $origin->nombreDestino ?></p>
                                        <span><?= $hora_fin ?></span>
                                    </div>
                                </div>
                                <div>
                                    <span><?= $fecha_formateada ?></span>
                                </div>
                            </div>
                            <div class="col-lg-4 col_price">
                                <div class="info_cuatros">
                                    <p class="mb-0">Dato: El pago es para reserva de boletos, lo restante se cancela al ingreso del viaje </p>
                                </div>
                                <div class="flex_prices">
                                    <div class="price_div">
                                        <div class="span"><?= $allcount = $pasajeros * $origin->precio; ?> MXM </div>
                                        <div class="span_span">Precio boletos</div>
                                    </div>
                                    <div class="price_div_descuentos">
                                        <div class="span">
                                            <?php $descuento = $origin->precio / 2;
                                            $allcount = $pasajeros * $descuento;

                                            echo $allcount ?> MXM
                                        </div>
                                        <div class="span_span">Precio para reserva</div>
                                    </div>
                                </div>
                                <div class="flex_button mb-lg-3">

                                    <?php if ($origin->count > 0) { ?>
                                        <a data-bs-toggle="collapse" href="#<?= $origin->id ?>" role="button" aria-expanded="false" aria-controls="<?= $origin->id ?>" class="detail_button"><img src="assets/img/detail.svg" class="img-fluid" alt="">Ver Detalles</a>
                                        <a href="datos-personales?idviaje=<?= $origin->id ?>&pasajeros=<?php echo $pasajeros ?>" class="pay_button"><img src="assets/img/pay.svg" class="img-fluid" alt="">
                                            Comprar Boleto
                                        </a>
                                    <?php } else { ?>
                                        <a class=" disabled_pay btn-secondary">
                                            No Disponible
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="col-12 fondo_boleto_despliegue">
                                <div class="collapse py-4" id="<?= $origin->id ?>">
                                    <div class="d-flex">
                                        <div class="items_list_tres">
                                            <ul>
                                                <li>
                                                    <p>1 dia</p>
                                                </li>
                                                <li>
                                                    <p><img src="assets/img/svg/people.svg" alt=""><?= $origin->capacidadMovilidad ?></p>
                                                </li>
                                                <li>
                                                    <p><img src="assets/img/svg/wifi.svg" alt="">Wifi</p>
                                                </li>
                                                <li>
                                                    <p><img src="assets/img/svg/luz.svg" alt="">Luz</p>
                                                </li>
                                                <li>
                                                    <p><img src="assets/img/svg/guia.svg" alt="">Guia/Representante</p>
                                                </li>
                                                <li>
                                                    <p><img src="assets/img/svg/tv.svg" alt="">Tv</p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="info_trees px-4">
                                            <p class="mb-0">Mátricula de Movilidad: <?= $origin->matriculaMovilidad ?></p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <style>

    </style>
    <?php include 'app/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>