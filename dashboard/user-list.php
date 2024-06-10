<?php include 'app/components/header.php'; ?>

<?php include 'app/components/sidebar.php'; ?>

<?php include 'app/components/topbar.php'; ?>



<?php if ($user_role == 1) : ?>
    <!-- start content -->
    <div class="container-fluid px-4">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 d-flex align-items-center gap-2 font_two"><i class="bx bx-library me-1"></i> Listado Usuarios</h1>
            <div class="d-flex gap-1">
                <a href="#" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class='bx bx-user-plus me-1'></i> Agregar</a>
            </div>
        </div>
        <!-- Modal Agregar -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="addUser" method="POST" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Usuario</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="nombre" required>
                                    <label for="floatingInput">Nombre</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="apellidos" required>
                                    <label for="floatingInput">Apellidos</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="correo" required>
                                    <label for="floatingInput">Correo</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="celular" required>
                                    <label for="floatingInput">Celular</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="floatingInput" placeholder="name@example.com" name="pass" required>
                                    <label for="floatingInput">Contraseña</label>
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
                <form id="editUser" method="POST" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Usuario</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <input type="hidden" id="id" name="id">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nombre" placeholder="name@example.com" name="nombre" required>
                                    <label for="floatingInput">Nombre</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="apellidos" placeholder="name@example.com" name="apellidos" required>
                                    <label for="floatingInput">Apellidos</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="correo" placeholder="name@example.com" name="correo" required>
                                    <label for="floatingInput">Correo</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="celular" placeholder="name@example.com" name="celular" required>
                                    <label for="floatingInput">Celular</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select" aria-label="Default select example" id="estado" name="estado" required>
                                        <option selected>Seleccionar</option>
                                        <option value="activo">Activo</option>
                                        <option value="inactivo">Inactivo</option>
                                    </select>
                                    <label for="floatingInput">Estado</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="pass" placeholder="name@example.com" name="pass" required>
                                    <label for="floatingInput">Contraseña</label>
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
        <!-- Modal QR -->
        <div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="editUser" method="POST" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Qr Usuario</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12 d-flex justify-content-center">

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>



        <div class="row">
            <div class="col-lg-12 ">
                <div class="table-responsive table-light shadow small-table p-3">
                    <table class="table p-lg-4" id="table-user">
                        <!-- Van haber las opciones : VER ECUACION, VER VOUCHER DE COMPRA, CAMBIO DE ESTADO A APROBADO O RECHAZADO -->
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">ID</th>
                                <th class="text-center" scope="col">NOMBRE</th>
                                <th class="text-center" scope="col">APELLIDOS</th>
                                <th class="text-center" scope="col">CORREO</th>
                                <th class="text-center" scope="col">CELULAR</th>
                                <th class="text-center" scope="col">FECHA CREACION</th>
                                <th class="text-center" scope="col">ORIGEN</th>
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
    <!-- end content -->
<?php elseif ($user_role == 2) : ?>
    <!-- start content -->
    <div class="container-fluid px-4">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 d-flex align-items-center gap-2 font_two"><i class="bx bx-library me-1"></i> Listado Usuarios</h1>
            <div class="d-flex gap-1">
                <a href="#" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class='bx bx-user-plus me-1'></i> Agregar</a>
            </div>
        </div>
        <!-- Modal Agregar -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="addUser" method="POST" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Usuario</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="nombre" required>
                                    <label for="floatingInput">Nombre</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="apellidos" required>
                                    <label for="floatingInput">Apellidos</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="correo" required>
                                    <label for="floatingInput">Correo</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="celular" required>
                                    <label for="floatingInput">Celular</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="floatingInput" placeholder="name@example.com" name="pass" required>
                                    <label for="floatingInput">Contraseña</label>
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

        <!-- Modal QR -->
        <div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="editUser" method="POST" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Qr Usuario</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12 d-flex justify-content-center">

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>



        <div class="row">
            <div class="col-lg-12 ">
                <div class="table-responsive table-light shadow small-table p-3">
                    <table class="table p-lg-4" id="table-user">
                        <!-- Van haber las opciones : VER ECUACION, VER VOUCHER DE COMPRA, CAMBIO DE ESTADO A APROBADO O RECHAZADO -->
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">ID</th>
                                <th class="text-center" scope="col">NOMBRE</th>
                                <th class="text-center" scope="col">APELLIDOS</th>
                                <th class="text-center" scope="col">CORREO</th>
                                <th class="text-center" scope="col">CELULAR</th>
                                <th class="text-center" scope="col">FECHA CREACION</th>
                                <th class="text-center" scope="col">ORIGEN</th>
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
    <!-- end content -->
<?php endif; ?>

<?php include 'app/components/loading.php'; ?>
<?php include 'app/components/footer.php'; ?>
<?php if ($user_role == 1) : ?>
    <script src="assets/js/user/get-user.js"></script>
    <script src="assets/js/user/add-user.js"></script>
    <script src="assets/js/user/edit-user.js"></script>
<?php elseif ($user_role == 2) : ?>
    <script src="assets/js/user/get-user-ventas.js"></script>
    <script src="assets/js/user/add-user-ventas.js"></script>
    <script src="assets/js/user/edit-user.js"></script>
<?php endif; ?>