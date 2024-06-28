<?php

include 'config/conexion.php';
include 'dashboard/class/going.php';
include 'dashboard/class/return.php';
include 'dashboard/class/travel.php';
include 'dashboard/class/origin.php';
include 'dashboard/class/mobility.php';

    session_start(); // Inicia la sesión al comienzo del archivo

    $goingList = Going::getGoingAll();
    $selectedIds = [1, 2, 3, 4, 5];
    $selectedIdsVueltas = [1, 4, 5];

    $returnList = Vuelta::getGoingAll();
    $selectedIdsReturn = [1, 4, 7, 10, 13, 16];
    
    $travelList = Travel::getTravelAll();
    
    //var_dump($travelList);

    // Supongamos que el nombre del usuario está almacenado en $_SESSION['user']
    $user = isset($_SESSION['cliente']) ? $_SESSION['cliente'] : null;
    $pasajeros = isset($_GET['pasajeros']) ? $_GET['pasajeros'] : null;
    $fecha_salida = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');
 

    // Separa el valor de 'destino' en $id y $tipo
    list($tipo, $origen) = explode('-', $_GET['origen']);
    list($none, $destino) = explode('-', $_GET['destino']);

    // echo 'DATOS FORMULARIO';
    // echo $tipo;
    // echo $origen;
    // echo $destino;
    // echo $fecha_salida;
    // echo '<br>';
    //      // Determinar la tabla y ejecutar la consulta adecuada
    if ($tipo == 'vuelta') {
        $query = "SELECT id FROM tbl_vueltas WHERE origen = :origen AND destino = :destino";
    } elseif ($tipo == 'ida') {
        $query = "SELECT id FROM tbl_idas WHERE origen = :origen AND destino = :destino";
    } else {
        throw new Exception('Tipo desconocido: ' . $tipo);
    }

    // Preparar y ejecutar la consulta
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':origen', $origen, PDO::PARAM_STR);
    $stmt->bindParam(':destino', $destino, PDO::PARAM_STR);
    $stmt->execute();

    // Obtener y mostrar los resultados
    $resultados = $stmt->fetch(PDO::FETCH_ASSOC);
    $id = $resultados['id'];
    // echo 'ID DE VIAJE EN IDA O VUELTA'.$id;
 
     $count_query = "SELECT * FROM tbl_viajes WHERE fecha_salida = :fecha_salida";
     $count_stmt = $conn->prepare($count_query);
     $count_stmt->bindParam(':fecha_salida', $fecha_salida, PDO::PARAM_STR);
     $count_stmt->execute();
     $resultadosss = $count_stmt->fetch(PDO::FETCH_ASSOC);
    //  $count = $resultadosss['count'];
    // var_dump($resultadosss);

      
     // echo $viaje_id;

    //  $query = "SELECT viaje_id FROM tbl_viajes_puntos WHERE tipo = :tipo";
    //  $stmt = $conn->prepare($query);
    //  $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
    //  $stmt->execute();
 
    //  $fila = $stmt->fetch(PDO::FETCH_ASSOC);

    //  $viaje_id =  $fila['viaje_id'];
    //  echo $viaje_id;
    if ($resultadosss) {
        $viaje_id =  $resultadosss['id'];
        $ticketObj = Travel::getPointsFechHomeId($viaje_id, $id);
        $viajeObj = Travel::getMarvelId($viaje_id);
        $movilidadObj = Mobility::getMobilityId($viajeObj->movilidad_id);   
        $horafecha = new DateTime($horafecha = $viajeObj->fecha_salida);
        $fecha_formateada = strftime('%d de %B de %Y', $horafecha->getTimestamp());
    }

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
                            <div class="row align-items-center">
                            <div class="col-lg col-md col-6 mb-lg-0 mb-1">
                                    <div class=" form-floating">
                                        <select class="form-select" id="origen" name="origen" required aria-label="Floating label select example">
                                            <option value="0" selected>Seleccionar</option>
                                            <?php foreach ($goingList as $going) : 
                                                if (in_array($going->id, $selectedIds)) {?> 
                                                    <option value="<?= $going->tipo ?>-<?= $going->origen ?>"><?= $going->origen ?></option>
                                            <?php } endforeach; ?>
                                            <?php foreach ($returnList as $vuelta) : 
                                                if  (in_array($vuelta->id, $selectedIdsReturn)){ ?>                                                
                                                <option value="<?= $vuelta->tipo ?>-<?= $vuelta->origen ?>"><?= $vuelta->origen ?></option>
                                            <?php } endforeach; ?>                                            
                                        </select>
                                        <label for="cliente">Seleccionar Origen: </label>
                                    </div>
                                </div>
                                 <div class="col-lg col-md col-6 mb-lg-0 mb-1">
                                    <div class="form-floating">
                                        <select class="form-select" id="destino" name="destino" required aria-label="Floating label select example" required>
                                            <option value="0" selected>Seleccionar</option>
                                            <?php foreach ($returnList as $vuelta) : 
                                                if  (in_array($vuelta->id, $selectedIdsReturn)){ ?>                                                
                                                <option value="<?= $vuelta->tipo ?>-<?= $vuelta->origen ?>"><?= $vuelta->origen ?></option>
                                            <?php } endforeach; ?>
                                            <?php foreach ($goingList as $going) : 
                                                if (in_array($going->id, $selectedIdsVueltas)) {?> 
                                                    <option value="<?= $going->tipo ?>-<?= $going->origen ?>"><?= $going->origen ?></option>
                                            <?php } endforeach; ?>                                            
                                        </select>
                                        <label for="">Destino</label>
                                    </div>                                   
                                </div>  
                                <div class="col-lg col-6  mb-lg-0 mb-3">
                                    <div class="form-floating">
                                    <input type="date" class="form-control" id="fecha" name="fecha" placeholder="" min="<?php echo date('Y-m-d'); ?>" required>
                                        <label for="">Fecha</label>
                                    </div>
                                </div>
                                <div class="col-lg col-6  mb-lg-0 mb-3">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="" value="<?php echo $pasajeros; ?>" name="pasajeros" placeholder="">
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
                    <?php if($resultadosss) { ?>
                    <div class="row row_ticket" id="">
                        <div class="col-lg-1 col-md-1 col-2 col_id">
                            <div class="id_p_ticket">
                                <p><?=$viajeObj->correlativo?></p>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7 col-10 col_info pt-lg-2">
                            <div class="info_uno justify-content-between d-flex">
                                <h6>Transporte SAFE</h6>
                                <p>Tiempo Estimado</p>
                                <span>Asientos Disponibles <?=$viajeObj->count?></span>
                            </div>
                            <div class="info_dos">
                                <div class="anchos_w">
                                    <p><?=$ticketObj->origen?></p>
                                    <span><?=$ticketObj->hora_salida?></span> 
                                </div>
                                <div class="anchos_w">
                                    <p class="linea_sepa"></p>
                                </div>
                                <div class="anchos_w text-center">
                                    <img src="assets/img/svg/camion.svg" alt="">
                                    <p><?=$ticketObj->tiempo_viaje?></p>
                                </div>
                                <div class="anchos_w">
                                    <p class="linea_sepa"></p>
                                </div>
                                <div class="anchos_w text-end">
                                    <p><?=$ticketObj->destino?></p>
                                    <span><?=$ticketObj->hora_llegada?></span>
                                </div>
                            </div>
                            <div>
                                <span><?=$fecha_formateada?></span>
                            </div>
                        </div>
                        <div class="col-lg-4 col_price">
                            <div class="info_cuatros">
                                <p class="mb-0">Dato: El pago es para reserva de boletos, lo restante se cancela al ingreso del viaje </p>
                            </div>
                            <div class="flex_prices">
                                <div class="price_div">
                                    <div class="span"><?=$ticketObj->precio?> MXM </div>
                                    <div class="span_span">Precio boletos</div>
                                </div>
                                <div class="price_div_descuentos">
                                    <div class="span">
                                        <?=$ticketObj->reserva?> MXM
                                    </div>
                                    <div class="span_span">Precio para reserva</div>
                                </div>
                            </div>
                            <div class="flex_button mb-lg-3">
                                <?php
                                    
                                if  ($viajeObj->count > $pasajeros) {?>
                                        <a data-bs-toggle="collapse" href="#ddddd" role="button" aria-expanded="false" aria-controls="ddddd" class="detail_button"><img src="assets/img/detail.svg" class="img-fluid" alt="">Ver Detalles</a>
                                        <a href="datos-personales?destino=<?=$id.'-'.$tipo;?>&fecha=2024-06-18&pasajeros=<?= $pasajeros ?>" class="pay_button"><img src="assets/img/pay.svg" class="img-fluid" alt="">
                                            Comprar Boleto
                                        </a>
                                <?php }else{ ?>
                                        <a class=" disabled_pay btn-secondary">
                                            No Disponible
                                        </a>
                                <?php }
                                ?>
                            </div>
                        </div>

                        <div class="col-12 fondo_boleto_despliegue">
                            <div class="collapse py-4" id="ddddd">
                                <div class="d-flex">
                                    <div class="items_list_tres">
                                        <ul>
                                            <li>
                                                <p>1 dia</p>
                                            </li>
                                            <li>
                                                <p><img src="assets/img/svg/people.svg" alt=""><?=$movilidadObj->capacidad_asientos?></p>
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
                                    <div class="info_trees px-4 d-flex">
                                        <p class="mb-0 me-2"><b>Mátricula de Movilidad:</b> <?=$movilidadObj->matricula?></p>
                                        <p class="mb-0"><b>Tipo de Movilidad:</b> <?=$movilidadObj->tipo_vehiculo?></p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } else{ ?>
                        <p>No se encontró Viajes para Esta Fecha</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <style>

    </style>
    <?php include 'app/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="assets/js/viajes.js"></script>
    
</body>

</html>