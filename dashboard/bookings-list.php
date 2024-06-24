<?php include 'app/components/header.php';

$usersObj = User::getUserAllActive();


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
</style>

<?php if ($user_role == 1) : ?>
    <!-- start content -->
    <div class="container-fluid px-4">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 d-flex align-items-center gap-2 font_two"><i class="bx bx-library me-1"></i> Listado Reservas</h1>
            <div class="d-flex gap-1">
                <!-- <a href="#" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class='bx bx-user-plus me-1'></i> Agregar</a> -->
            </div>
        </div>
        <!-- Modal Agregar -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="addTravel" method="POST" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Viajes</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <select class="form-select selectProduct" id="floatingSelect" name="origin_id">
                                        <option value="" selected>Seleccionar una opción</option>
                                        <?php foreach ($usersObj as $result) : ?>
                                            <option value="<?= htmlspecialchars($result->id) ?>"><?= htmlspecialchars($result->nombre) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="floatingSelect">Usuarios</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select selectProduct" id="floatingSelect" name="destino_id">
                                        <option value="" selected>Seleccionar una opción</option>
                                        <?php foreach ($destinationObj as $result) : ?>
                                            <option value="<?= htmlspecialchars($result->id) ?>"><?= htmlspecialchars($result->nombre) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="floatingSelect">Destino</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select selectProduct" id="floatingSelect" name="movilidad_id">
                                        <option value="" selected>Seleccionar una opción</option>
                                        <?php foreach ($mobilityObj as $result) : ?>
                                            <option value="<?= htmlspecialchars($result->id) ?>">
                                                <?= htmlspecialchars($result->matricula) ?> -
                                                <?= htmlspecialchars($result->capacidad_asientos) ?> asientos -
                                                <?= htmlspecialchars($result->tipo_vehiculo) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="floatingSelect">Movilidad</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="datetime-local" id="fecha-hora" name="fecha_inicio">
                                    <label for="fecha-hora">Fecha Inicio:</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="datetime-local" id="fecha-hora" name="fecha_fin">
                                    <label for="fecha-hora">Fecha Fin:</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="precio" placeholder="name@example.com" name="precio" required>
                                    <label for="floatingInput">Precio</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary"><i class='bx bx-save me-1'></i>Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Modal Detalles de Reserva -->
        <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Detalles de Reserva</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5 class="mb-3">Datos de Pasajeros</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Correo</th>
                                    <th>Celular</th>
                                </tr>
                            </thead>
                            <tbody id="pasajerosTableBody">
                                <!-- Los pasajeros se insertarán aquí -->
                            </tbody>
                        </table>
                        <h5 class="mt-5 mb-3">Asientos Asignados</h5>
                        <div class="row row-cols-1 row-cols-md-4 g-4" id="asientosContainer">
                            <!-- Los asientos se insertarán aquí -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="editarDetailsModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Reserva</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="voucherModal" tabindex="-1" aria-labelledby="voucherModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="voucherModalLabel">Voucher</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí se mostrará la imagen -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="voucherModalLabel">Qr</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex justify-content-center">
                        <!-- Aquí se mostrará la imagen -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12 ">
                <div class="table-responsive table-light shadow small-table p-3">
                    <table class="table p-lg-4" id="table-booking">
                        <!-- Van haber las opciones : VER ECUACION, VER VOUCHER DE COMPRA, CAMBIO DE ESTADO A APROBADO O RECHAZADO -->
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">ID</th>
                                <th class="text-center" scope="col">STAFF</th>
                                <th class="text-center" scope="col">ORIGEN</th>
                                <th class="text-center" scope="col">DESTINO</th>
                                <th class="text-center" scope="col">VIAJE</th>
                                <th class="text-center" scope="col">TIPO</th>
                                <th class="text-center" scope="col">REFERENCIA</th>
                                <th class="text-center" scope="col">ASIENTOS RESERVADOS</th>
                                <th class="text-center" scope="col">PRECIO PAGADO</th>
                                <th class="text-center" scope="col">FECHA CREACION</th>
                                <th class="text-center" scope="col">ESTADO</th>
                                <th class="text-center" scope="col">DETALLES</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($user_role == 2) : ?>
    <!-- start content -->
    <div class="container-fluid px-4">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 d-flex align-items-center gap-2 font_two"><i class="bx bx-library me-1"></i> Listado Reservas</h1>
            <div class="d-flex gap-1">
                <a href="add-booking" class="btn btn-primary d-flex align-items-center"><i class='bx bx-user-plus me-1'></i> Agregar</a>
            </div>
        </div>

        <!-- Modal Detalles de Reserva -->
        <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Detalles de Reserva</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5 class="mb-3">Datos de Pasajeros</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Correo</th>
                                    <th>Celular</th>
                                </tr>
                            </thead>
                            <tbody id="pasajerosTableBody">
                                <!-- Los pasajeros se insertarán aquí -->
                            </tbody>
                        </table>
                        <h5 class="mt-5 mb-3">Asientos Asignados</h5>
                        <div class="row row-cols-1 row-cols-md-4 g-4" id="asientosContainer">
                            <!-- Los asientos se insertarán aquí -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="editarDetailsModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form id="editReservaUlt" method="POST" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Reserva</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="idReserva" name="idReserva" value="">
                            <div class="mb-3">
                                <label for="estadoReserva" class="form-label">Estado de la Reserva:</label>
                                <select id="estadoReserva" class="form-select" name="estadoReserva" required>
                                    <!-- Opciones del select se agregarán aquí -->
                                </select>
                            </div>
                            <div class="alert alert-danger" role="alert">
                                ¡Advertencia! Al cambiar el estado a cancelado se borrarán los pasajeros y se designarán los asientos de la reserva. Esta acción no se puede deshacer.
                            </div>

                            <div id="pasajeros">

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button class="btn btn-warning" type="submit">Editar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="voucherModal" tabindex="-1" aria-labelledby="voucherModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="voucherModalLabel">Voucher</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí se mostrará la imagen -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="voucherModalLabel">Qr</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex justify-content-center">
                        <!-- Aquí se mostrará la imagen -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="discountModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="addDescuentoCompra" method="POST" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="voucherModalLabel">Descuento a la compra</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body d-flex justify-content-center">

                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="apellidos1" name="monto_descuento" placeholder="" required>
                                        <label for="apellidos1">Monto Descuento</label>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" id="floatingInput" placeholder="Escribe el párrafo aquí" name="motivo" style="height: 200px;" required=""></textarea>
                                        <label for="floatingInput">Motivo</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 ">
                <div class="table-responsive table-light shadow small-table p-3">
                    <table class="table p-lg-4" id="table-booking">
                        <!-- Van haber las opciones : VER ECUACION, VER VOUCHER DE COMPRA, CAMBIO DE ESTADO A APROBADO O RECHAZADO -->
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">ID</th>
                                <th class="text-center" scope="col">VIAJE</th>
                                <th class="text-center" scope="col">TIPO</th>
                                <th class="text-center" scope="col">ORIGEN</th>
                                <th class="text-center" scope="col">DESTINO</th>
                                <th class="text-center" scope="col">REFERENCIA</th>
                                <th class="text-center" scope="col">ASIENTOS RESERVADOS</th>
                                <th class="text-center" scope="col">PRECIO PAGADO</th>
                                <th class="text-center" scope="col">FECHA CREACION</th>
                                <th class="text-center" scope="col">ESTADO</th>
                                <th class="text-center" scope="col">DETALLES</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<!-- end content -->
<?php include 'app/components/loading.php'; ?>
<?php include 'app/components/footer.php'; ?>


<?php if ($user_role == 1) : ?>
    <script src="assets/js/booking/get-booking.js"></script>
    <script src="assets/js/booking/add-booking.js"></script>
    <script src="assets/js/booking/edit-booking.js"></script>
<?php elseif ($user_role == 2) : ?>
    <script src="assets/js/booking/get-booking-ventas.js"></script>
    <script src="assets/js/booking/add-booking.js"></script>
    <script src="assets/js/booking/add-descuento-compra.js"></script>
    <script src="assets/js/booking/edit-booking.js"></script>
    <script src="assets/js/booking/editReservaUlt.js"></script>
<?php endif; ?>