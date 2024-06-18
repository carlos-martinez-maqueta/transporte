<?php
include 'config/conexion.php';
include 'dashboard/class/travel.php';
include 'dashboard/class/plantilla.php';
include 'dashboard/class/mobility.php';
include 'dashboard/class/asientos.php';
session_start(); // Inicia la sesión al comienzo del archivo
include 'get/info-viaje.php';
$descuentoboleto = $totalboletos / 2;
?>
<!doctype html>
<html lang="en">
<?php include 'app/head.php' ?>
    <style>
        body{
            background-color: #ffffff;
        }
        header{
            border-bottom: 1px solid #000000;
        }
        .terminos_asientos{
            display: none;
        }
    </style>
  <body>
    <?php include 'app/header-home.php' ?>
 
    <section class="section_steps">
        <div class="container">
            <div class="row align-items-center justify-content-center justify-content-md-center ">
                <div class="col-xl-2 col-lg-3 col-md-4 col-3">
                    <div class="border_blanco"><img src="assets/img/svg/step_1.svg" class="me-2 img_icon" alt="">Seleccionar Boletos</div>
                </div>
                <div class="col-xl-1 col-lg-1 col-md-1 col-1 text-center">
                    <img src="assets/img/svg/saltos.svg" alt="">
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-3">
                    <div class="border_azul"><img src="assets/img/svg/step_2_azul.svg" class="me-2 img_icon" alt="">Datos de Pasajeros</div>
                </div>
                <div class="col-xl-1 col-lg-1 col-md-1 col-1 text-center">
                    <img src="assets/img/svg/saltos.svg" alt="">
                </div>
                <div class="col-xl-2 col-lg-3 col-md-2 col-3">
                    <div class="border_blanco"><img src="assets/img/svg/step_3.svg" class="me-2 img_icon" alt="">Pago</div>
                </div>
            </div>
        </div>
    </section>
    <section class="section_datos_personales">
        <form action="datos-asientos" method="GET" id="datos-form">
            <input type="hidden" name="idviaje" value="<?php echo $viajeid ?>">
            <input type="hidden" name="pasajeros" value="<?php echo $pasajeros ?>">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="datos_personas">
                            <h4>Datos Comprador</h4>
                            <span>Ingresa tus datos</span>
                            <div class="row mt-3">
                                <div class="col-lg-6 col-md-6 col-6">
                                    <div class="form-floating mb-3">
                                        <?php if ($user): ?>
                                            <input type="text" class="form-control" id="" value="<?= htmlspecialchars($nombre) ?>">
                                            <label for="">Nombres</label>                                    
                                        <?php else: ?>
                                            <input type="text" class="form-control" id="" name="nombre" required >
                                            <label for="" name="nombre">Nombres</label>  
                                        <?php endif; ?>
                                    </div>                                
                                </div>
                                <div class="col-lg-6 col-md-6 col-6">
                                    <div class="form-floating mb-3">
                                        <?php if ($user): ?>
                                            <input type="text" class="form-control" id="" value="<?= htmlspecialchars($apellidos) ?>">
                                            <label for="">Apellidos</label>
                                        <?php else: ?>
                                            <input type="text" name="apellidos" class="form-control" id="" required>
                                            <label for="">Apellidos</label>                                        
                                        <?php endif; ?>
                                    </div>                                
                                </div>
                                <div class="col-lg-6 col-md-6 col-6">
                                    <div class="form-floating mb-3">
                                        <?php if ($user): ?>
                                            <input type="text" class="form-control" id="" value="<?= htmlspecialchars($correo) ?>">
                                            <label for="">Correo Electrónico</label>
                                        <?php else: ?>
                                            <input type="text" class="form-control" name="correo" id="" required>
                                            <label for="" >Correo Electrónico</label>                                        
                                        <?php endif; ?>
                                    </div>                                
                                </div>
                                <div class="col-lg-6 col-md-6 col-6">
                                    <div class="form-floating mb-3">
                                        <?php if ($user): ?>
                                            <input type="text" class="form-control" id="" value="<?= htmlspecialchars($telefono) ?>" >
                                            <label for="">Teléfono</label>
                                        <?php else: ?> 
                                            <input type="text" class="form-control" name="telefono" id="" required>
                                            <label for="" >Teléfono con WhatsApp</label>
                                        <?php endif; ?>
                                    </div>                                
                                </div>                            
                            </div>
                        </div>
                        <div class="datos_acompanantes">
                            <?php if ($pasajeros > 1): ?>
                                <h4>Datos de Acompañantes</h4>
                                <?php for ($i = 1; $i < $pasajeros; $i++): ?>
                                    <div class="row acompanante" data-index="<?= $i ?>">
                                        <div class="col-lg-6 col-md-6 col-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="nombre_acompanante_<?= $i ?>" placeholder="Nombres" required>
                                                <label for="nombre_acompanante_<?= $i ?>">Nombres</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="apellidos_acompanante_<?= $i ?>" placeholder="Apellidos" required>
                                                <label for="apellidos_acompanante_<?= $i ?>">Apellidos</label>
                                            </div>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            <?php endif; ?>
                        </div>                 
                    </div>
                    <div class="col-lg-6 col-md-5 px-lg-5">
                        <?php include 'views/vista-resumen-ticket.php' ?>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <?php include 'app/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.getElementById('save-data').addEventListener('click', function() {
            const nombre = document.querySelector('[name="nombre"]');
            const apellidos = document.querySelector('[name="apellidos"]');
            const correo = document.querySelector('[name="correo"]');
            const telefono = document.querySelector('[name="telefono"]');
            const viajeid = document.querySelector('[name="idviaje"]').value;
            const pasajeros = document.querySelector('[name="pasajeros"]').value;
           

            // Verificar si todos los campos requeridos están llenos
            const isValid = nombre.checkValidity() && apellidos.checkValidity() && correo.checkValidity() && telefono.checkValidity();

            if (isValid) {
                // Guardar datos en localStorage
                localStorage.setItem('nombre', nombre.value);
                localStorage.setItem('apellidos', apellidos.value);
                localStorage.setItem('correo', correo.value);
                localStorage.setItem('telefono', telefono.value);

                // Guardar datos de acompañantes
                const acompanantes = [];
                document.querySelectorAll('.acompanante').forEach((acompanante, index) => {
                    const nombreAcompanante = acompanante.querySelector('[name="nombre_acompanante_' + (index + 1) + '"]');
                    const apellidosAcompanante = acompanante.querySelector('[name="apellidos_acompanante_' + (index + 1) + '"]');
                    if (nombreAcompanante && apellidosAcompanante) {
                        acompanantes.push({ nombre: nombreAcompanante.value, apellidos: apellidosAcompanante.value });
                    }
                });
                localStorage.setItem('acompanantes', JSON.stringify(acompanantes));

                // Redirigir al siguiente paso del formulario
                window.location.href = `datos-asientos?idviaje=${viajeid}&pasajeros=${pasajeros}`;
            } else {
                alert('Por favor, complete todos los campos requeridos');
                if (!nombre.checkValidity()) nombre.focus();
                else if (!apellidos.checkValidity()) apellidos.focus();
                else if (!correo.checkValidity()) correo.focus();
                else if (!telefono.checkValidity()) telefono.focus();
            }
        });
    </script>

    </body>
</html>