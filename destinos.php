<?php

include 'config/conexion.php';
include 'dashboard/class/travel.php';
session_start(); // Inicia la sesión al comienzo del archivo

$travelList = Travel::getTravelAll(); 

// var_dump($travelList);
// Supongamos que el nombre del usuario está almacenado en $_SESSION['user']
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;


//OBTENER DATOS GET 
$origen = isset($_GET['origen']) ? $_GET['origen'] : '';
$destino = isset($_GET['destino']) ? $_GET['destino'] : '';
$fecha = isset($_GET['fecha']) ? $_GET['fecha'] : '';
$pasajeros = isset($_GET['pasajeros']) ? $_GET['pasajeros'] : 1; // Por defecto, 1 pasajero si no se especifica

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
        .banner_div_destinos{
            border-bottom: 1px solid #000000;
            margin-bottom: 80px;
        }
        .banner_div_destinos .row_buscador{
            padding: 0px;
            background-color: #ffffff;
            position: relative;
            top: inherit;
            border-radius: 20px;
        }
        .banner_div_destinos .row_buscador select, .banner_div_destinos .row_buscador input{
            height: 60px !important;
            min-height: 60px;
            border: 1px solid #000000;
        }
        .banner_div_destinos .row_buscador button{
            border-radius: 10px;
            height: 100%;
            width: 75%;
        }
    </style>
  <body>

    <?php include 'app/header-home.php' ?>

    <section class="banner_div_destinos py-4">
        <div class="">            
            <div class="buscador_home container">
                <div class="row justify-content-md-center" >
                    <div class="col-10 row_buscador">
                        <form action="destinos" method="GET">
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating">
                                        <select class="form-select" id="" name="origen" aria-label="Floating label select example">
                                            <?php if($origen){?>
                                                <option value="1"><?php echo $origen ?></option>
                                            <?php } ?>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                        <label for="">Origen</label>
                                    </div>                                   
                                </div>
                                <div class="col">
                                    <div class="form-floating">
                                        <select class="form-select" id="" name="destino" aria-label="Floating label select example">
                                            <?php if($destino){?>
                                                <option value="1"><?php echo $destino ?></option>
                                            <?php } ?>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                        <label for="">Destino</label>
                                    </div>                                   
                                </div>
                                <div class="col">
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="" value="<?php echo $fecha ?>" name="fecha" placeholder="">
                                        <label for="">Fecha</label>
                                    </div>                                     
                                </div>                                    
                                </div>
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="" value="<?php echo $pasajeros ?>" name="pasajeros" placeholder="">
                                        <label for="">Pasajeros</label>
                                    </div>                                     
                                </div>
                                <div class="col text-center">
                                    <button type="submit"  class="btn btn-dark"><img class="mx-2" src="assets/img/buscar.svg" alt="">Buscar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <style>
        .section_ticket{
            margin-bottom: 70px;
        }
        .section_ticket .row_ticket{
            margin: 0px 0px 50px;
            height: 210px; 
            box-shadow: 0px 3px 6px 0px #888888;
        }
        .section_ticket .row_ticket .col_id{
            background-color: #000000;
        }
        .section_ticket .row_ticket .col_id .id_p_ticket p{
            writing-mode: vertical-rl;
            text-orientation: upright;
            margin: 0px;
            font-size: 25px;
            color: #ffffff;
            letter-spacing: -11px;
            font-weight: bolder;
        }
        .section_ticket .row_ticket .col_id .id_p_ticket{
            width: fit-content;
            margin: 20px auto;
        }
        .section_ticket .row_ticket .col_info{
            padding: 0px 20px;
        }
        .section_ticket .row_ticket .col_info .info_uno h6{
            font-size: 24px;
            font-weight: 400;
            margin: 0px;
        }
        .section_ticket .row_ticket .col_info .info_uno p{
            font-size: 15px;
            margin: 0px;
        }
        .section_ticket .row_ticket .col_info .info_dos{
            display: flex;
            align-items: center;
            margin: 40px 0px;
        }
        .section_ticket .row_ticket .col_info .info_dos .anchos_w{
            width: 20%;
        }
        .section_ticket .row_ticket .col_info .info_dos .anchos_w .linea_sepa{
            border-top: 1px solid #828282;
        }
        .section_ticket .row_ticket .col_info .info_dos .anchos_w p{
            color: #575757;
            font-size: 15px;
            margin: 0px;
        }
        .section_ticket .row_ticket .col_info .info_dos .anchos_w span{
            font-size: 15px; 
            color: #004AAD;
        }
        .section_ticket .row_ticket .col_info .items_list_tres ul{
            padding: 0px;
            list-style: none;
            display: flex;
        }
        .section_ticket .row_ticket .col_info .items_list_tres ul li{
            padding: 3px 8px;
            border-radius: 5px;
            border: 1px solid #828282;
            margin-right: 5px;
        }
        .section_ticket .row_ticket .col_info .items_list_tres ul li p{
            color: #575757;
            margin: 0px;
            align-items: center;
            display: flex;
        }
        .section_ticket .row_ticket .col_info .items_list_tres ul li img{
            width: 15px;
            margin-right: 5px;
        }
        .section_ticket .row_ticket .col_price{
            border-left: 3px dashed #9a9a9a36;
        }
        .section_ticket .row_ticket .col_price .price_div{
            border: 1px solid #31BB73;
            width: fit-content;
            margin: 30px auto;
            padding: 6px 20px;
            font-size: 32px;
            color: #31BB73;
            border-radius: 8px;
        }
        .section_ticket .row_ticket .col_price .flex_button {
            display: flex;
        }
        .section_ticket .row_ticket .col_price .flex_button a{
            color: #ffffff;
            font-size: 12px;
            text-decoration: none;
            text-align: center;
            padding: 10px;
            width: 47%;
            margin: auto;
        }
        .section_ticket .row_ticket .col_price .flex_button a img{
            margin-right: 6px;
        }
        .section_ticket .row_ticket .col_price .flex_button .detail_button{
            background-color: #FFB703;
        }   
        .section_ticket .row_ticket .col_price .flex_button .pay_button{
            background-color: #004AAD;
        }
    </style>
    <section class="section_ticket">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-lg-12">
                <?php
                foreach ($travelList as $origin) { ?>
                    <div class="row row_ticket" id=" ">
                        <div class="col-lg-1 col_id">
                            <div class="id_p_ticket">
                                <p>#<?= $origin->correlativo ?> </p>
                            </div>
                        </div>
                        <div class="col-lg-7 col_info pt-lg-2">
                            <div class="info_uno justify-content-between d-flex">
                                <h6>Keisoto Express</h6>
                                <p>Estimación: 7 hr 15m</p>
                            </div>
                            <div class="info_dos">
                                <div class="anchos_w">
                                    <p><?= $origin->nombreOrigen ?></p>
                                    <span>03:00 AM</span>
                                </div>
                                <div class="anchos_w">
                                    <p class="linea_sepa"></p>
                                </div>
                                <div class="anchos_w text-center">
                                    <img src="assets/img/svg/camion.svg" alt="">
                                    <p>7 hr 15 m</p>
                                </div>
                                <div class="anchos_w">
                                    <p class="linea_sepa"></p>
                                </div>
                                <div class="anchos_w text-end">
                                    <p><?= $origin->nombreDestino ?></p>
                                    <span>11:30 PM</span>
                                </div>
                            </div>
                            <div class="items_list_tres">
                                <ul>
                                    <li><p>1 dia</p></li>
                                    <li><p><img src="assets/img/svg/people.svg"  alt=""><?= $origin->capacidadMovilidad?></p></li>
                                    <li><p><img src="assets/img/svg/wifi.svg"  alt="">Wifi</p></li>
                                    <li><p><img src="assets/img/svg/luz.svg"  alt="">Luz</p></li>
                                    <li><p><img src="assets/img/svg/guia.svg"  alt="">Guia/Representante</p></li>
                                    <li><p><img src="assets/img/svg/tv.svg"  alt="">Tv</p></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col_price">
                            <div class="price_div">$ 
                                <?=  $allcount = $pasajeros * $origin->precio; ?> 
                                MXM
                            </div>
                            <div class="flex_button">
                                <a href="" class="detail_button"><img src="assets/img/detail.svg" class="img-fluid" alt="">Detalles</a>
                                <a href="datos-personales?idviaje=<?= $origin->id ?>&pasajeros=<?php echo $pasajeros ?>" class="pay_button"><img src="assets/img/pay.svg" class="img-fluid" alt="">Comprar Boleto</a>
                            </div>
                        </div>
                    </div>                
                       
                    <?php }
                ?>                    

                    <!-- <div class="row row_ticket">
                        <div class="col-lg-1 col_id">
                            <div class="id_p_ticket">
                                <p>#238192</p>
                            </div>
                        </div>
                        <div class="col-lg-7 col_info pt-lg-2">
                            <div class="info_uno justify-content-between d-flex">
                                <h6>Keisoto Express</h6>
                                <p>Estimación: 7 hr 15m</p>
                            </div>
                            <div class="info_dos">
                                <div class="anchos_w">
                                    <p>Semarang</p>
                                    <span>03:00 AM</span>
                                </div>
                                <div class="anchos_w">
                                    <p class="linea_sepa"></p>
                                </div>
                                <div class="anchos_w text-center">
                                    <img src="assets/img/svg/camion.svg" alt="">
                                    <p>7 hr 15 m</p>
                                </div>
                                <div class="anchos_w">
                                    <p class="linea_sepa"></p>
                                </div>
                                <div class="anchos_w text-end">
                                    <p>Tulungagung</p>
                                    <span>11:30 PM</span>
                                </div>
                            </div>
                            <div class="items_list_tres">
                                <ul>
                                    <li><p>1 dia</p></li>
                                    <li><p><img src="assets/img/svg/people.svg"  alt="">10</p></li>
                                    <li><p><img src="assets/img/svg/wifi.svg"  alt="">Wifi</p></li>
                                    <li><p><img src="assets/img/svg/luz.svg"  alt="">Luz</p></li>
                                    <li><p><img src="assets/img/svg/guia.svg"  alt="">Guia/Representante</p></li>
                                    <li><p><img src="assets/img/svg/tv.svg"  alt="">Tv</p></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col_price">
                            <div class="price_div">$ 500 MXM</div>
                            <div class="flex_button">
                                <a href="" class="detail_button"><img src="assets/img/detail.svg" class="img-fluid" alt="">Detalles</a>
                                <a href="datos-personales" class="pay_button"><img src="assets/img/pay.svg" class="img-fluid" alt="">Comprar Boleto</a>
                            </div>
                        </div>
                    </div>
                    <div class="row row_ticket">
                        <div class="col-lg-1 col_id">
                            <div class="id_p_ticket">
                                <p>#238192</p>
                            </div>
                        </div>
                        <div class="col-lg-7 col_info pt-lg-2">
                            <div class="info_uno justify-content-between d-flex">
                                <h6>Keisoto Express</h6>
                                <p>Estimación: 7 hr 15m</p>
                            </div>
                            <div class="info_dos">
                                <div class="anchos_w">
                                    <p>Semarang</p>
                                    <span>03:00 AM</span>
                                </div>
                                <div class="anchos_w">
                                    <p class="linea_sepa"></p>
                                </div>
                                <div class="anchos_w text-center">
                                    <img src="assets/img/svg/camion.svg" alt="">
                                    <p>7 hr 15 m</p>
                                </div>
                                <div class="anchos_w">
                                    <p class="linea_sepa"></p>
                                </div>
                                <div class="anchos_w text-end">
                                    <p>Tulungagung</p>
                                    <span>11:30 PM</span>
                                </div>
                            </div>
                            <div class="items_list_tres">
                                <ul>
                                    <li><p>1 dia</p></li>
                                    <li><p><img src="assets/img/svg/people.svg"  alt="">10</p></li>
                                    <li><p><img src="assets/img/svg/wifi.svg"  alt="">Wifi</p></li>
                                    <li><p><img src="assets/img/svg/luz.svg"  alt="">Luz</p></li>
                                    <li><p><img src="assets/img/svg/guia.svg"  alt="">Guia/Representante</p></li>
                                    <li><p><img src="assets/img/svg/tv.svg"  alt="">Tv</p></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col_price">
                            <div class="price_div">$ 500 MXM</div>
                            <div class="flex_button">
                                <a href="" class="detail_button"><img src="assets/img/detail.svg" class="img-fluid" alt="">Detalles</a>
                                <a href="" class="pay_button"><img src="assets/img/pay.svg" class="img-fluid" alt="">Comprar Boleto</a>
                            </div>
                        </div>
                    </div>                                         -->
                </div>
            </div>
        </div>
    </section>

    <?php include 'app/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
 
    </body>
</html>