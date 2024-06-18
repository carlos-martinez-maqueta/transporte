<?php

class Pay
{

    public static function addDiscounts($porcentaje, $uso, $referencia_id)
    {
        global $conn;

        // Generar un código aleatorio único
        $codigo = self::generateUniqueCode();

        // Verificar si el código ya existe en la base de datos
        $sql = "SELECT COUNT(*) as count FROM tbl_descuentos WHERE codigo = :codigo";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':codigo', $codigo);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si el código ya existe, generar otro código único
        while ($result['count'] > 0) {
            $codigo = self::generateUniqueCode();
            $stmt->bindValue(':codigo', $codigo);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        // Insertar el descuento con el código generado
        $sql = "INSERT INTO tbl_descuentos (codigo, porcentaje, uso, estado, fecha_creacion, staff_id) 
        VALUES (:codigo, :porcentaje, :uso, :estado, NOW(), :referencia_id)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':codigo', $codigo);
        $stmt->bindValue(':porcentaje', $porcentaje);
        $stmt->bindValue(':referencia_id', $referencia_id);
        $stmt->bindValue(':uso', $uso);
        $stmt->bindValue(':estado', 'activo');
        $stmt->execute();

        return $stmt;
    }
    // Función para generar un código aleatorio único
    private static function generateUniqueCode()
    {
        $codigo = ''; // Inicializar el código

        // Caracteres permitidos en el código
        $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

        // Generar un código de 8 caracteres
        for ($i = 0; $i < 8; $i++) {
            $codigo .= $caracteres[rand(0, strlen($caracteres) - 1)];
        }

        return $codigo;
    }
    public static function getDiscountAll()
    {
        // Es una variable que esta en otro archivos
        global $conn;
        $statement = $conn->prepare("
        SELECT 
            *
        FROM 
            tbl_descuentos
        ORDER BY 
            fecha_creacion DESC
            ");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    public static function getDiscountId($id)
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tbl_descuentos WHERE id=:id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public static function editDiscountId($id, $porcentaje, $uso, $estado)
    {
        global $conn;
        $sql = "UPDATE tbl_descuentos SET porcentaje=:porcentaje, uso=:uso, estado=:estado WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':porcentaje', $porcentaje);
        $stmt->bindParam(':uso', $uso);
        $stmt->bindParam(':estado', $estado);
        return $stmt;
    }
    public static function deleteId($id)
    {
        global $conn;
        $sql = "DELETE FROM tbl_descuentos WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt;
    }
}
