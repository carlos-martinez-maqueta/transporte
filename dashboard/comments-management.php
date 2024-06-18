<?php include 'app/components/header.php'; ?>

<?php include 'app/components/sidebar.php'; ?>

<?php include 'app/components/topbar.php'; ?>


<?php if ($user_role == 1) : ?>
    <!-- start content -->
    <div class="container-fluid px-4">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 d-flex align-items-center gap-2 font_two">Pagina <i class='bx bx-chevrons-right'></i> Gestion Comentarios de Clientes</h1>
            <div class="d-flex gap-1">
                <a href="#" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class='bx bx-user-plus me-1'></i> Agregar</a>
            </div>
        </div>
        <!-- Modal Agregar -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="addComments" method="POST" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Mejor Destino</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">

                                <div class="form-floating mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <input type="hidden" name="usuario_id">
                                            <div class="mb-3">
                                                <label for="imagen" class="form-label">Seleccionar Imagen</label>
                                                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" aria-label="Select File">
                                            </div>
                                            <div class="mb-3 text-center d-flex justify-content-center">
                                                <img id="imagenPrevia" class="img-fluid" style="max-height: 300px; display: none;">
                                                <div id="sinImagen" class="alert alert-danger" role="alert" style="display: none;">No image selected</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="titulo" required>
                                    <label for="floatingInput">Titulo</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="floatingInput" placeholder="Escribe el párrafo aquí" name="parrafo" style="height: 200px;" required></textarea>
                                    <label for="floatingInput">Parrafo</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="nombres" required>
                                    <label for="floatingInput">Nombre Completo</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="cargo" required>
                                    <label for="floatingInput">Cargo</label>
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
                <form id="editComments" method="POST" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Origen</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <input type="hidden" name="id" value="" id="id">
                                <div class="form-floating mb-3">
                                    <div class="card">
                                        <div class="card-header text-center">
                                            <h4>Editar Imagen</h4>
                                        </div>
                                        <div class="card-body">
                                            <input type="hidden" name="usuario_id">
                                            <div class="mb-3">
                                                <label for="imagen2" class="form-label">Seleccionar Imagen</label>
                                                <input type="file" class="form-control" id="imagen2" name="imagen2" accept="image/*" aria-label="Select File">
                                            </div>
                                            <div class="mb-3 text-center d-flex justify-content-center">
                                                <img id="imagenPrevia2" class="img-fluid" style="max-height: 300px; display: none;">
                                                <div id="sinImagen2" class="alert alert-danger" role="alert" style="display: none;">No image selected</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="titulo" placeholder="name@example.com" name="titulo" required>
                                    <label for="floatingInput">Titulo</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="parrafo" placeholder="Escribe el párrafo aquí" name="parrafo" style="height: 200px;" required></textarea>
                                    <label for="floatingInput">Parrafo</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nombres" placeholder="name@example.com" name="nombres" required>
                                    <label for="floatingInput">Nombre Completo</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="cargo" placeholder="name@example.com" name="cargo" required>
                                    <label for="floatingInput">Cargo</label>
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
                    <table class="table p-lg-4" id="table-comments">
                        <!-- Van haber las opciones : VER ECUACION, VER VOUCHER DE COMPRA, CAMBIO DE ESTADO A APROBADO O RECHAZADO -->
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">IMAGEN</th>
                                <th class="text-center" scope="col">TITULO</th>
                                <th class="text-center" scope="col">PARRAFO</th>
                                <th class="text-center" scope="col">NOMBRE</th>
                                <th class="text-center" scope="col">CARGO</th>
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

<script src="assets/js/comments/get-comments.js"></script>
<script src="assets/js/comments/add-comments.js"></script>
<script src="assets/js/comments/edit-comments.js"></script>
<script src="assets/js/comments/delete-comments.js"></script>
<script>
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
    document.getElementById('imagen2').addEventListener('change', function() {
        var imagenPrevia = document.getElementById('imagenPrevia2');
        var sinImagen = document.getElementById('sinImagen2');
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