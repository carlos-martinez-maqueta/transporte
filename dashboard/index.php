<?php include 'app/components/header.php'; ?>

<?php include 'app/components/sidebar.php'; ?>

<?php include 'app/components/topbar.php'; ?>


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
            <h1 class="h3 mb-0 text-gray-800 d-flex align-items-center gap-2 font_two">Bienvenido Ejecutivo de Ventas <?= $staffObj->nombre ?> <?= $staffObj->apellidos ?> !</h1>

        </div>
        <div class="row">

        </div>
    </div>
    <!-- end content -->
<?php endif; ?>

<?php include 'app/components/footer.php'; ?>