<?php

class Vuelta { 

    public static function consultSecurytyStaff($username, $password){
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_personal WHERE correo = :username AND pass = :password AND estado = 'activo'");
        $statement->bindParam(":username", $username);
        $statement->bindParam(":password", $password);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public static function getGoingId($id)
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_idas WHERE id=:id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public static function getGoingAll()
    {
        // Es una variable que esta en otro archivos
        global $conn;
        $statement = $conn->prepare("
        SELECT 
            *
        FROM 
            tbl_vueltas
            ");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    public static function addGoing($origen, $destino, $hora_salida, $hora_llegada, $tiempo_estimado, $precio, $reserva)
    {
        global $conn;
        $sql = "INSERT INTO tbl_vueltas (origen, destino,  hora_salida, hora_llegada, tiempo_viaje, precio, reserva, fecha, estado) 
                VALUES (:origen, :destino, :hora_salida, :hora_llegada, :tiempo_estimado, :precio, :reserva, NOW(),'activo')";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':origen', $origen);
        $stmt->bindParam(':destino', $destino);
        $stmt->bindParam(':hora_salida', $hora_salida);
        $stmt->bindParam(':hora_llegada', $hora_llegada);
        $stmt->bindParam(':tiempo_estimado', $tiempo_estimado);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':reserva', $reserva);
        return $stmt;
    }
    public static function editReturnId($id, $origen, $destino, $hora_salida, $hora_llegada, $tiempo_estimado, $precio, $reserva, $estado)
    {
        global $conn;
        $sql = "UPDATE tbl_vueltas SET origen=:origen, destino=:destino, hora_salida=:hora_salida, hora_llegada=:hora_llegada, tiempo_viaje=:tiempo_estimado, precio=:precio, reserva=:reserva, estado=:estado WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':origen', $origen);
        $stmt->bindParam(':destino', $destino);
        $stmt->bindParam(':hora_salida', $hora_salida);
        $stmt->bindParam(':hora_llegada', $hora_llegada);
        $stmt->bindParam(':tiempo_estimado', $tiempo_estimado);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':reserva', $reserva);
        $stmt->bindParam(':estado', $estado);
        return $stmt;
    }
    public static function deleteId($id)
    {
        global $conn;
        $sql = "DELETE FROM tbl_origen WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt;
    }
    public static function getOriginAllActive()
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_origen WHERE estado= 'activo'");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    
    


}