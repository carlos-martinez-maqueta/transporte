<?php
include 'config/conexion.php';
include 'dashboard/class/travel.php';
session_start(); // Inicia la sesión al comienzo del archivo
include 'get/info-viaje.php';
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
 
    <section class="section_steps">
        <div class="container">
            <div class="row align-items-center justify-content-md-center">
                <div class="col-lg-2">
                    <div class="border_blanco"><img src="assets/img/svg/step_1.svg" class="me-2" alt="">Seleccionar Boletos</div>
                </div>
                <div class="col-lg-1 text-center">
                    <img src="assets/img/svg/saltos.svg" alt="">
                </div>
                <div class="col-lg-2">
                    <div class="border_azul"><img src="assets/img/svg/step_2_azul.svg" class="me-2" alt="">Datos de Pasajeros</div>
                </div>
                <div class="col-lg-1 text-center">
                    <img src="assets/img/svg/saltos.svg" alt="">
                </div>
                <div class="col-lg-2">
                    <div class="border_blanco"><img src="assets/img/svg/step_3.svg" class="me-2" alt="">Pago</div>
                </div>
            </div>
        </div>
    </section>
    <section class="section_datos_personales">
        <form action="datos-asientos" method="GET">
            <input type="hidden" name="idviaje" value="<?php echo $viajeid ?>">
            <input type="hidden" name="pasajeros" value="<?php echo $pasajeros ?>">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="datos_personas">
                            <h4>Datos Comprador</h4>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <?php if ($user): ?>
                                            <input type="text" class="form-control" id="" value="<?= htmlspecialchars($nombre) ?>">
                                            <label for="">Nombres</label>                                    
                                        <?php else: ?>
                                            <input type="text" class="form-control" id=""  >
                                            <label for="">Nombres</label>  
                                        <?php endif; ?>
                                    </div>                                
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <?php if ($user): ?>
                                            <input type="text" class="form-control" id="" value="<?= htmlspecialchars($apellidos) ?>">
                                            <label for="">Apellidos</label>
                                        <?php else: ?>
                                            <input type="text" class="form-control" id="" >
                                            <label for="">Apellidos</label>                                        
                                        <?php endif; ?>
                                    </div>                                
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <?php if ($user): ?>
                                            <input type="text" class="form-control" id="" value="<?= htmlspecialchars($correo) ?>">
                                            <label for="">Correo Electrónico</label>
                                        <?php else: ?>
                                            <input type="text" class="form-control" id="" >
                                            <label for="">Correo Electrónico</label>                                        
                                        <?php endif; ?>
                                    </div>                                
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="" placeholder="">
                                        <label for="">Teléfono</label>
                                    </div>                                
                                </div>                            
                            </div>
                        </div>
                        <div class="datos_acompanantes">
                            <h4>Datos de Pasajeros</h4>
                            <?php if ($pasajeros > 1): ?>
                                <?php for ($i = 1; $i < $pasajeros; $i++): ?>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="" placeholder="name@example.com">
                                                <label for="">Nombres</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="" placeholder="name@example.com">
                                                <label for="">Apellidos</label>
                                            </div>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            <?php endif; ?>                    
                        </div>                    
                    </div>
                    <div class="col-lg-6 px-5">
                        <?php include 'views/vista-resumen-ticket.php' ?>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <?php include 'app/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
 
    </body>
</html>