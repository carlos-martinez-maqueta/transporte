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
    <section class="section_cuadrados">
        <div class="container-fluid h-100">
            <div class="row h-100">
                <div class="col-lg-6 sec_black d-lg-block d-none">
                    <div><img src="assets/img/login.png" alt=""></div>
                </div>
                <div class="col-lg-6 sec_white">
                    <div class="clas_form">
                        <div>
                            <div class="a_home"><a href="index">INICIO</a></div>
                            <img src="assets/img/logo_login.svg" class="img-fluid" alt="">

                            <h3>Iniciar Sesión</h3>
                            <p>¡Ingresa para explorar un mundo de posibilidades!</p>  
                            
                            <form id="loginForm" class="mt-5">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="usernameInput" placeholder="name@example.com">
                                    <label for="usernameInput">Ingresar Correo</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="passwordInput" placeholder="Contraseña">
                                    <label for="passwordInput">Ingresar Contraseña</label>
                                </div>
                                <button type="submit" class="btn btn-dark w-100">Ingresar</button>
                            </form>
                            <div  class="mt-4">
                                <p class=" text-center">No tienes una cuenta? <a href="register">Registrate Aquí</a></p>
                                <p class="m-0">Empieza cada día con la determinación de hacer posible lo imposible. ¡Bienvenido!</p>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/login.js"></script>
    </body>
</html>