<?php include 'app/components/header.php';

$usersObj = User::getUserAllActive();
$homeObj = Home::getHome();

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
    <form id="editHome" method="POST" enctype="multipart/form-data">
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800 d-flex align-items-center gap-2 font_two">Pagina <i class='bx bx-chevrons-right'></i> Gestion de Contenido</h1>
                <button type="submit" class="btn btn-warning btn-sm d-flex align-items-center gap-2"><i class='bx bxs-edit fs-5'></i> Edit</button>
            </div>

            <div class="row mb-5">
                <div class="col-xl-12 col-md-12 mb-4">
                    <input type="hidden" id="id" name="id" value="<?= $homeObj->id ?>">
                    <div class="col-12 mb-2 d-flex justify-content-between">
                        <label for="exampleInputEmail1" class="form-label font_three">Banner</label>
                    </div>
                    <div class="col-12 mb-3 row">
                        <div class="col-xl-6 col-md-12 p-4">
                            <div>
                                <img src="files/home/<?= $homeObj->banner ?>" class="img-fluid" alt="">
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-12 p-4">
                            <div class="card">
                                <div class="card-header text-center">
                                    <h4>Editar banner</h4>
                                </div>
                                <div class="card-body">
                                    <input type="hidden" name="usuario_id">
                                    <div class="mb-3">
                                        <label for="imagen1" class="form-label">Select Image</label>
                                        <input type="file" class="form-control" id="imagen1" name="imagen1" accept="image/*" aria-label="Select File">
                                    </div>
                                    <div class="mb-3 text-center d-flex justify-content-center">
                                        <img id="imagenPrevia1" class="img-fluid" style="max-height: 300px; display: none;">
                                        <div id="sinImagen1" class="alert alert-danger" role="alert" style="display: none;">No image selected</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-3 row">
                        <div class="col-xl-6 col-md-12 p-4">
                            <div>
                                <img src="files/home/<?= $homeObj->publicidad ?>" class="img-fluid" alt="">
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-12 p-4">
                            <div class="card">
                                <div class="card-header text-center">
                                    <h4>Editar Publicidad</h4>
                                </div>
                                <div class="card-body">
                                    <input type="hidden" name="usuario_id">
                                    <div class="mb-3">
                                        <label for="imagen2" class="form-label">Select Image</label>
                                        <input type="file" class="form-control" id="imagen2" name="imagen2" accept="image/*" aria-label="Select File">
                                    </div>
                                    <div class="mb-3 text-center d-flex justify-content-center">
                                        <img id="imagenPrevia2" class="img-fluid" style="max-height: 300px; display: none;">
                                        <div id="sinImagen2" class="alert alert-danger" role="alert" style="display: none;">No image selected</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row col-12 mb-2 d-flex justify-content-between">
                        <div class="col-xl-6">
                            <div class="col-12 d-flex justify-content-center">
                                <div class="col-6">
                                    <img src="files/home/<?= $homeObj->banner2 ?>" class="img-fluid" alt="">
                                </div>
                            </div>
                            <div class="">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <h4>Editar banner 2</h4>
                                    </div>
                                    <div class="card-body">
                                        <input type="hidden" name="usuario_id">
                                        <div class="mb-3">
                                            <label for="imagen3" class="form-label">Select Image</label>
                                            <input type="file" class="form-control" id="imagen3" name="imagen3" accept="image/*" aria-label="Select File">
                                        </div>
                                        <div class="mb-3 text-center d-flex justify-content-center">
                                            <img id="imagenPrevia3" class="img-fluid" style="max-height: 300px; display: none;">
                                            <div id="sinImagen3" class="alert alert-danger" role="alert" style="display: none;">No image selected</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-6 d-flex  align-items-center">
                            <div class="col-12">
                                <div class="col-12 mb-2">
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="texto1" value="<?= $homeObj->texto1 ?>">
                                </div>
                                <div class="col-12 mb-2">
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="texto2" value="<?= $homeObj->texto2 ?>">
                                </div>
                                <div class="col-12 mb-3">
                                    <textarea class="form-control" name="parrafo" id="summer" cols="30" rows="5"><?= $homeObj->parrafo ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

<?php elseif ($user_role == 2) : ?>

<?php endif; ?>
<!-- end content -->
<?php include 'app/components/loading.php'; ?>
<?php include 'app/components/footer.php'; ?>


<?php if ($user_role == 1) : ?>
    <script src="assets/js/page/edit-home.js"></script>
    <script>
        document.getElementById('imagen1').addEventListener('change', function() {
            var imagenPrevia = document.getElementById('imagenPrevia1');
            var sinImagen = document.getElementById('sinImagen1');
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
        document.getElementById('imagen3').addEventListener('change', function() {
            var imagenPrevia = document.getElementById('imagenPrevia3');
            var sinImagen = document.getElementById('sinImagen3');
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
<?php elseif ($user_role == 2) : ?>

<?php endif; ?>