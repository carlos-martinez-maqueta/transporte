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
            $("#editarModal .modal-body #hora_salida").val(data.hora_salida);
            $("#editarModal .modal-body #fecha_salida").val(data.fecha_salida);
 
            $("#editarModal .modal-body #estado").val(data.estado);   

        },
    });
});

$(document).on("click", ".points", function() {
    var resultId = $(this).data("id");

    $.ajax({
        url: "config/travel/get-travel.php",
        method: "POST",
        data: {
            action: "get_all_points_id",
            resultId: resultId,
        },
        dataType: "json",
        success: function(data) {
            var pointsHtml = '<table class="table table-striped table-hover">';
            pointsHtml += '<thead>';
            pointsHtml += '<tr>';
            pointsHtml += '<th scope="col">ORIGEN</th>';
            pointsHtml += '<th scope="col">DESTINO</th>';
            pointsHtml += '<th scope="col">HORA SALIDA</th>';
            pointsHtml += '<th scope="col">TIEMPO VIAJE</th>';
            pointsHtml += '<th scope="col">PRECIO</th>';
            pointsHtml += '</tr>';
            pointsHtml += '</thead>';
            pointsHtml += '<tbody>';
            $.each(data, function(index, point) {
                pointsHtml += '<tr>';
                pointsHtml += '<td>' + point.origen + '</td>';
                pointsHtml += '<td>' + point.destino + '</td>';
                pointsHtml += '<td>' + point.hora_salida + '</td>';
                pointsHtml += '<td>' + point.hora_llegada + '</td>';
                pointsHtml += '<td>' + point.precio + '</td>';
                pointsHtml += '</tr>';
            });
            pointsHtml += '</tbody>';
            pointsHtml += '</table>';
            $('#pointsModal .modal-body .col-12').html(pointsHtml);
        },
    });
});