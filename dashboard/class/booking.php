<?php

class Booking
{

    public static function getBookingAll()
    {
        // Es una variable que esta en otro archivos
        global $conn;
        $statement = $conn->prepare("
            SELECT 
                tr.*,
                COALESCE(tpe.nombre, 'N/A') AS nombreStaff,
                COALESCE(tpe.apellidos, '') AS apellidosStaff,
                COALESCE(tvi.correlativo, 'N/A') AS correlativoViaje,
                CASE
                    WHEN tr.tipo_viaje = 'ida' THEN (SELECT tn.origen FROM tbl_idas tn WHERE tn.id = tr.punto_id)
                    WHEN tr.tipo_viaje = 'vuelta' THEN (SELECT tn.origen FROM tbl_vueltas tn WHERE tn.id = tr.punto_id)
                    ELSE 'N/A'
                END AS puntoOrigen,
                CASE
                    WHEN tr.tipo_viaje = 'ida' THEN (SELECT tn.destino FROM tbl_idas tn WHERE tn.id = tr.punto_id)
                    WHEN tr.tipo_viaje = 'vuelta' THEN (SELECT tn.destino FROM tbl_vueltas tn WHERE tn.id = tr.punto_id)
                    ELSE 'N/A'
                END AS puntoDestino
            FROM 
                tbl_reservas tr
            LEFT JOIN
                tbl_personal tpe ON tpe.id = tr.staff_id
            LEFT JOIN
                tbl_viajes tvi ON tvi.id = tr.viaje_id
            ORDER BY 
                tr.fecha_creacion DESC
        ");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    
    public static function getBookingPassengersId($id)
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_reservas_pasajeros WHERE reserva_id=:id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    public static function getSeatsPassengersId($id)
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_asientos WHERE reserva_id=:id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    public static function getBookingVentasId($id)
    {
        global $conn;
        $statement = $conn->prepare("
        SELECT 
                tr.*,
                COALESCE(tpe.nombre, 'N/A') AS nombreStaff,
                COALESCE(tpe.apellidos, '') AS apellidosStaff,
                COALESCE(tvi.correlativo, 'N/A') AS correlativoViaje,
                CASE
                    WHEN tr.tipo_viaje = 'ida' THEN (SELECT tn.origen FROM tbl_idas tn WHERE tn.id = tr.punto_id)
                    WHEN tr.tipo_viaje = 'vuelta' THEN (SELECT tn.origen FROM tbl_vueltas tn WHERE tn.id = tr.punto_id)
                    ELSE 'N/A'
                END AS puntoOrigen,
                CASE
                    WHEN tr.tipo_viaje = 'ida' THEN (SELECT tn.destino FROM tbl_idas tn WHERE tn.id = tr.punto_id)
                    WHEN tr.tipo_viaje = 'vuelta' THEN (SELECT tn.destino FROM tbl_vueltas tn WHERE tn.id = tr.punto_id)
                    ELSE 'N/A'
                END AS puntoDestino
            FROM 
                tbl_reservas tr
            LEFT JOIN
                tbl_personal tpe ON tpe.id = tr.staff_id
            LEFT JOIN
                tbl_viajes tvi ON tvi.id = tr.viaje_id
            WHERE 
                tr.id = :id                
            ORDER BY 
                tr.fecha_creacion DESC");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public static function addBookingSales($staffId, $viaje_id, $referencia, $num_asientos, $precioBooking, $point_id, $tipoBooking)
    {
        global $conn;
        $sql = "INSERT INTO tbl_reservas (staff_id , viaje_id, punto_id, tipo_viaje, referencia, asientos_reservados, precio_pagado, fecha_creacion, estado) 
        VALUES (:staffId, :viaje_id, :point_id, :tipoBooking, :referencia, :num_asientos, :precioBooking, NOW(), 'confirmada')";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':staffId', $staffId);
        $stmt->bindParam(':viaje_id', $viaje_id);
        $stmt->bindParam(':referencia', $referencia);
        $stmt->bindParam(':num_asientos', $num_asientos);
        $stmt->bindParam(':precioBooking', $precioBooking);
        $stmt->bindParam(':point_id', $point_id);
        $stmt->bindParam(':tipoBooking', $tipoBooking);
        return $stmt;
    }
    public static function editBookingImageId($lastInsertedId, $imagen)
    {
        global $conn;
        $sql = "UPDATE tbl_reservas SET imagen=:imagen WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $lastInsertedId);
        $stmt->bindParam(':imagen', $imagen);
        return $stmt;
    }
    public static function getVoucherByBookingId($id)
    {
        global $conn;
        $statement = $conn->prepare("SELECT imagen FROM tbl_reservas WHERE id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public static function getQrByBookingId($id)
    {
        global $conn;
        $statement = $conn->prepare("SELECT qr FROM tbl_reservas WHERE id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public static function getSumaTotalPrecioPorMes($mes, $anio)
    {
        global $conn;
        $inicio_mes = "$anio-$mes-01";
        $fin_mes = date('Y-m-t', strtotime($inicio_mes));

        $statement = $conn->prepare("
        SELECT 
            SUM(precio_pagado) as total
        FROM 
            tbl_reservas
        WHERE
            estado = 'confirmada'
            AND fecha_creacion >= :inicio_mes
            AND fecha_creacion <= :fin_mes
    ");
        $statement->bindParam(':inicio_mes', $inicio_mes);
        $statement->bindParam(':fin_mes', $fin_mes);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result['total'] ?? 0; // Devuelve 0 si no hay resultados
    }
    public static function getCountReservasPorMes($mes, $anio)
    {
        global $conn;
        $inicio_mes = "$anio-$mes-01";
        $fin_mes = date('Y-m-t', strtotime($inicio_mes));

        $statement = $conn->prepare("
        SELECT 
            COUNT(id) as total
        FROM 
            tbl_reservas
        WHERE
            fecha_creacion >= :inicio_mes
            AND fecha_creacion <= :fin_mes
    ");
        $statement->bindParam(':inicio_mes', $inicio_mes);
        $statement->bindParam(':fin_mes', $fin_mes);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result['total'] ?? 0; // Devuelve 0 si no hay resultados
    }
    public static function getCountViajesPorMes($mes, $anio)
    {
        global $conn;
        $inicio_mes = "$anio-$mes-01";
        $fin_mes = date('Y-m-t', strtotime($inicio_mes));

        $statement = $conn->prepare("
        SELECT 
            COUNT(id) as total
        FROM 
            tbl_viajes
        WHERE
            fecha_creacion >= :inicio_mes
            AND fecha_creacion <= :fin_mes
    ");
        $statement->bindParam(':inicio_mes', $inicio_mes);
        $statement->bindParam(':fin_mes', $fin_mes);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result['total'] ?? 0; // Devuelve 0 si no hay resultados
    }
    public static function getCountUsuarios()
    {
        global $conn;

        $statement = $conn->prepare("
        SELECT 
            COUNT(id) as total
        FROM 
            tbl_usuarios
    ");
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result['total'] ?? 0; // Devuelve 0 si no hay resultados
    }
    public static function getCountMobility()
    {
        global $conn;

        $statement = $conn->prepare("
            SELECT 
                COUNT(id) as total
            FROM 
                tbl_movilidad
            WHERE
                estado = 'disponible'
        ");
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result['total'] ?? 0; // Devuelve 0 si no hay resultados
    }

    public static function getCountDestinos()
    {
        global $conn;

        $statement = $conn->prepare("
            SELECT 
                COUNT(id) as total
            FROM 
                tbl_vueltas
            WHERE
                estado = 'activo'
        ");
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result['total'] ?? 0; // Devuelve 0 si no hay resultados
    }

    public static function getCountOrigenes()
    {
        global $conn;

        $statement = $conn->prepare("
            SELECT 
                COUNT(id) as total
            FROM 
                tbl_idas
            WHERE
                estado = 'activo'
        ");
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result['total'] ?? 0; // Devuelve 0 si no hay resultados
    }
    public static function getCountStaff()
    {
        global $conn;

        $statement = $conn->prepare("
        SELECT 
            COUNT(id) as total
        FROM 
            tbl_personal
        WHERE
            estado = 'activo'
    ");
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result['total'] ?? 0; // Devuelve 0 si no hay resultados
    }
    public static function getReservasPorMes()
    {
        global $conn;

        $statement = $conn->prepare("
            SELECT 
                DATE_FORMAT(fecha_creacion, '%Y-%m') as mes,
                COUNT(id) as total_reservas
            FROM 
                tbl_reservas
            GROUP BY 
                DATE_FORMAT(fecha_creacion, '%Y-%m')
        ");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    public static function getReferencias()
    {
        global $conn;

        $statement = $conn->prepare("
            SELECT 
                referencia,
                COUNT(*) as total_referencias
            FROM 
                tbl_reservas
            GROUP BY 
                referencia
        ");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public static function getGananciasMensuales()
    {
        global $conn;

        $statement = $conn->prepare("
        SELECT 
            DATE_FORMAT(fecha_creacion, '%Y-%m') as mes,
            SUM(precio_pagado) as total_ganancias
        FROM 
            tbl_reservas
        GROUP BY 
            DATE_FORMAT(fecha_creacion, '%Y-%m')
    ");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    public static function getGastosMensuales()
    {
        global $conn;

        $statement = $conn->prepare("
        SELECT 
            DATE_FORMAT(fecha, '%Y-%m') as mes,
            SUM(precio) as total_gastos
        FROM 
            tbl_gastos
        GROUP BY 
            DATE_FORMAT(fecha, '%Y-%m')
    ");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    public static function getGastosPorCategoria()
    {
        global $conn;

        $statement = $conn->prepare("
        SELECT 
            nombre,
            SUM(precio) as total_gastado
        FROM 
            tbl_gastos
        GROUP BY 
            nombre
    ");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    public static function updateBookingQrId($id, $qr_filename)
    {
        global $conn;
        $sql = "UPDATE tbl_reservas SET qr=:qr_filename WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':qr_filename', $qr_filename);
        return $stmt;
    }
    public static function getBookingAllId($id)
    {
        global $conn; // Asumiendo que $conn es tu conexión a la base de datos PDO
    
        $statement = $conn->prepare("
        SELECT 
            tr.*,  
            tpe.nombre AS nombreStaff,
            tpe.apellidos AS apellidosStaff,
            tvi.correlativo AS correlativoViaje,
            DATE_FORMAT(tvi.fecha_inicio, '%d de %M %Y') AS fechaViajeFormat,
            DATE_FORMAT(tvi.fecha_fin, '%d de %M %Y') AS fechaFinFormat,
            trp.nombre AS nombrePasajero,
            trp.apellidos AS apellidosPasajero,
            trp.correo AS correoPasajero,
            trp.celular AS celularPasajero,
            ta.asiento AS asientoNumero,
            orig.nombre AS nombreOrigen,
            dest.nombre AS nombreDestino
        FROM 
            tbl_reservas tr
        LEFT JOIN
            tbl_personal tpe ON tpe.id = tr.staff_id
        LEFT JOIN
            tbl_viajes tvi ON tvi.id = tr.viaje_id
        LEFT JOIN
            tbl_reservas_pasajeros trp ON trp.reserva_id = tr.id
        LEFT JOIN
            tbl_asientos ta ON ta.reserva_id = tr.id
        LEFT JOIN
            tbl_origen orig ON orig.id = tvi.origen_id
        LEFT JOIN
            tbl_destino dest ON dest.id = tvi.destino_id
        WHERE
            tr.id = :id  
        ORDER BY 
            tr.fecha_creacion DESC
    ");
    
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
    
        return $result;
    }
}
