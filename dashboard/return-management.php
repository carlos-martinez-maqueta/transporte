<?php include 'app/components/header.php'; ?>

<?php include 'app/components/sidebar.php'; ?>

<?php include 'app/components/topbar.php'; ?>


<?php if ($user_role == 1) : ?>
    <!-- start content -->
    <div class="container-fluid px-4">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 d-flex align-items-center gap-2 font_two"><i class="bx bx-library me-1"></i> Listado de puntos de Vuelta</h1>
            <div class="d-flex gap-1">
                <a href="#" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class='bx bx-user-plus me-1'></i> Agregar</a>
            </div>
        </div>
        <!-- Modal Agregar -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="addReturn" method="POST" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Punto</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="origen" placeholder="name@example.com" name="origen" required>
                                    <label for="floatingInput">Origen</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="destino" placeholder="name@example.com" name="destino" required>
                                    <label for="floatingInput">Destino</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="hora_salida" placeholder="name@example.com" name="hora_salida" required>
                                    <label for="floatingInput">Hora Salida</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="hora_llegada" placeholder="name@example.com" name="hora_llegada" required>
                                    <label for="floatingInput">Hora Llegada</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="tiempo_estimado" placeholder="name@example.com" name="tiempo_estimado" required>
                                    <label for="floatingInput">Tiempo Estimado</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="precio" placeholder="name@example.com" name="precio" required>
                                    <label for="floatingInput">Precio</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="reserva" placeholder="name@example.com" name="reserva" required>
                                    <label for="floatingInput">Reserva</label>
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
        <!-- Modal Editar -->
        <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="editReturn" method="POST" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Origen</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <input type="hidden" id="id" name="id">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="origen" placeholder="name@example.com" name="origen" required>
                                    <label for="floatingInput">Origen</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="destino" placeholder="name@example.com" name="destino" required>
                                    <label for="floatingInput">Destino</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="hora_salida" placeholder="name@example.com" name="hora_salida" required>
                                    <label for="floatingInput">Hora Salida</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="hora_llegada" placeholder="name@example.com" name="hora_llegada" required>
                                    <label for="floatingInput">Hora Llegada</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="tiempo_estimado" placeholder="name@example.com" name="tiempo_estimado" required>
                                    <label for="floatingInput">Tiempo Estimado</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="precio" placeholder="name@example.com" name="precio" required>
                                    <label for="floatingInput">Precio</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="reserva" placeholder="name@example.com" name="reserva" required>
                                    <label for="floatingInput">Reserva</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select" aria-label="Default select example" id="estado" name="estado" required>
                                        <option value="activo">Activo</option>
                                        <option value="inactivo">Inactivo</option>
                                    </select>
                                    <label for="floatingInput">Estado</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-warning"><i class='bx bx-save me-1'></i>Editar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 ">
                <div class="table-responsive table-light shadow small-table p-3">
                    <table class="table p-lg-4" id="table-return">
                        <!-- Van haber las opciones : VER ECUACION, VER VOUCHER DE COMPRA, CAMBIO DE ESTADO A APROBADO O RECHAZADO -->
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">ORDEN</th>
                                <th class="text-center" scope="col">ORIGEN</th>
                                <th class="text-center" scope="col">DESTINO</th>
                                <th class="text-center" scope="col">HORA SALIDA</th>
                                <th class="text-center" scope="col">HORA LLEGADA</th>
                                <th class="text-center" scope="col">TIEMPO ESTIMADO</th>
                                <th class="text-center" scope="col">PRECIO</th>
                                <th class="text-center" scope="col">RESERVA</th>
                                <th class="text-center" scope="col">FECHA CREACION</th>
                                <th class="text-center" scope="col">ESTADO</th>
                                <th class="text-center" scope="col">ACCIONES</th>
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

<?php endif; ?>
<!-- end content -->
<?php include 'app/components/loading.php'; ?>
<?php include 'app/components/footer.php'; ?>

<script src="assets/js/return/get-return.js"></script>
<script src="assets/js/return/add-return.js"></script>
<script src="assets/js/return/edit-return.js"></script>