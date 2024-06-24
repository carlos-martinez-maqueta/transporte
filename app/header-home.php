<header>
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-3 col-12 center_logo">
                <div><a href="index"><img src="assets/img/logo_header.svg" alt="" class="img-fluid"></a></div>
            </div>
            <div class="col-lg-6 col-8">
                <ul class="ul_header">
                    <li class="active"><a href="index">Inicio</a></li>
                    <li><a href="rutas">Rutas</a></li>
                    <!-- <li><a href="nosotros">Nosotros</a></li> -->
                    <li><a href="contacto">Contacto</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-4 text-end ">
                <?php if ($user): ?>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Bienvenido, <?= htmlspecialchars($user) ?>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="logout.php">Cerrar sesión 
                                    <!-- <img src="assets/img/login.svg" alt="" class="img-fluid mx-2"> Cerrar sesión -->
                                </a>
                            </li>
                        </ul>
                    </div>
                <?php else: ?>
                    <div class="login_a"><a href="login-usuario"><img src="assets/img/login.svg" alt="" class="img-fluid mx-2"> Ingresar</a></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>