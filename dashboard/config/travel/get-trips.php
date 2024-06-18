<?php
include '../conexion.php';
include '../../class/travel.php';
include '../../core/Security.php';

session_start();
$staffId = Security::getUserId();

if (isset($_POST['tipo_viaje'])) {
    $tipoViaje = $_POST['tipo_viaje'];

    try {
        // Aquí debes realizar la consulta a la base de datos para obtener los viajes según el tipo
        if ($tipoViaje == 'ida') {
            $query = "SELECT * FROM tbl_idas WHERE estado = 'activo'";
        } else {
            // Cambia la tabla si `vuelta` está en una tabla diferente
            $query = "SELECT * FROM tbl_vueltas WHERE estado = 'activo'";
        }

        $stmt = $conn->prepare($query);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($stmt->rowCount() > 0) {
            echo '<div class="table-responsive">';
            echo '<table class="table">';
            echo '<thead><tr><th>Origen</th><th>Destino</th><th>Hora Salida</th><th>Hora Llegada</th><th>Tiempo de Viaje</th><th>Precio</th><th>Acciones</th></tr></thead>';
            echo '<tbody>';
            foreach ($results as $row) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['origen']) . '</td>';
                echo '<td>' . htmlspecialchars($row['destino']) . '</td>';
                echo '<td>' . htmlspecialchars($row['hora_salida']) . '</td>';
                echo '<td>' . htmlspecialchars($row['hora_llegada']) . '</td>';
                echo '<td>' . htmlspecialchars($row['tiempo_viaje']) . '</td>';
                echo '<td>' . htmlspecialchars($row['precio']) . '</td>';
                echo '<td><button type="button" class="btn btn-danger btn-sm delete-trip" data-id="' . $row['id'] . '"><i class="bx bx-trash"></i></button></td>';
                echo '<input type="hidden" name="viaje_id[]" value="' . $row['id'] . '">';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
            echo '</div>'; // Cierre de div.table-responsive
        } else {
            echo '<p>No hay viajes disponibles.</p>';
        }
    } catch (PDOException $e) {
        echo 'Error al obtener los viajes: ' . $e->getMessage();
    }
} else {
    echo '<p>Tipo de viaje no especificado.</p>';
}
