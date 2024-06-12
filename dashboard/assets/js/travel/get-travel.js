var dataTable;
$(document).ready(function () {
  dataTable = $("#table-travel").DataTable({
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
function formatFecha(fecha) {
  var fechaFormateada = new Date(fecha);
  var dia = fechaFormateada.getDate().toString().padStart(2, '0');
  var mes = (fechaFormateada.getMonth() + 1).toString().padStart(2, '0');
  var año = fechaFormateada.getFullYear();
  var hora = fechaFormateada.getHours().toString().padStart(2, '0');
  var minutos = fechaFormateada.getMinutes().toString().padStart(2, '0');
  return dia + '/' + mes + '/' + año + ' ' + hora + ':' + minutos;
}
function getTable(dataTable) {

  $.ajax({
    url: 'config/travel/get-travel.php',
    method: 'POST',
    data: {
      action: 'get_all_travel'
    },
    dataType: 'json',
    success: function (data) {

      // Clear DataTable before adding new rows
      dataTable.clear();

      // Iterate over the data and add rows to the table
      $.each(data, function (index, result) {


        var fechaIni = formatFecha(result.fecha_inicio);
        var fechaFin = formatFecha(result.fecha_fin);
        var fechaCreacion = formatFecha(result.fecha_creacion);
    

        // var rol_id_text;
        // if (result.rol_id == 1) {
        //   rol_id_text = 'ADMINISTRADOR';
        // } else if (result.rol_id == 2) {
        //   rol_id_text = 'EJECUTIVO DE VENTAS';
        // } else if (result.rol_id == null) {
        //   rol_id_text = 'NO TIENE';
        // } else {
        //   rol_id_text = result.rol_id;
        // }

        
        var estadoBtn = '';
        if (result.estado === 'disponible') {
          estadoBtn = '<button type="button" style="cursor: auto;" class="btn btn-sm disponible">Disponible</button>';
        } else if (result.estado === 'completo') {
          estadoBtn = '<button type="button" style="cursor: auto;" class="btn btn-sm completo">Completo</button>';
        } else if (result.estado === 'confirmado') {
          estadoBtn = '<button type="button" style="cursor: auto;" class="btn btn-sm confirmado">Confirmado</button>';
        } else if (result.estado === 'progreso') {
          estadoBtn = '<button type="button" style="cursor: auto;" class="btn btn-sm progreso">En progreso</button>';
        } else if (result.estado === 'finalizado') {
          estadoBtn = '<button type="button" style="cursor: auto;" class="btn btn-sm finalizado">Finalizado</button>';
        }
        


        var newRow = '<tr>' +
          '<td class="align-middle text-center">' + result.id + '</td>' +
          '<td class="align-middle text-center">' + result.correlativo + '</td>' +
          '<td class="align-middle text-center">' + result.nombreOrigen + '</td>' +
          '<td class="align-middle text-center">' + result.nombreDestino + '</td>' +
          '<td class="align-middle text-center">' + result.matriculaMovilidad + '</td>' +
          '<td class="align-middle text-center">' + result.capacidadMovilidad + '</td>' +
          '<td class="align-middle text-center">' + result.count + '</td>' +
          '<td class="align-middle text-center">' + fechaIni + '</td>' +
          '<td class="align-middle text-center">' + fechaFin + '</td>' +
          '<td class="align-middle text-center">' + fechaCreacion + '</td>' +
          '<td class="align-middle text-center">' + result.precio + '</td>' +
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
