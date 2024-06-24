    <?php
    include '../conexion.php';
    include '../../class/booking.php';
    include '../../class/travel.php';
    include '../../core/Security.php';
    include '../../lib-qr/barcode.php';

    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // $staffId = Security::getUserId();
        $staffId = !empty($_POST['u']) ? $_POST['u'] : null;
        $viaje_id = !empty($_POST['viaje_id']) ? $_POST['viaje_id'] : null;
        $referencia = !empty($_POST['referencia']) ? $_POST['referencia'] : null;
        $num_asientos = !empty($_POST['num_asientos']) ? $_POST['num_asientos'] : null;

        $selectedSeats = !empty($_POST['selectedSeats']) ? $_POST['selectedSeats'] : null;

        $nombre = !empty($_POST['nombre']) ? $_POST['nombre'] : null;
        $apellidos = !empty($_POST['apellidos']) ? $_POST['apellidos'] : null;
        $correo = !empty($_POST['correo']) ? $_POST['correo'] : null;
        $celular = !empty($_POST['celular']) ? $_POST['celular'] : null;



        // NUEVO
        $point_id = !empty($_POST['point_id']) ? $_POST['point_id'] : null;


        $travelObj = Travel::getMarvelId($viaje_id);
        $tipoBooking = $travelObj->tipo;


        // Aquí se debe realizar la consulta con la tabla correcta usando $point_id
        $pointObj = Travel::getPointsFechId($viaje_id, $point_id);
        $precioPoint = $pointObj->precio;


        // $precioBooking = $travelObj->precio;

        // Agregar la reserva
        $result = Booking::addBookingSales($staffId, $viaje_id, $referencia, $num_asientos, $precioPoint, $point_id, $tipoBooking);

        if ($result->execute()) {
            $lastInsertedId = $conn->lastInsertId();




            // Generar y guardar el código QR
            $qr_folder = __DIR__ . '../../qr_codes/';

            $generator = new barcode_generator();
            header('Content-Type: image/svg+xml');
            $svg = $generator->render_svg("qr", "https://transportesafe.com/reserva-realizada?reserva=$lastInsertedId&destino=$point_id-$tipoBooking", ""); //cambiar donde este la vista para que aparezca los detalles del usuario

            $qr_filename = "qr_code_booking_$lastInsertedId.svg";
            $qr_filepath = $qr_folder . $qr_filename;

            file_put_contents($qr_filepath, $svg);

            $result2 = Booking::updateBookingQrId($lastInsertedId, $qr_filename);
            $result2->execute();


            // Actualizar los asientos seleccionados
            if (!empty($selectedSeats)) {
                $selectedSeatsArray = explode(",", $selectedSeats);
                foreach ($selectedSeatsArray as $seat) {
                    $sqlUpdate = "UPDATE tbl_asientos SET estado = 'ocupado', reserva_id = :reserva_id WHERE viaje_id = :viaje_id AND asiento = :asiento AND estado = 'disponible'";
                    $stmtUpdate = $conn->prepare($sqlUpdate);
                    $stmtUpdate->bindParam(':reserva_id', $lastInsertedId);
                    $stmtUpdate->bindParam(':viaje_id', $viaje_id);
                    $stmtUpdate->bindParam(':asiento', $seat);
                    $stmtUpdate->execute();
                }
            }

            // Verificar si se envió una nueva imagen
            if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] === UPLOAD_ERR_OK) {
                // Generar un nombre único para el archivo
                $nombreArchivoUnico = uniqid('image_', true) . '.' . pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION);
                $rutaDestino = "../../files/voucher/" . $nombreArchivoUnico;

                // Guardar la imagen en la ruta especificada
                if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaDestino)) {
                    // Editar la imagen solo si se guardó correctamente
                    $imagen = $nombreArchivoUnico;
                    $result1 = Booking::editBookingImageId($lastInsertedId, $imagen);
                    $result1->execute();
                }
            }

            // Insertar los datos de los pasajeros
            if (!empty($nombre)) {
                for ($i = 0; $i < count($nombre); $i++) {
                    $sqlInsertPasajero = "INSERT INTO tbl_reservas_pasajeros (reserva_id, nombre, apellidos, correo, celular) VALUES (:reserva_id, :nombre, :apellidos, :correo, :celular)";
                    $stmtInsertPasajero = $conn->prepare($sqlInsertPasajero);
                    $stmtInsertPasajero->bindParam(':reserva_id', $lastInsertedId);
                    $stmtInsertPasajero->bindParam(':nombre', $nombre[$i]);
                    $stmtInsertPasajero->bindParam(':apellidos', $apellidos[$i]);
                    $stmtInsertPasajero->bindParam(':correo', $correo[$i]);
                    $stmtInsertPasajero->bindParam(':celular', $celular[$i]);
                    $stmtInsertPasajero->execute();
                }
            }

            // Actualizar el campo count en la tabla tbl_viaje
            $sqlGetCount = "SELECT count FROM tbl_viajes WHERE id = :viaje_id";
            $stmtGetCount = $conn->prepare($sqlGetCount);
            $stmtGetCount->bindParam(':viaje_id', $viaje_id);
            $stmtGetCount->execute();
            $countActual = $stmtGetCount->fetchColumn();

            $nuevoCount = $countActual - $num_asientos;

            $sqlUpdateCount = "UPDATE tbl_viajes SET count = :nuevo_count WHERE id = :viaje_id";
            $stmtUpdateCount = $conn->prepare($sqlUpdateCount);
            $stmtUpdateCount->bindParam(':nuevo_count', $nuevoCount);
            $stmtUpdateCount->bindParam(':viaje_id', $viaje_id);
            $stmtUpdateCount->execute();

            // Reserva registrada correctamente
            $response = array(
                'status' => 'success',
                'message' => 'La reserva se agregó correctamente.'
            );
        } else {
            // Error al registrar la reserva
            $response = array(
                'status' => 'error',
                'message' => 'Error al agregar reserva.'
            );
        }
        // Devolver la respuesta como JSON
        echo json_encode($response);
    }
