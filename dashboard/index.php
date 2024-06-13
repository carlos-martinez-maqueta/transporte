<?php include 'app/components/header.php';

// Obtiene el mes y el año actual
$mes = date("m");
$anio = date("Y");

// Calcular ganancias mensuales
$ganancias_mensuales = Booking::getSumaTotalPrecioPorMes($mes, $anio);

?>

<?php include 'app/components/sidebar.php'; ?>

<?php include 'app/components/topbar.php'; ?>


<?php if ($user_role == 1) : ?>
    <!-- start content -->
    <div class="container-fluid px-4">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 d-flex align-items-center gap-2 font_two">Bienvenido Adminsitrador <?= $staffObj->nombre ?> <?= $staffObj->apellidos ?> !</h1>

        </div>
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold font_two text-uppercase mb-1">
                                    Ganancias (Mensual)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($ganancias_mensuales, 2) ?> MXN</div>
                            </div>
                            <div class="col-auto">
                                <img src="files/gif/money-bag.gif" alt="" width="50">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold font_two text-uppercase mb-1">
                                    Total Reservations (Monthly)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $bookingCount ?></div>
                            </div>
                            <div class="col-auto">
                                <img src="files/gif/checklist.gif" alt="" width="50">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold font_two text-uppercase mb-1">
                                    Reserved Days (Monthly)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalDuration ?></div>
                            </div>
                            <div class="col-auto">
                                <img src="files/gif/calendar.gif" alt="" width="50">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Total Clients Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold font_two text-uppercase mb-1">
                                    Total Clients</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalClients ?></div>
                            </div>
                            <div class="col-auto">
                                <img src="files/gif/customer.gif" alt="" width="50">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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