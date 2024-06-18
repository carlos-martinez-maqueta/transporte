var dataTable;
$(document).ready(function () {
  dataTable = $("#table-going").DataTable({
    ordering: false,
    language: {
      sProcessing: "Procesando...",
      sLengthMenu: "Mostrar _MENU_ registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo: " _START_ al _END_ de un total de _TOTAL_ registros",
      sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Buscar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Cargando...",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      oAria: {
        sSortAscending: ": Activar para ordenar la columna de manera ascendente",
        sSortDescending: ": Activar para ordenar la columna de manera descendente",
      },
      buttons: {
        copy: "Copiar",
        colvis: "Visibilidad",
      },
    }
  });

  getTable(dataTable);

});

function getTable(dataTable) {

  $.ajax({
    url: 'config/going/get-going.php',
    method: 'POST',
    data: {
      action: 'get_all_going'
    },
    dataType: 'json',
    success: function (data) {

      // Clear DataTable before adding new rows
      dataTable.clear();

      // Iterate over the data and add rows to the table
      $.each(data, function (index, result) {


        var fechaFormateada = new Date(result.fecha);
        var dia = fechaFormateada.getDate().toString().padStart(2, '0');
        var mes = (fechaFormateada.getMonth() + 1).toString().padStart(2, '0');
        var año = fechaFormateada.getFullYear();
        var hora = fechaFormateada.getHours().toString().padStart(2, '0');
        var minutos = fechaFormateada.getMinutes().toString().padStart(2, '0');
        var fechaCreacion = dia + '/' + mes + '/' + año + ' ' + hora + ':' + minutos;

  

     
        var estadoBtn = '';
        if (result.estado === 'activo') {
          estadoBtn = '<button type="button" style="cursor: auto;" class="btn btn-sm btn-success">Activo</button>';
        } else if (result.estado === 'inactivo') {
          estadoBtn = '<button type="button" style="cursor: auto;" class="btn btn-sm btn-danger">Inactivo</button>';
        }


        var newRow = '<tr>' +
          '<td class="align-middle text-center">' + result.orden + '</td>' +
          '<td class="align-middle text-center">' + result.origen + '</td>' +
          '<td class="align-middle text-center">' + result.destino + '</td>' +
          '<td class="align-middle text-center">' + result.hora_salida + '</td>' +
          '<td class="align-middle text-center">' + result.hora_llegada + '</td>' +
          '<td class="align-middle text-center">' + result.tiempo_viaje + '</td>' +
          '<td class="align-middle text-center">' + result.precio + '</td>' +
          '<td class="align-middle text-center">' + result.reserva + '</td>' +
          '<td class="align-middle text-center">' + fechaCreacion + '</td>' +
          '<td class="align-middle text-center">' + estadoBtn + '</td>' +
          '<td class="align-middle">' +
          '<div class="d-flex justify-content-center align-items-center gap-1">' +
          '<button type="button" class="btn btn-sm btn-warning edit" data-bs-toggle="modal" data-bs-target="#editarModal" data-id="' + result.id + '"><i class="bx bxs-edit" ></i></button>' +
          '</div>' +
          '</td>' +
          '</tr>';
        dataTable.row.add($(newRow)).draw(false);
      });
    }
  });
}
