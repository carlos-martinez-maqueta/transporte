<?php
session_start();

// Verifica si ya hay una sesión activa
if (isset($_SESSION['user'])) {
    // Si hay una sesión activa, redirige al usuario a la página de inicio
    header("Location: index");
    exit();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/login-usuario.css">
    <link rel="stylesheet" href="assets/css/mobile.css">
</head>
  <body>    
    <section class="section_cuadrados section_register">
        <div class="container-fluid h-100">
            <div class="row h-100">
                <div class="col-lg-6 sec_black d-lg-block d-none">
                    <div><img src="assets/img/register.png" alt=""></div>
                </div>
                <div class="col-lg-6 sec_white">
                    <div class="clas_form">
                        <div>
                            <div class="a_home"><a href="index">INICIO</a></div>
                            <img src="assets/img/logo_login.svg" class="img-fluid" alt="">

                            <h3>Crear una Cuenta</h3>
                            <p>Explora el mundo con la garantía de un servicio confiable.!</p>  
                            
                            <form action="" class="form_register mt-5">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-6">
                                        <div class="form-floating mb-3 ">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
                                            <label for="floatingInput">Nombre</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
                                            <label for="floatingInput">Apellidos</label>
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-6">
                                        <div class="form-floating mb-3 ">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
                                            <label for="floatingInput">Correo Electronico</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
                                            <label for="floatingInput">Celular</label>
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-6">
                                        <div class="form-floating mb-3 ">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
                                            <label for="floatingInput">Nombre de Usuario (NICK)</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
                                            <label for="floatingInput">Contraseña</label>
                                        </div> 
                                    </div>
                                </div>                                                        
                                <button type="button" class="btn btn-dark w-100">Registrarse</button>
                            </form>
                            <div  class="mt-4">
                                <p class=" text-center">Ya tienes una cuenta? <a href="login-usuario">Ingresa Aquí</a></p>
                                <p class="m-0">Empieza cada día con la determinación de hacer posible lo imposible. ¡Bienvenido!</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <style>
        .section_register .sec_white .clas_form h3 {
            font-size: 45px;
            font-weight: bold;
            margin: 20px 0px 0px;
        }
        .form_register input{
            background-color: #F7F7F7;
            border: none;
        }
        .form_register label{
            color: #696969;
            font-weight: 100;
            font-size: 14px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>