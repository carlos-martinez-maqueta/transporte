$(document).ready(function () {
    var form = $("#addTravel");

    form.submit(function (e) {
        e.preventDefault();

        var formData5 = new FormData(this);
        $.ajax({
            url: "config/travel/add-travel.php",
            method: "POST",
            data: formData5,
            processData: false,
            contentType: false,
            dataType: "json", // Especifica que esperas una respuesta JSON
            beforeSend: function () {
                // Muestra el overlay de carga antes de enviar la solicitud
                $("#loading-overlay").css("display", "flex");
            },
            success: function (response) {
                // Oculta el overlay de carga después de procesar la respuesta
                $("#loading-overlay").css("display", "none");

                // Maneja la respuesta del servidor
                if (response.status === "success") {
                    // Muestra la alerta de éxito
                    Swal.fire({
                        icon: "success",
                        title: "Creado con éxito.",
                        text: response.message,
                        confirmButtonText: "OK",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("#exampleModal").modal("hide");
                            getTable(dataTable);
                        }
                    });
                } else {
                    // Muestra la alerta de error
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: response.message,
                        confirmButtonText: "OK",
                    });
                }
            },
            error: function (xhr, status, error) {
                // Oculta el overlay de carga en caso de error
                $("#loading-overlay").css("display", "none");
                console.error(xhr.responseText);
            },
        });
    });
});
$(document).on("click", ".edit", function() {
    var resultId = $(this).data("id");

    $.ajax({
        url: "config/booking/get-booking.php",
        method: "POST",
        data: {
            action: "get_passengers_by_booking_id",
            resultId: resultId,
        },
        dataType: "json",
        success: function(data) {
            // Limpiar el contenido anterior de la tabla
            $("#pasajerosTableBody").empty();

            // Iterar sobre los datos de los pasajeros y añadir filas a la tabla
            $.each(data, function(index, passenger) {
                var nombre = passenger.nombre ? passenger.nombre : "Sin nombre";
                var apellidos = passenger.apellidos ? passenger.apellidos : "Sin apellidos";
                var correo = passenger.correo ? passenger.correo : "Sin correo";
                var celular = passenger.celular ? passenger.celular : "Sin celular";

                var newRow = '<tr>' +
                    '<td>' + nombre + '</td>' +
                    '<td>' + apellidos + '</td>' +
                    '<td>' + correo + '</td>' +
                    '<td>' + celular + '</td>' +
                    '</tr>';
                $("#pasajerosTableBody").append(newRow);
            });
        },
    });
});

$(document).on("click", ".edit", function() {
    var resultId = $(this).data("id");

    $.ajax({
        url: "config/booking/get-booking.php",
        method: "POST",
        data: {
            action: "get_seats_by_booking_id",
            resultId: resultId,
        },
        dataType: "json",
        success: function(data) {
            // Limpiar el contenido anterior de los asientos
            $("#asientosContainer").empty();

            // Iterar sobre los datos de los asientos y crear las tarjetas
            $.each(data, function(index, seat) {
                var newCard = '<div class="col">' +
                    '<div class="card">' +
                    '<div class="card-body rounded" style="background:#000; color: #fff">' +
                    '<h5 class="card-title text-center">' + seat.nombre_asiento + '</h5>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
                $("#asientosContainer").append(newCard);
            });
        },
    });
});

