var dataTable;
$(document).ready(function () {
  dataTable = $("#table-booking").DataTable({
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
  var ano = fechaFormateada.getFullYear();
  var hora = fechaFormateada.getHours().toString().padStart(2, '0');
  var minutos = fechaFormateada.getMinutes().toString().padStart(2, '0');
  return dia + '/' + mes + '/' + ano + ' ' + hora + ':' + minutos;
}
function getTable(dataTable) {

  $.ajax({
    url: 'config/booking/get-booking.php',
    method: 'POST',
    data: {
      action: 'get_all_booking_ventas_id'
    },
    dataType: 'json',
    success: function (data) {

      // Clear DataTable before adding new rows
      dataTable.clear();

      // Iterate over the data and add rows to the table
      $.each(data, function (index, result) {


      
        var fechaCreacion = formatFecha(result.fecha_creacion);
    

        
        var estadoBtn = '';
        if (result.estado === 'confirmada') {
          estadoBtn = '<button type="button" style="cursor: auto;" class="btn btn-sm btn-success">Confirmada</button>';
        } else if (result.estado === 'pendiente') {
          estadoBtn = '<button type="button" style="cursor: auto;" class="btn btn-sm btn-warning">Pendiente</button>';
        }  else if (result.estado === 'cancelada') {
          estadoBtn = '<button type="button" style="cursor: auto;" class="btn btn-sm btn-danger">Cancelada</button>';
        } 
        

var newRow = '<tr>' +
  '<td class="align-middle text-center">' + result.id + '</td>' +
  '<td class="align-middle text-center">' + result.correlativoViaje + '</td>' +
  '<td class="align-middle text-center">' + result.tipo_viaje + '</td>' +
  '<td class="align-middle text-center">' + result.puntoOrigen + '</td>' +
  '<td class="align-middle text-center">' + result.puntoDestino + '</td>' +
  '<td class="align-middle text-center">' + result.referencia + '</td>' +
  '<td class="align-middle text-center">' + result.asientos_reservados + '</td>' +
  '<td class="align-middle text-center">' + result.precio_pagado + '</td>' +
  '<td class="align-middle text-center">' + fechaCreacion + '</td>' +
  '<td class="align-middle text-center">' + estadoBtn + '</td>' +
  '<td class="align-middle">' +
  '<div class="d-flex justify-content-center align-items-center gap-1">';

if (result.estado === 'confirmada') {
  newRow += '<button type="button" class="btn btn-sm btn-warning editar ss" data-bs-toggle="modal" data-bs-target="#editarDetailsModal" data-id="' + result.id + '"><i class="bx bx-edit-alt"></i></button>' +
            '<button type="button" class="btn btn-sm btn-secondary edit" data-bs-toggle="modal" data-bs-target="#editarModal" data-id="' + result.id + '"><i class="bx bx-food-menu"></i></button>' +
            '<button type="button" class="btn btn-sm btn-info image" data-bs-toggle="modal" data-bs-target="#voucherModal" data-id="' + result.id + '"><i class="bx bx-image-alt"></i></button>' +
            '<button type="button" class="btn btn-sm btn-dark qr" data-bs-toggle="modal" data-bs-target="#qrModal" data-id="' + result.id + '"><i class="bx bx-qr"></i></button>'+
            '<button type="button" class="btn btn-sm btn-primary discount" data-bs-toggle="modal" data-bs-target="#discountModal" data-id="' + result.id + '"><i class="bx bx-dollar"></i></button>';
    
} else if (result.estado === 'pendiente'){
  newRow += '<button type="button" class="btn btn-sm btn-warning editar-bla aa" data-bs-toggle="modal" data-bs-target="#editarDetailsModalBla" data-id="' + result.id + '"><i class="bx bx-edit-alt"></i></button>';

} else{
  newRow += '<button type="button" class="btn btn-sm btn-danger">Descartado</button>';
}

newRow += '</div>' +
  '</td>' +
  '</tr>';

        dataTable.row.add($(newRow)).draw(false);
      });
    }
  });
}
