<?php
session_start(); // Inicia la sesión al comienzo del archivo

// Supongamos que el nombre del usuario está almacenado en $_SESSION['user']
$user = isset($_SESSION['cliente']) ? $_SESSION['cliente'] : null;
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
        .section_contact h3{
            width: fit-content;
            line-height: 2;
            border-bottom: 1px solid #000000;
        }
        .form_contact button{
            background-color: #004AAD !important;
            font-size: 14px;
            text-transform: uppercase;
        }
        .form_contact label{
            font-size: 12px;
        }
    </style>
  <body>
  <?php include 'app/header-home.php' ?>

    <section class="section_contact  ">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-lg-6 col-md-6 col-12 pt-2 pb-lg-0 pb-5">
                    <h3>Contáctanos</h3>
                    <p>Déjanos un mensaje para obtener más información.</p>
                    <form action="" class="form_contact mt-4">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="" placeholder="">
                            <label for="">Nombres y Apellidos</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="" placeholder="">
                            <label for="">Correo</label>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                            <label for="floatingTextarea2">Mensaje</label>
                        </div>
                        <div class="text-center mt-5">
                            <button type="button" class="btn btn-primary">ENVIAR</button>
                        </div>                       
                    </form>
                </div>
                <div class="col-lg-6 col-md-6 col-12 text-center">
                    <img src="assets/img/img_contact_dos.jpg" class="img-fluid w-100" alt="">
                </div>
            </div>
        </div>
    </section>

    <?php include 'app/footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
 
    </body>
</html> 