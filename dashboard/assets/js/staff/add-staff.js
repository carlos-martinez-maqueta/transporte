$(document).ready(function () {
    var form = $("#addStaff");

    form.submit(function (e) {
        e.preventDefault();

        var formData5 = new FormData(this);
        $.ajax({
            url: "config/staff/add-staff.php",
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
        url: "config/staff/get-staff.php",
        method: "POST",
        data: {
            action: "get_all_staff_id",
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

