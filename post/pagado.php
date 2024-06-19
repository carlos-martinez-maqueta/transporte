<?php
require '../config/conexion.php'; // Asegúrate de tener tu configuración de base de datos aquí
include 'lib-qr/barcode.php';
require_once '../mailer/lib/PHPMailer/Exception.php';
require_once '../mailer/lib/PHPMailer/PHPMailer.php';
require_once '../mailer/lib/PHPMailer/SMTP.php';
require_once '../mailer/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Obtener el cuerpo de la solicitud JSON
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $viaje_id = $data['viaje_id'];
    $asientos_reservados = $data['asientos_reservados'];
    $precio = $data['precio'];
    $fecha_creacion = date('Y-m-d H:i:s');
    $estado = 'confirmada';
    $reservadoas = $data['reservadoas'];
    $acompanantes = $data['acompanantes'];

    $correo = $data['correo'];
    $apellidos = $data['apellidos'];
    $telefono = $data['telefono'];
    $nombre = $data['nombre'];
    $punto = $data['punto'];
    $tipo = $data['tipo'];

    try {
        // Insertar datos en tbl_reservas
        $sql_reserva = "INSERT INTO tbl_reservas (staff_id, viaje_id, punto_id, tipo_viaje, referencia, asientos_reservados, imagen, precio_pagado, fecha_creacion, estado) 
                        VALUES (NULL, '$viaje_id', '$punto', '$tipo', 'WEB', '$asientos_reservados', NULL, '$precio', '$fecha_creacion', '$estado')";
        $stmt_reserva = $conn->prepare($sql_reserva);
 
        if ($stmt_reserva->execute()) {
            // Obtener el ID de la última inserción en tbl_reservas
            $ultimo_id_insertado = $conn->lastInsertId();

            
            // Generar y guardar el código QR
            $qr_folder = 'qr_user/';

            $generator = new barcode_generator();
            header('Content-Type: image/svg+xml');
            $svg = $generator->render_svg("qr", "https://transportesafe.com/reserva-realizada?destino=$punto-$tipo&reserva=$ultimo_id_insertado", ""); //cambiar donde este la vista para que aparezca los detalles del usuario

            $qr_filename = "qr_code_$ultimo_id_insertado.svg";
            $qr_filepath = $qr_folder . $qr_filename;

            file_put_contents($qr_filepath, $svg);

            $sql_qr = "UPDATE tbl_reservas SET qr = '$qr_filename' WHERE id = '$ultimo_id_insertado'";
            $sql_user_stm = $conn->prepare($sql_qr);
            $sql_user_stm->execute();
        }

        // Actualizar tbl_viajes
        $sql_update_viajes = "UPDATE tbl_viajes SET count = count - '$asientos_reservados' WHERE id = '$viaje_id'";
        $stmt_update_viajes = $conn->prepare($sql_update_viajes);
        $stmt_update_viajes->execute();

        // Convertir la cadena de nombres de asientos reservados en un array
        $asientos_reservados_array = json_decode($reservadoas, true);

        // Iniciar transacción
        $conn->beginTransaction();

        // Actualizar tbl_asientos para marcar los asientos como ocupados
        foreach ($asientos_reservados_array as $asiento_data) {
            $asiento_id = $asiento_data['id'];
            $asiento_asiento = $asiento_data['asiento'];

            $sql_update_asientos = "UPDATE tbl_asientos SET estado = 'ocupado', reserva_id = '$ultimo_id_insertado'
                                    WHERE viaje_id = '$viaje_id' AND id = '$asiento_asiento'";

            $stmt_update_as = $conn->prepare($sql_update_asientos);
            $stmt_update_as->execute();
        }

        // Insertar datos de usuario principal en tbl_reservas_pasajeros
        $sql_usuario = "INSERT INTO tbl_reservas_pasajeros (nombre, apellidos, correo, celular, reserva_id) 
                        VALUES ('$nombre', '$apellidos', '$correo', '$telefono', '$ultimo_id_insertado')";
        $stmt_user = $conn->prepare($sql_usuario);
        $stmt_user->execute();

        // Insertar datos de acompañantes en tbl_reservas_pasajeros
        $acompanantes_array = json_decode($acompanantes, true);

        foreach ($acompanantes_array as $acom) {
            $nombre_acomp = $acom['nombre'];
            $apellidos_acomp = $acom['apellidos'];

            $sql_acompanante = "INSERT INTO tbl_reservas_pasajeros (nombre, apellidos, reserva_id) 
                                VALUES ('$nombre_acomp', '$apellidos_acomp', '$ultimo_id_insertado')";
            $stmt_acom = $conn->prepare($sql_acompanante);
            $stmt_acom->execute();
        }
        
        
            // Envío de correo electrónico
            $enviomail = "cmartinez.meneses1@gmail.com"; // Cambia esta dirección de correo
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'mail.valuepay.online';
            $mail->SMTPAuth = true;
            $mail->Username = 'no-reply@valuepay.online';
            $mail->Password = 'gwkdWZvQ26cPzKi';
            $mail->Port = 587;
        
            $mail->setFrom('no-reply@valuepay.online', 'Transporte Safe');
            // $mail->addAddress($correo);
            $mail->addAddress($enviomail);
            $mail->Subject = 'Gracias por tu compra - Transporte Safe';
            $mail->CharSet = 'UTF-8';
            $mail->isHTML(true);
        
            $messages =  '
            <div style="max-width: 450px;">
                <img src="https://transportesafe.com/assets/img/logo.png" alt="">
                <h2>Estimado '.$nombre.',</h2>
                <p>Gracias por reservar en Transporte Safe. <br> 
                    El detalle de su reserva está detallado en el siguiente QR, <br> queremos expresarle nuestra gratitud y confianza. </p> 
                
                
                <img src="https://transportesafe.com/post/qr_user/'.$qr_filename.'" alt="" style="width: 150px;">
            </div>
            ';
        
            $mail->Body = $messages;
        
            // Enviar el correo de confirmación
            if ($mail->send()) {
                echo 'El correo de confirmación se ha enviado correctamente.';
            } else {
                echo 'Hubo un error al enviar el correo de confirmación: ' . $mail->ErrorInfo;
            }


        // Confirmar la transacción
        $conn->commit();
        echo "Reserva realizada con éxito.";
    } catch (PDOException $e) {
        // Revertir la transacción en caso de error
        $conn->rollBack();
        echo "Error al realizar la reserva: " . $e->getMessage();
    }
} else {
    echo "No se recibieron datos.";
}
?>
