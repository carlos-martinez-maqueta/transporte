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
        url: "config/travel/get-travel.php",
        method: "POST",
        data: {
            action: "get_all_travel_id",
            resultId: resultId,
        },
        dataType: "json",
        success: function(data) {

            $("#editarModal .modal-body #id").val(data.id);
            $("#editarModal .modal-body #origin_id").val(data.origen_id);
            $("#editarModal .modal-body #destino_id").val(data.destino_id);
            $("#editarModal .modal-body #movilidad_id").val(data.movilidad_id);
            $("#editarModal .modal-body #fecha_inicio").val(data.fecha_inicio);
            $("#editarModal .modal-body #fecha_fin").val(data.fecha_fin);   
            $("#editarModal .modal-body #estado").val(data.estado);   

        },
    });
});

