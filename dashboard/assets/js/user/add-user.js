$(document).ready(function () {
    var form = $("#addUser");

    form.submit(function (e) {
        e.preventDefault();

        var formData5 = new FormData(this);
        $.ajax({
            url: "config/user/add-user.php",
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
        url: "config/user/get-user.php",
        method: "POST",
        data: {
            action: "get_all_user_id",
            resultId: resultId,
        },
        dataType: "json",
        success: function(data) {

            $("#editarModal .modal-body #id").val(data.id);
            $("#editarModal .modal-body #nombre").val(data.nombre);
            $("#editarModal .modal-body #apellidos").val(data.apellidos);
            $("#editarModal .modal-body #correo").val(data.correo);
            $("#editarModal .modal-body #celular").val(data.celular);
            $("#editarModal .modal-body #estado").val(data.estado);
            $("#editarModal .modal-body #pass").val(data.pass);
   

        },
    });
});
$(document).on("click", ".qr", function() {
    var resultId = $(this).data("id");

    // Limpia el contenido actual del modal antes de hacer la solicitud AJAX
    $("#qrModal .modal-body .col-12").html('');
    $("#qrModal .modal-footer .download-btn").remove();

    $.ajax({
        url: "config/user/get-user.php",
        method: "POST",
        data: {
            action: "get_all_user_id",
            resultId: resultId,
        },
        dataType: "json",
        success: function(data) {
            if (data.qr) {
                var qrImageUrl = "config/qr_codes/" + data.qr;
                var qrImage = '<img src="' + qrImageUrl + '" alt="QR Code" class="img-fluid">';
                var downloadButton = '<a href="' + qrImageUrl + '" download class="btn btn-success"><i class="bx bx-download"></i> Descargar QR</a>';

                // Agrega la imagen y el botón de descarga al modal
                $("#qrModal .modal-body .col-12").html(qrImage);
                $("#qrModal .modal-footer").prepend('<div class="download-btn">' + downloadButton + '</div>');
            }
            $("#qrModal").modal("show");
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});

// Limpia el contenido del modal al cerrarlo
$('#qrModal').on('hidden.bs.modal', function () {
    $("#qrModal .modal-body .col-12").html('');
    $("#qrModal .modal-footer .download-btn").remove();
});


