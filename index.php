<?php
include 'config/conexion.php';
session_start(); // Inicia la sesión al comienzo del archivo

// Supongamos que el nombre del usuario está almacenado en $_SESSION['user']
$user = isset($_SESSION['cliente']) ? $_SESSION['cliente'] : null;
$today = date("Y-m-d");

include 'dashboard/class/home.php';
include 'dashboard/class/origin.php';
include 'dashboard/class/destination.php';
include 'dashboard/class/travel.php';
include 'dashboard/class/user.php';


$originList = Origin::getOriginAll();
$destinoList = Destination::getDestinationAll();
 
$homeObj = Home::getHome();
$trabelObj = Travel::getTravelAll();
$usercount = User::getUserAllActive();
$resultBest = Home::getBestAll();
$resultComents = Home::getCommentsAll();


$numeroDeViajes = count($trabelObj);
$numeroDeUsuarios = count($usercount);

$numeroDeOrigin = count($originList);
$numeroDeDestino = count($destinoList);

$numerototalDestinos =  $numeroDeOrigin + $numeroDeDestino;
?>
<!doctype html>
<html lang="en">
    <?php include 'app/head.php' ?>
  <body>

  <?php include 'app/header-home.php' ?>

    <section class="banner_div">
        <div class="">
            <img src="dashboard/files/home/<?= $homeObj->banner ?>" class="d-lg-block d-none w-100" alt="">
            <img src="assets/img/banner_home_mobile.png" alt="" class="d-lg-none d-block w-100">
            <div class="buscador_home container">
                <div class="row justify-content-md-center row_lg_home">
                    <div class="col-lg-10 col-12 row_buscador">
                        <form action="destinos" method="GET">
                            <div class="row">
                                <div class="col-lg col-md col-6 mb-lg-0 mb-3">
                                    <div class="form-floating">
                                        <select class="form-select" id="" name="origen" aria-label="Floating label select example" required>
                                            <option value="0" selected>Seleccionar</option>
                                            <?php
                                            foreach ($originList as $origin) {
                                                echo '<option value="' . $origin->id . '">' . $origin->nombre . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <label for="">Origen</label>
                                    </div>                                   
                                </div>
                                <div class="col-lg col-md col-6 mb-lg-0 mb-3">
                                    <div class="form-floating">
                                        <select class="form-select" id="" name="destino" aria-label="Floating label select example" required>
                                            <option value="0" selected>Seleccionar</option>
                                            <?php
                                            foreach ($destinoList as $destino) {
                                                echo '<option value="' . $destino->id . '">' . $destino->nombre . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <label for="">Destino</label>
                                    </div>                                   
                                </div>
                                <div class="col-lg col-md col-6 mb-lg-0 mb-3">
                                 
                                    <div class="form-floating">
                                        <input type="date" class="form-control" value="<?php echo $today; ?>" id="" name="fecha" placeholder="" required>
                                        <label for="">Fecha</label>
                                    </div>                                     
                                                                     
                                </div>
                                <div class="col-lg col-md col-6 mb-lg-0 mb-3">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="" name="pasajeros" placeholder="" required>
                                        <label for="">Pasajeros</label>
                                    </div>                                     
                                </div>
                                <div class="col-lg col-md col-12 mb-lg-0 mb-3 text-center">
                                    <button type="submit"  class="btn btn-dark"><img class="mx-2" src="assets/img/buscar.svg" alt="">Buscar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
    <section class="publicidad_div py-5">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-lg-8 col-12">
                    <div class="publicidad_img">
                        <img src="dashboard/files/home/<?= $homeObj->publicidad ?>" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
 
    <section class="section_datos_informacion">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="div owl-carousel owl-info">
                        <?php
                            foreach ($resultBest as $resultsBest) 
                            { 
                        ?>
                            <div class="info_flex">
                                <div><img src="assets/img/info.png" alt="" class="img-fluid"></div>
                                <div class="px-3">
                                    <p><?= $resultsBest->title; ?></p>
                                    <span><?= $resultsBest->subtitle; ?></span>
                                </div>
                            </div>                                
                        <?php 
                            }
                        ?>                                                                      
                    </div>
                </div>
            </div>
        </div>
    </section>
 
    <section class="section_clientes mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5>¿Qué nos dicen nuestros clientes?</h5>
                    <p>Estos destinos populares tienen mucho que ofrecer.</p>
                </div>

                <div class="col-12 mt-5">
                    <div class="seccion_resenas">
                        <div class="owl-carousel owl-items">
                        <?php
                            foreach ($resultComents as $resultscoment) 
                            { 
                        ?> 
                            <div class="item_resena">
                                <div class="title_resena">
                                    <h6><?= $resultscoment->titulo; ?></h6>
                                    <p><?= $resultscoment->parrafo; ?></p>
                                </div>
                                <div class="flex_item_user">
                                    <div><img src="assets/img/eclipse.png" class="img-fluid" alt=""></div>
                                    <div class="px-3">
                                        <p><?= $resultscoment->nombre; ?></p>
                                        <span><?= $resultscoment->cargo; ?></span>
                                    </div>
                                </div>                                
                            </div>
                        <?php 
                            }
                        ?>                                                                                                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  
    <section class="section_datos">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <img src="dashboard/files/home/<?= $homeObj->banner2 ?>" alt="" class="img-fluid">
                </div>
                <div class="col-lg-6">
                    <div class="div_datos">
                        <span><?= $homeObj->texto1 ?></span>
                        <h4><?= $homeObj->texto2 ?></h4>
                        <p class="mb-5">
                            <?= $homeObj->parrafo ?>                           
                        </p>

                        <!-- <a href="">Leer más</a> -->

                        <div class="flex_items mt-5">
                            <div class="item_div">
                                <p><?=$numerototalDestinos?></p>
                                <span>Destinos</span>
                            </div>
                            <div class="item_div">
                                <p><?=$numeroDeViajes?></p>
                                <span>Viajes</span>                                
                            </div>
                            <div class="item_div">
                                <p><?=$numeroDeUsuarios?></p>
                                <span>Usuarios</span>                                
                            </div>
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
    </body>
</html>