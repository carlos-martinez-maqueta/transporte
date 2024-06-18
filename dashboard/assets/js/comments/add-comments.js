$(document).ready(function () {
    var form = $("#addComments");

    form.submit(function (e) {
        e.preventDefault();

        var formData5 = new FormData(this);
        $.ajax({
            url: "config/comments/add-comments.php",
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

    // Limpiar campos del modal antes de llenarlos con nuevos datos
    $("#editarModal .modal-body #id").val('');
    $("#editarModal .modal-body #titulo").val('');
    $("#editarModal .modal-body #parrafo").val('');
    $("#editarModal .modal-body #imagen2").val('');
    $("#editarModal .modal-body #imagenPrevia2").attr('src', '').hide();
    $("#editarModal .modal-body #sinImagen2").hide();

    $.ajax({
        url: "config/comments/get-comments.php",
        method: "POST",
        data: {
            action: "get_all_comments_id",
            resultId: resultId,
        },
        dataType: "json",
        success: function(data) {
            $("#editarModal .modal-body #id").val(data.id);
            $("#editarModal .modal-body #titulo").val(data.titulo);
            $("#editarModal .modal-body #parrafo").val(data.parrafo);
            $("#editarModal .modal-body #nombres").val(data.nombre);
            $("#editarModal .modal-body #cargo").val(data.cargo);

            // Manejar la imagen previa si existe
            if (data.imagen) {
                $("#editarModal .modal-body #imagenPrevia2").attr('src', 'files/home/' + data.imagen).show();
                $("#editarModal .modal-body #sinImagen2").hide();
            } else {
                $("#editarModal .modal-body #imagenPrevia2").hide();
                $("#editarModal .modal-body #sinImagen2").show();
            }
        },
    });
});

