<?php include 'app/components/header.php';
?>

<?php include 'app/components/sidebar.php'; ?>

<?php include 'app/components/topbar.php'; ?>
<style>
    .disponible {
        background-color: green;
        color: white;
    }

    .completo {
        background-color: orange;
        color: white;
    }

    .confirmado {
        background-color: blue;
        color: white;
    }

    .progreso {
        background-color: yellow;
        color: black;
    }

    .finalizado {
        background-color: gray;
        color: white;
    }

    .mapa_asientos {
        margin: 50px 0px 0px;
    }

    /* ASIENTOS */
</style>

<?php if ($user_role == 1) : ?>
    <!-- start content -->
    <div class="container-fluid px-4">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 d-flex align-items-center gap-2 font_two">Bienvenido Adminsitrador <?= $staffObj->nombre ?> <?= $staffObj->apellidos ?> !</h1>

        </div>
        <div class="row">

        </div>
    </div>
    <!-- end content -->
<?php elseif ($user_role == 2) : ?>
    <!-- start content -->
    <div class="container-fluid px-4">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 d-flex align-items-center gap-2 font_two"><i class='bx bxs-label'></i> Realizar Reserva</h1>
            <a href="bookings-list" class="btn btn-primary d-flex align-items-center"><i class='bx bx-arrow-back me-1'></i> Volver</a>
        </div>
        <form id="addBookingSales" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="selectedSeats" name="selectedSeats" value="">
            <input type="hidden" id="viaje_id" name="viaje_id" value="">
         
            <div class="row mb-4 p-4 card bg-light">
                <div class="col-lg-12 mb-4">
                    <h5 class="font_two">Seleccionar Viaje</h5>
                    <div class="table-responsive table-light shadow small-table p-3">
                        <table class="table p-lg-4" id="table-travel">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">CORRELATIVO</th>
                                    <th class="text-center" scope="col">TIPO</th>
                                    <th class="text-center" scope="col">MOVILIDAD</th>
                                    <th class="text-center" scope="col">ASIENTOS</th>
                                    <th class="text-center" scope="col">ASIENTOS DISPONIBLES</th>
                                    <th class="text-center" scope="col">HORA SALIDA</th>
                                    <th class="text-center" scope="col">FECHA</th>
                                    <th class="text-center" scope="col">ESTADO</th>
                                    <th class="text-center" scope="col">SELECCIONAR</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="content-sales d-none">
                    <div class="col-lg-12">
                        <h5 class="font_two">Seleccionar Referencia</h5>
                        <div class="form-floating mb-3">
                            <select class="form-select" aria-label="Default select example" name="referencia" required>
                                <option value="WHATSAPP">WHATSAPP</option>
                                <option value="FACEBOOK">FACEBOOK</option>
                                <option value="APP BLABLA">APP BLABLA</option>
                            </select>
                            <label for="floatingInput">Tipo de Referencia</label>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card p-3">
                            <div class="form-group">
                                <label for="searchPoint">Buscar punto:</label>
                                <input type="text" class="form-control" id="searchPoint" placeholder="Ingrese un criterio de búsqueda">
                            </div>
                            <div id="points">

                            </div>
                        </div>

                    </div>
                    <div class="col-lg-12">
                        <h5 class="font_two">Pasajeros</h5>
                        <div class="border row p-3 my-4">
                            <input type="hidden" name="point_id" id="point_id">
                            <div class="col-xl-6">
                                <label for="numPasajeros" class="form-label mb-0">Número de Pasajeros:</label>
                                <select id="numPasajeros" class="form-select" name="num_asientos">
                                    <?php
                                    for ($i = 1; $i <= 30; $i++) {
                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>


                            <div class="col-xl-6">
                                <label for="precioTotal">Precio Total:</label>
                                <input type="text" id="precioTotal" class="form-control" readonly>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-12 mb-4">
                        <div id="pasajeros">
                            <!-- Campos del primer pasajero se agregarán aquí por defecto -->
                            <div class="pasajero row mb-3">
                                <div class="col-xl-6 col-md-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="nombre1" name="nombre[]" placeholder="Nombre" required>
                                        <label for="nombre1">Nombre</label>
                                    </div>
                                </div>
                                   <input type="hidden" id="u" name="u" value="<?= $usuario_id ?>">
                                <div class="col-xl-6 col-md-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="apellidos1" name="apellidos[]" placeholder="Apellidos" required>
                                        <label for="apellidos1">Apellidos</label>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-12">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="correo1" name="correo[]" placeholder="Correo" required>
                                        <label for="correo1">Correo</label>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="celular1" name="celular[]" placeholder="Celular" required>
                                        <label for="celular1">Celular</label>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 mb-4">

                        <h5 class="font_two">Seleccionar Asientos</h5>
                        <div class="mapa_asientos">
                            <ul style="list-style-type: none;" class="d-flex gap-3 justify-content-center">
                                <li>
                                    <p><img class="me-1" src="../assets/img/svg/disponible.svg" alt="">Asiento Disponible</p>
                                </li>
                                <li>
                                    <p><img class="me-1" src="../assets/img/svg/no-disponible.svg" alt="">Asiento no Disponible</p>
                                </li>
                                <li>
                                    <p><img class="me-1" src="../assets/img/svg/seleccionado.svg" alt="">Asientos Seleccionado</p>
                                </li>
                            </ul>
                        </div>
                        <div id="plantillas">

                        </div>


                    </div>

                    <div class="col-xl-12">
                        <h5 class="font_two">Ingresar Voucher de comprobante de compra</h5>
                        <div class="col-xl-12 col-md-12 p-4">
                            <div class="card">
                                <div class="card-body">

                                    <div class="mb-3">
                                        <label for="imagen" class="form-label">Seleccionar Imagen</label>
                                        <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" aria-label="Select File" required>
                                    </div>
                                    <div class="mb-3 text-center d-flex justify-content-center">
                                        <img id="imagenPrevia" class="img-fluid" style="max-height: 300px; display: none;">
                                        <div id="sinImagen" class="alert alert-danger" role="alert" style="display: none;">No image selected</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary" type="submit">Agregar Reserva</button>
                        </div>
                    </div>
                </div>



            </div>
        </form>


    </div>
    <!-- end content -->
<?php endif; ?>

<?php include 'app/components/footer.php'; ?>

<script src="assets/js/travel/get-travel-sales.js"></script>
<script src="assets/js/booking/add-booking-sales.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const asientos = document.querySelectorAll('.d-flex .col-10 div');

        asientos.forEach(asiento => {
            asiento.addEventListener('click', function() {
                const state = this.getAttribute('data-state');

                if (state === 'vacio') {
                    this.querySelector('img').src = 'assets/img/svg/asiento_lleno.svg';
                    this.setAttribute('data-state', 'lleno');
                } else if (state === 'lleno') {
                    this.querySelector('img').src = 'assets/img/svg/asiento_seleccionado.svg';
                    this.setAttribute('data-state', 'seleccionado');
                } else if (state === 'seleccionado') {
                    this.querySelector('img').src = 'assets/img/svg/asiento_vacio.svg';
                    this.setAttribute('data-state', 'vacio');
                }
            });
        });
    });
    document.getElementById('imagen').addEventListener('change', function() {
        var imagenPrevia = document.getElementById('imagenPrevia');
        var sinImagen = document.getElementById('sinImagen');
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                imagenPrevia.src = e.target.result;
                imagenPrevia.style.display = 'block';
                sinImagen.style.display = 'none';
            }
            reader.readAsDataURL(file);
        } else {
            imagenPrevia.style.display = 'none';
            sinImagen.style.display = 'block';
        }
    });
</script>
<script>
    document.getElementById('numPasajeros').addEventListener('change', function() {
        var numPasajeros = parseInt(this.value);
        var pasajerosContainer = document.getElementById('pasajeros');
        var pasajerosHtml = '';

        // Generar campos de entrada de pasajeros dinámicamente con Floating Labels
        for (var i = 1; i <= numPasajeros; i++) {
            pasajerosHtml += `
            <div class="pasajero row mb-3">
                <div class="col-xl-6 col-md-12">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nombre${i}" name="nombre[]" placeholder="Nombre" required>
                        <label for="nombre${i}">Nombre</label>
                    </div>
                </div>
                <div class="col-xl-6 col-md-12">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="apellidos${i}" name="apellidos[]" placeholder="Apellidos" required>
                        <label for="apellidos${i}">Apellidos</label>
                    </div>
                </div>
                <div class="col-xl-6 col-md-12">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="correo${i}" name="correo[]" placeholder="Correo" required>
                        <label for="correo${i}">Correo</label>
                    </div>
                </div>
                <div class="col-xl-6 col-md-12">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="celular${i}" name="celular[]" placeholder="Celular" required>
                        <label for="celular${i}">Celular</label>
                    </div>
                </div>
            </div>
        `;
        }

        // Actualizar el contenido de #pasajeros
        pasajerosContainer.innerHTML = pasajerosHtml;
    });
</script>