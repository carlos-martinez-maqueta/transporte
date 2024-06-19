<?php include 'app/components/header.php';

// Obtiene el mes y el año actual
$mes = date("m");
$anio = date("Y");

// Calcular ganancias mensuales
$ganancias_mensuales = Booking::getSumaTotalPrecioPorMes($mes, $anio);
// Calcular el conteo total de reservaciones mensuales
$bookingCount = Booking::getCountReservasPorMes($mes, $anio);
// Calcular el conteo total de viajes mensuales
$viajesCount = Booking::getCountViajesPorMes($mes, $anio);
// Calcular el conteo total de usuarios
$usuariosCount = Booking::getCountUsuarios();
// Calcular el conteo total de movilidad
$mobilityCount = Booking::getCountMobility();
// Calcular el conteo total de origenes
$origenesCount = Booking::getCountOrigenes();
// Calcular el conteo total de destinos
$destinosCount = Booking::getCountDestinos();
// Llama a la función para obtener el conteo de trabajadores activos
$staffCount = Booking::getCountStaff();



// Obtener los datos de ganancias por mes desde PHP
$gananciasData = Booking::getGananciasMensuales();

// Obtener los datos de gastos por mes desde PHP
$gastosData = Booking::getGastosMensuales();

// Procesar los datos para el gráfico de ingresos y egresos
$labels = [];
$ingresos = [];
$egresos = [];

// Combina los datos de ingresos y egresos en un solo conjunto de datos
foreach ($gananciasData as $ganancia) {
    $mes = $ganancia['mes'];
    $totalGanancias = $ganancia['total_ganancias'];

    // Busca el gasto correspondiente al mes actual, si existe
    $totalGastos = 0;
    foreach ($gastosData as $gasto) {
        if ($gasto['mes'] === $mes) {
            $totalGastos = $gasto['total_gastos'];
            break;
        }
    }

    $labels[] = $mes;
    $ingresos[] = $totalGanancias;
    $egresos[] = $totalGastos;
}


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
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold font_two text-uppercase mb-1">
                                    Reservas Totales (Mensual)</div>
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
                                    Total Viajes (Mensual)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $viajesCount  ?></div>
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
                                    Total Clientes</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $usuariosCount  ?></div>
                            </div>
                            <div class="col-auto">
                                <img src="files/gif/customer.gif" alt="" width="50">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold font_two text-uppercase mb-1">
                                    Total Movilidades</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $mobilityCount  ?></div>
                            </div>
                            <div class="col-auto">
                                <img src="files/gif/autobus.gif" alt="" width="50">
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
                                    Puntos Idas</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $origenesCount ?></div>
                            </div>
                            <div class="col-auto">
                                <img src="files/gif/mapa-del-tesoro.gif" alt="" width="50">
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
                                    Puntos Vueltas</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $destinosCount ?></div>
                            </div>
                            <div class="col-auto">
                                <img src="files/gif/mapa-del-tesoro.gif" alt="" width="50">
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
                                    Total Staff</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $staffCount ?></div>
                            </div>
                            <div class="col-auto">
                                <img src="files/gif/customer.gif" alt="" width="50">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-xl-6 col-md-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold font_two">Estadísticas Mensuales de Reservas</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="pt-4 pb-2 d-flex justify-content-center">
                            <canvas id="myChart" style="max-height: 300px;"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i> Puntuación Mensual de Reservas
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold font_two">Distribución de Referencias</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="pt-4 pb-2 d-flex justify-content-center">
                            <canvas id="myReferencesChart" style="max-height: 300px;"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i> Puntuación de Referencias
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold font_two">Análisis de Ingresos Mensuales</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="pt-4 pb-2">
                            <canvas id="myCombinedChart" style="max-height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold font_two">Estadísticas de Gastos por Categoría</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="pt-4 pb-2">
                            <canvas id="myExpensesChart" width="400" height="250"></canvas>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Obtener los datos de reservas por mes desde PHP
    let reservasData = <?php echo json_encode(Booking::getReservasPorMes()); ?>;

    // Procesar los datos para el gráfico
    let reservasLabels = [];
    let reservasCount = [];
    reservasData.forEach(function(item) {
        reservasLabels.push(item.mes);
        reservasCount.push(item.total_reservas);
    });

    // Dibujar el gráfico de reservas
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: reservasLabels,
            datasets: [{
                label: 'Reservas por mes',
                data: reservasCount,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
<script>
    // Obtener los datos de referencias desde PHP
    let referenciasData = <?php echo json_encode(Booking::getReferencias()); ?>;

    // Colores para las barras de referencias
    let referenciasColors = [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
    ];

    // Procesar los datos para el gráfico de referencias
    let referenciasLabels = [];
    let referenciasTotales = [];
    let referenciasBackgroundColors = [];
    referenciasData.forEach(function(item, index) {
        referenciasLabels.push(item.referencia);
        referenciasTotales.push(item.total_referencias);
        referenciasBackgroundColors.push(referenciasColors[index % referenciasColors.length]);
    });

    // Dibujar el gráfico de referencias
    var ctx = document.getElementById('myReferencesChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: referenciasLabels,
            datasets: [{
                label: 'Total de Reservas',
                data: referenciasTotales,
                backgroundColor: referenciasBackgroundColors,
                borderColor: 'rgba(0, 0, 0, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

</script>
<script>
    // Dibujar el gráfico de ingresos y egresos
    var ctx = document.getElementById('myCombinedChart').getContext('2d');
    var myCombinedChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                label: 'Ingresos',
                data: <?php echo json_encode($ingresos); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }, {
                label: 'Egresos',
                data: <?php echo json_encode($egresos); ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
<script>
    // Obtener los datos de gastos por categoría desde PHP
    let gastosData = <?php echo json_encode(Booking::getGastosPorCategoria()); ?>;

    // Colores para las barras
    let colors = [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
    ];

    // Procesar los datos para el gráfico de gastos por categoría
    let gastosLabels = [];
    let gastosTotales = [];
    let backgroundColors = [];
    gastosData.forEach(function(item, index) {
        gastosLabels.push(item.nombre);
        gastosTotales.push(item.total_gastado);
        backgroundColors.push(colors[index % colors.length]);
    });

    // Dibujar el gráfico de gastos por categoría
    var ctx = document.getElementById('myExpensesChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: gastosLabels,
            datasets: [{
                label: 'Total Gastado',
                data: gastosTotales,
                backgroundColor: backgroundColors,
                borderColor: 'rgba(0, 0, 0, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>