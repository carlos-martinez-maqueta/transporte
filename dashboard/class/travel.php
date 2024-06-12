<?php

class Travel
{

    public static function consultSecurytyStaff($username, $password)
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_personal WHERE correo = :username AND pass = :password AND estado = 'activo'");
        $statement->bindParam(":username", $username);
        $statement->bindParam(":password", $password);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public static function getMarvelAll()
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_viajes WHERE count > 0 AND estado = 'disponible'");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public static function getMarvelId($id)
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_viajes WHERE id=:id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public static function getTravelAll()
    {
        // Es una variable que esta en otro archivos
        global $conn;
        $statement = $conn->prepare("
        SELECT 
            tv.*,
            tor.nombre AS nombreOrigen,
            tde.nombre AS nombreDestino,
            tmo.matricula AS matriculaMovilidad,
            tmo.capacidad_asientos AS capacidadMovilidad
        FROM 
            tbl_viajes tv
        JOIN
            tbl_origen tor ON tor.id = tv.origen_id
        LEFT JOIN
            tbl_destino tde ON tde.id = tv.destino_id
        LEFT JOIN
            tbl_movilidad tmo ON tmo.id = tv.movilidad_id
        ORDER BY 
            tv.fecha_creacion DESC
            ");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    public static function getTravelAlls($id)
    {
        // Es una variable que esta en otro archivos
        global $conn;
        $statement = $conn->prepare("
        SELECT 
            tv.*,
            tor.nombre AS nombreOrigen,
            tde.nombre AS nombreDestino,
            tmo.matricula AS matriculaMovilidad,
            tmo.capacidad_asientos AS capacidadMovilidad
        FROM 
            tbl_viajes tv
        JOIN
            tbl_origen tor ON tor.id = tv.origen_id
        LEFT JOIN
            tbl_destino tde ON tde.id = tv.destino_id
        LEFT JOIN
            tbl_movilidad tmo ON tmo.id = tv.movilidad_id
        WHERE
            tv.id = :id
        ORDER BY 
            tv.fecha_creacion DESC
            ");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public static function getMarvelPlantillaId($id)
    {
        global $conn;

        // Obtener el ID de la movilidad asociada al viaje
        $statement = $conn->prepare("SELECT movilidad_id FROM tbl_viajes WHERE id=:id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $movilidad_id = $statement->fetchColumn();

        // Obtener el plantilla_id asociado a la movilidad
        $statement = $conn->prepare("SELECT plantilla_id FROM tbl_movilidad WHERE id=:movilidad_id");
        $statement->bindValue(":movilidad_id", $movilidad_id);
        $statement->execute();
        $plantilla_id = $statement->fetchColumn();
        return $plantilla_id;
    }

    public static function addTravel($origin_id, $destino_id, $movilidad_id, $fecha_inicio, $fecha_fin, $staffId, $precio)
    {
        global $conn;

        // Obtener el último correlativo de la tabla
        $sql_correlativo = "SELECT correlativo FROM tbl_viajes ORDER BY id DESC LIMIT 1";
        $stmt_correlativo = $conn->prepare($sql_correlativo);
        $stmt_correlativo->execute();
        $ultimo_correlativo = $stmt_correlativo->fetchColumn();

        // Generar el nuevo correlativo
        if ($ultimo_correlativo) {
            // Extraer el número del correlativo actual
            $numero_correlativo = (int)substr($ultimo_correlativo, 4); // Extraer el número sin el prefijo "TSB-"
            $nuevo_numero_correlativo = $numero_correlativo + 1;
            $nuevo_correlativo = 'TSB-' . str_pad($nuevo_numero_correlativo, 3, '0', STR_PAD_LEFT);
        } else {
            $nuevo_correlativo = 'TSB-001';
        }

        // Obtener la capacidad de asientos de la tabla tbl_movilidad
        $sql_capacidad = "SELECT capacidad_asientos FROM tbl_movilidad WHERE id = :movilidad_id";
        $stmt_capacidad = $conn->prepare($sql_capacidad);
        $stmt_capacidad->bindParam(':movilidad_id', $movilidad_id);
        $stmt_capacidad->execute();
        $capacidad_asientos = $stmt_capacidad->fetchColumn();

        // Insertar el nuevo viaje en la tabla tbl_viajes
        $sql = "INSERT INTO tbl_viajes (correlativo, count, origen_id, destino_id, movilidad_id, fecha_inicio, fecha_fin, fecha_creacion, estado, staff_id, precio) 
                VALUES (:correlativo, :count, :origen_id, :destino_id, :movilidad_id, :fecha_inicio, :fecha_fin, NOW(), 'disponible', :staff_id, :precio)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':correlativo', $nuevo_correlativo);
        $stmt->bindParam(':count', $capacidad_asientos);
        $stmt->bindParam(':origen_id', $origin_id);
        $stmt->bindParam(':destino_id', $destino_id);
        $stmt->bindParam(':movilidad_id', $movilidad_id);
        $stmt->bindParam(':fecha_inicio', $fecha_inicio);
        $stmt->bindParam(':fecha_fin', $fecha_fin);
        $stmt->bindParam(':staff_id', $staffId);
        $stmt->bindParam(':precio', $precio);
        return $stmt;
    }



    public static function editTravelId($id, $origin_id, $destino_id, $movilidad_id, $fecha_inicio, $fecha_fin, $estado)
    {
        global $conn;
        $sql = "UPDATE tbl_viajes SET origen_id=:origen_id, destino_id=:destino_id, movilidad_id=:movilidad_id, fecha_inicio=:fecha_inicio, fecha_fin=:fecha_fin, estado=:estado WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':origen_id', $origin_id);
        $stmt->bindParam(':destino_id', $destino_id);
        $stmt->bindParam(':movilidad_id', $movilidad_id);
        $stmt->bindParam(':fecha_inicio', $fecha_inicio);
        $stmt->bindParam(':fecha_fin', $fecha_fin);
        $stmt->bindParam(':estado', $estado);
        return $stmt;
    }

    public static function settingsStaffId($id, $nombre, $apellidos, $correo, $celular, $pass)
    {
        global $conn;
        $sql = "UPDATE tbl_personal SET nombre=:nombre, apellidos=:apellidos, correo=:correo, celular=:celular, pass=:pass WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':celular', $celular);
        $stmt->bindParam(':pass', $pass);
        return $stmt;
    }
    public static function getTemplateAll()
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_plantillas");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    public static function getTemplateId($id)
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_plantillas WHERE id=:id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result;
    }
}
