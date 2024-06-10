<?php

class User { 

    // public static function consultSecurytyStaff($username, $password){
    //     global $conn;
    //     $statement = $conn->prepare("SELECT * FROM tbl_personal WHERE correo = :username AND pass = :password AND estado = 'activo'");
    //     $statement->bindParam(":username", $username);
    //     $statement->bindParam(":password", $password);
    //     $statement->execute();
    //     $result = $statement->fetch(PDO::FETCH_OBJ);
    //     return $result;
    // }
    public static function getUserId($id)
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_usuarios WHERE id=:id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public static function getUserAll()
    {
        // Es una variable que esta en otro archivos
        global $conn;
        $statement = $conn->prepare("
        SELECT 
            *
        FROM 
            tbl_usuarios
        ORDER BY 
            fecha_creacion DESC
            ");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    public static function addUser($nombre, $apellidos, $correo, $celular, $pass, $referencia, $origen)
    {
        global $conn;
        $sql = "INSERT INTO tbl_usuarios (nombre, apellidos, correo, celular, fecha_creacion, referencia, pass, estado, origen) 
                VALUES (:nombre, :apellidos, :correo, :celular, NOW(), :referencia, :pass, 'activo', :origen)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':celular', $celular);
        $stmt->bindParam(':pass', $pass);
        $stmt->bindParam(':referencia', $referencia);
        $stmt->bindParam(':origen', $origen);
        return $stmt;
    }
    public static function editUserId($id, $nombre, $apellidos, $correo, $celular, $estado, $pass)
    {
        global $conn;
        $sql = "UPDATE tbl_usuarios SET nombre=:nombre, apellidos=:apellidos, correo=:correo, celular=:celular, estado=:estado, pass=:pass WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':celular', $celular);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':pass', $pass);
        return $stmt;
    }
    public static function updateUserQrId($id, $qr_filename)
    {
        global $conn;
        $sql = "UPDATE tbl_usuarios SET qr=:qr_filename WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':qr_filename', $qr_filename);
        return $stmt;
    }
    public static function getUserAllActive()
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_usuarios WHERE estado= 'activo'");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    


}