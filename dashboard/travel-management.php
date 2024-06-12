<?php include 'app/components/header.php';

$origenObj = Origin::getOriginAllActive();
$destinationObj = Destination::getDestinationAllActive();
$mobilityObj = Mobility::getMobilityAllActive();

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
            <h1 class="h3 mb-0 text-gray-800 d-flex align-items-center gap-2 font_two"><i class="bx bx-library me-1"></i> Listado Viajes</h1>
            <div class="d-flex gap-1">
                <a href="#" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class='bx bx-user-plus me-1'></i> Agregar</a>
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
                                        <?php foreach ($origenObj as $result) : ?>
                                            <option value="<?= htmlspecialchars($result->id) ?>"><?= htmlspecialchars($result->nombre) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="floatingSelect">Origen</label>
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
        <!-- Modal Editar -->
        <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="editStaff" method="POST" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Viaje</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <input type="hidden" id="id" name="id">
                                <div class="form-floating mb-3">
                                    <select class="form-select selectProduct" id="origin_id" name="origin_id">
                                        <option value="" selected>Seleccionar una opción</option>
                                        <?php foreach ($origenObj as $result) : ?>
                                            <option value="<?= htmlspecialchars($result->id) ?>"><?= htmlspecialchars($result->nombre) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="floatingSelect">Origen</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select selectProduct" id="destino_id" name="destino_id">
                                        <option value="" selected>Seleccionar una opción</option>
                                        <?php foreach ($destinationObj as $result) : ?>
                                            <option value="<?= htmlspecialchars($result->id) ?>"><?= htmlspecialchars($result->nombre) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="floatingSelect">Destino</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select selectProduct" id="movilidad_id" name="movilidad_id">
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
                                    <input class="form-control" type="datetime-local" id="fecha_inicio" name="fecha_inicio">
                                    <label for="fecha-hora">Fecha Inicio:</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="datetime-local" id="fecha_fin" name="fecha_fin">
                                    <label for="fecha-hora">Fecha Fin:</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select" aria-label="Default select example" id="estado" name="estado" required>
                                        <option value="disponible">Disponible</option>
                                        <option value="completo">Completo</option>
                                        <option value="confirmado">Confirmado</option>
                                        <option value="progreso">En progreso</option>
                                        <option value="finalizado">Finalizado</option>
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
                    <table class="table p-lg-4" id="table-travel">
                        <!-- Van haber las opciones : VER ECUACION, VER VOUCHER DE COMPRA, CAMBIO DE ESTADO A APROBADO O RECHAZADO -->
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">ID</th>
                                <th class="text-center" scope="col">CORRELATIVO</th>
                                <th class="text-center" scope="col">ORIGEN</th>
                                <th class="text-center" scope="col">DESTION</th>
                                <th class="text-center" scope="col">MOVILIDAD</th>
                                <th class="text-center" scope="col">ASIENTOS</th>
                                <th class="text-center" scope="col">ASIENTOS DISPONIBLES</th>
                                <th class="text-center" scope="col">FECHA INICIO</th>
                                <th class="text-center" scope="col">FECHA FIN</th>
                                <th class="text-center" scope="col">FECHA CREACION</th>
                                <th class="text-center" scope="col">PRECIO</th>
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

<script src="assets/js/travel/get-travel.js"></script>
<script src="assets/js/travel/add-travel.js"></script>
<script src="assets/js/travel/edit-travel.js"></script>