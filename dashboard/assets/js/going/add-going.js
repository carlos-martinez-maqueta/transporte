$(document).ready(function () {
    var form = $("#addGoing");

    form.submit(function (e) {
        e.preventDefault();

        var formData5 = new FormData(this);
        $.ajax({
            url: "config/going/add-going.php",
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
                            // Oculta el modal
                            $("#exampleModal").modal("hide");
                            // Resetea el formulario
                            form[0].reset();
                            // Vuelve a cargar la tabla
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
        url: "config/going/get-going.php",
        method: "POST",
        data: {
            action: "get_all_going_id",
            resultId: resultId,
        },
        dataType: "json",
        success: function(data) {

            $("#editarModal .modal-body #id").val(data.id);
            $("#editarModal .modal-body #origen").val(data.origen);
            $("#editarModal .modal-body #destino").val(data.destino);
            $("#editarModal .modal-body #hora_salida").val(data.hora_salida);
            $("#editarModal .modal-body #hora_llegada").val(data.hora_llegada);
            $("#editarModal .modal-body #tiempo_estimado").val(data.tiempo_viaje);
            $("#editarModal .modal-body #precio").val(data.precio);
            $("#editarModal .modal-body #reserva").val(data.reserva);
            $("#editarModal .modal-body #estado").val(data.estado);
   

        },
    });
});

