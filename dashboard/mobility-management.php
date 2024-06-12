<?php include 'app/components/header.php';

$movilidadObj = Mobility::getMobilityAll();
$templateArray = Travel::getTemplateAll();
?>

<?php include 'app/components/sidebar.php'; ?>

<?php include 'app/components/topbar.php'; ?>
<style>
    .fixed-img {
        width: 100%;
        height: 200px;
        /* Ajusta la altura según tus necesidades */
        object-fit: cover;
        /* Mantiene la proporción de la imagen */
    }

    .list-group-item {
        border-top: 1px solid #ddd;
        /* O cualquier color de borde que prefieras */
    }
</style>

<?php if ($user_role == 1) : ?>
    <!-- start content -->
    <div class="container-fluid px-4">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 d-flex align-items-center gap-2 font_two"> <i class='bx bx-car me-1'></i> Gestion de Movilidad</h1>
            <div class="d-flex gap-1">
                <a href="#" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class='bx bx-plus me-1'></i> Agregar</a>
            </div>
        </div>
        <!-- Modal Agregar -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="addMobility" method="POST" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Staff</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <div class="card p-3 mb-3">
                                    <label for="formFile" class="form-label">Seleccionar imagen de movilidad</label>
                                    <input class="form-control" type="file" id="imagen" name="imagen" required>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="matricula" required>
                                    <label for="floatingInput">Matricula</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="marca" required>
                                    <label for="floatingInput">Marca</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="modelo">
                                    <label for="floatingInput">Modelo</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="color" required>
                                    <label for="floatingInput">Color</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select" aria-label="Default select example" name="tipo_vehiculo" required>
                                        <option value="MINIVAN">MINIVAN</option>
                                        <option value="AUTOBUS">AUTOBUS</option>
                                        <option value="CAMION">CAMION</option>
                                    </select>
                                    <label for="floatingInput">Tipo de Vehiculo</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select selectProduct" id="floatingSelect" name="plantilla_id">
                                        <option value="" selected>Seleccionar una opción</option>
                                        <?php foreach ($templateArray as $result) : ?>
                                            <option value="<?= htmlspecialchars($result->id) ?>"><?= htmlspecialchars($result->nombre) ?> - N° Asientos: <?= htmlspecialchars($result->numero_asientos) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="floatingSelect">Plantillas</label>
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
                <form id="editMobility" method="POST" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Movilidad</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <input type="hidden" id="id" name="id">
                                <div class="card p-3 mb-3">
                                    <label for="formFile" class="form-label">Seleccionar imagen de movilidad</label>
                                    <input class="form-control" type="file" id="imagen" name="imagen">
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="matricula" placeholder="name@example.com" name="matricula" required>
                                    <label for="floatingInput">Matricula</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="marca" placeholder="name@example.com" name="marca" required>
                                    <label for="floatingInput">Marca</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="modelo" placeholder="name@example.com" name="modelo">
                                    <label for="floatingInput">Modelo</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="color" placeholder="name@example.com" name="color" required>
                                    <label for="floatingInput">Color</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="cantidad_asientos" placeholder="name@example.com" disabled>
                                    <label for="floatingInput">Capacidad de Asientos</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select" aria-label="Default select example" id="tipo_vehiculo" name="tipo_vehiculo" required>
                                        <option selected value="MINIVAN">MINIVAN</option>
                                        <option value="AUTOBUS">AUTOBUS</option>
                                        <option value="CAMION">CAMION</option>
                                    </select>
                                    <label for="floatingInput">Tipo de Vehiculo</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select" aria-label="Default select example" id="estado" name="estado" required>
                                        <option selected>Seleccionar</option>
                                        <option value="disponible">Disponible</option>
                                        <option value="mantenimiento">En mantenimiento</option>
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
            <?php foreach ($movilidadObj as $result) : ?>
                <div class="col-xl-3 col-md-6 col-12">
                    <div class="card shadow">
                        <img src="files/mobility/<?= $result->imagen ?>" class="card-img-top fixed-img p-3" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Matricula: <?= $result->matricula ?></h5>
                            <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Marca: <?= $result->marca ?></li>
                            <li class="list-group-item">Modelo: <?= $result->modelo ?></li>
                            <li class="list-group-item">Color: <?= $result->color ?></li>
                            <li class="list-group-item">Tipo Vehiculo: <?= $result->tipo_vehiculo ?></li>
                            <li class="list-group-item">Capacidad Asientos: <?= $result->capacidad_asientos ?></li>
                        </ul>
                        <div class="card-body">
                            <a href="#" class="card-link btn btn-warning btn-sm edit" data-bs-toggle="modal" data-bs-target="#editarModal" data-id="<?= $result->id ?>">Editar</a>
                            <button type="button" class="btn btn-sm cursor-none <?= $result->estado == 'disponible' ? 'btn-success' : 'btn-danger' ?>">
                                <?= $result->estado == 'disponible' ? 'Disponible' : 'En mantenimiento' ?>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
    <!-- end content -->
<?php elseif ($user_role == 2) : ?>

<?php endif; ?>

<?php include 'app/components/footer.php'; ?>

<?php if ($user_role == 1) : ?>
    <script src="assets/js/mobility/add-mobility.js"></script>
    <script src="assets/js/mobility/edit-mobility.js"></script>
<?php elseif ($user_role == 2) : ?>

<?php endif; ?>