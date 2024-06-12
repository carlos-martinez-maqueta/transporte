$(document).ready(function () {
  var dataTable;
  var selectedPrice = 0;
  var selectedSeats = [];
  var maxSeats = 1; // Inicialmente, el máximo de asientos seleccionados es 1
  // Inicializar DataTable
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

  // Cargar datos al DataTable
  getTable(dataTable);

  // Al seleccionar un viaje, llamar a la función para obtener la plantilla
  $('#table-travel').on('click', 'input.select-travel', function () {
    var id = $(this).val();
    var row = $(this).closest('tr');
    selectedPrice = parseFloat(row.find('td:eq(8)').text());
    updateTotalPrice();
    getPlantilla(id);

  });

  // Actualizar el precio total cuando cambia el número de pasajeros
  $('#numPasajeros').on('input', function () {
    maxSeats = parseInt($(this).val()); // Actualizar el máximo de asientos seleccionados

    updateTotalPrice();
    updatePasajeros();
  });

  function updateTotalPrice() {
    var numPasajeros = parseInt($('#numPasajeros').val());
    var totalPrice = numPasajeros * selectedPrice;
    $('#precioTotal').val(totalPrice.toFixed(2));

  }


  function updatePasajeros() {
    var numPasajeros = parseInt($('#numPasajeros').val());
    var pasajerosDiv = $('#pasajeros');
    pasajerosDiv.empty(); // Limpiar el contenido actual

    for (var i = 0; i < numPasajeros; i++) {
      if (i === 0) {
        var pasajeroHTML = `
            <div class="d-flex col-12 border p-4 mb-3">
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nombrePasajero${i}" placeholder="Nombres">
                        <label for="nombrePasajero${i}">Nombres</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="apellidoPasajero${i}" placeholder="Apellidos">
                        <label for="apellidoPasajero${i}">Apellidos</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="correoPasajero${i}" placeholder="Correo Electronico">
                        <label for="correoPasajero${i}">Correo Electronico</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="telefonoPasajero${i}" placeholder="Telefono">
                        <label for="telefonoPasajero${i}">Telefono</label>
                    </div>
                </div>
            </div>`;
      } else {
        var pasajeroHTML = `
            <div class="d-flex col-12 border p-4 mb-3">
                <div class="col-12 d-flex">
                    <div class="form-floating col-xl-6 col-md-12">
                        <input type="text" class="form-control" id="nombrePasajero${i}" placeholder="Nombres">
                        <label for="nombrePasajero${i}">Nombres</label>
                    </div>
                    <div class="form-floating col-xl-6 col-md-12">
                        <input type="text" class="form-control" id="apellidoPasajero${i}" placeholder="Apellidos">
                        <label for="apellidoPasajero${i}">Apellidos</label>
                    </div>
                </div>
            </div>`;
      }
      pasajerosDiv.append(pasajeroHTML);
    }
  }

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
            '<td class="align-middle text-center">' + result.correlativo + '</td>' +
            '<td class="align-middle text-center">' + result.nombreOrigen + '</td>' +
            '<td class="align-middle text-center">' + result.nombreDestino + '</td>' +
            '<td class="align-middle text-center">' + result.matriculaMovilidad + '</td>' +
            '<td class="align-middle text-center">' + result.capacidadMovilidad + '</td>' +
            '<td class="align-middle text-center">' + result.count + '</td>' +
            '<td class="align-middle text-center">' + fechaIni + '</td>' +
            '<td class="align-middle text-center">' + fechaFin + '</td>' +
            '<td class="align-middle text-center">' + result.precio + '</td>' +
            '<td class="align-middle text-center">' + estadoBtn + '</td>' +
            '<td class="align-middle text-center"><input class="form-check-input select-travel" type="radio" name="select-travel" value="' + result.id + '"></td>' +
            '</tr>';
          dataTable.row.add($(newRow)).draw(false);
        });
      }
    });
  }

  function getPlantilla(id) {
    $.ajax({
      url: 'config/travel/get-plantilla.php',
      method: 'POST',
      data: { id: id },
      dataType: 'json',
      success: function (data) {
        // Identificar el valor devuelto y construir la plantilla correspondiente
        var plantillaHTML = '';
        switch (data.plantilla_id) {
          case '1':
            plantillaHTML = `<div class="plantilla" id="plantilla1"> <div class="d-flex col-12 justify-content-center py-4">
                        <div class="col-10 d-flex justify-content-center p-3 gap-4 border">
                            <div>
                                <div data-state="disponible" data-value="A9"  class="asiento" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 12px;">
                                        <span style="font-size: 9px;">A9</span>
                                    </div>
                                </div>
                                <div data-state="disponible" data-value="A10" class="asiento" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 9px;">
                                        <span style="font-size: 9px;">A10</span>
                                    </div>
                                </div>
                                <div data-state="disponible" data-value="A11" class="asiento" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 9px;">
                                        <span style="font-size: 9px;">A11</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div data-state="disponible" data-value="A7" class="asiento" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 12px;">
                                        <span style="font-size: 9px;">A7</span>
                                    </div>
                                </div>
                                <div data-state="disponible" data-value="A8" class="asiento" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 12px;">
                                        <span style="font-size: 9px;">A8</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div data-state="disponible" data-value="A5" class="asiento" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 12px;">
                                        <span style="font-size: 9px;">A5</span>
                                    </div>
                                </div>
                                <div data-state="disponible" data-value="A6" class="asiento" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 12px;">
                                        <span style="font-size: 9px;">A6</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div data-state="disponible" data-value="A2" class="asiento" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 12px;">
                                        <span style="font-size: 9px;">A2</span>
                                    </div>
                                </div>
                                <div data-state="disponible" data-value="A3" class="asiento" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 12px;">
                                        <span style="font-size: 9px;">A3</span>
                                    </div>
                                </div>
                                <div data-state="disponible" data-value="A4" class="asiento" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 12px;">
                                        <span style="font-size: 9px;">A4</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 12px;">
                                        <span style="font-size: 9px;"></span>
                                    </div>
                                </div>
                                <div data-state="disponible" data-value="A1" class="asiento" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 12px;">
                                        <span style="font-size: 9px;">A1</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div></div>`;
            break;
          case '2':
            plantillaHTML = `<div class="plantilla" id="plantilla2"> <div class="d-flex col-12 justify-content-center py-4">
                        <div class="col-10 d-flex justify-content-center p-3 gap-4 border">
                            <div>
                                <div data-state="disponible" data-value="A10" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 12px;">
                                        <span style="font-size: 9px;">A10</span>
                                    </div>
                                </div>
                                <div data-state="disponible" data-value="A11" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 12px;">
                                        <span style="font-size: 9px;">A11</span>
                                    </div>
                                </div>
                                <div data-state="disponible" data-value="A12" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 12px;">
                                        <span style="font-size: 9px;">A12</span>
                                    </div>
                                </div>
                                <div data-state="disponible" data-value="A13" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 12px;">
                                        <span style="font-size: 9px;">A13</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div data-state="disponible" data-value="A7" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 12px;">
                                        <span style="font-size: 9px;">A7</span>
                                    </div>
                                </div>
                                <div data-state="disponible" data-value="A8" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 12px;">
                                        <span style="font-size: 9px;">A8</span>
                                    </div>
                                </div>
                                <div data-state="disponible" data-value="A9" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 12px;">
                                        <span style="font-size: 9px;">A9</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div data-state="disponible" data-value="A4" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 12px;">
                                        <span style="font-size: 9px;">A4</span>
                                    </div>
                                </div>
                                <div data-state="disponible" data-value="A5" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 12px;">
                                        <span style="font-size: 9px;">A5</span>
                                    </div>
                                </div>
                                <div data-state="disponible" data-value="A6" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 12px;">
                                        <span style="font-size: 9px;">A6</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div data-state="disponible" data-value="A2" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 12px;">
                                        <span style="font-size: 9px;">A2</span>
                                    </div>
                                </div>
                                <div data-state="disponible" data-value="A3" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 12px;">
                                        <span style="font-size: 9px;">A3</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 12px;">
                                        <span style="font-size: 9px;"></span>
                                    </div>
                                </div>
                                <div data-state="disponible" data-value="A1" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 12px;">
                                        <span style="font-size: 9px;">A1</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div></div>`;
            break;
          case '3':
            plantillaHTML = `<div class="plantilla" id="plantilla3">  <div class="d-flex col-12 justify-content-center py-4">
                        <div class="col-10 d-flex justify-content-center p-3 gap-4 border">
                            <div>
                                <div data-state="disponible" data-value="A13" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 9px;">
                                        <span style="font-size: 9px;">A13</span>
                                    </div>
                                </div>
                                <div data-state="disponible" data-value="A14" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 9px;">
                                        <span style="font-size: 9px;">A14</span>
                                    </div>
                                </div>
                                <div data-state="disponible" data-value="A15" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 9px;">
                                        <span style="font-size: 9px;">A15</span>
                                    </div>
                                </div>
                                <div data-state="disponible" data-value="A16" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 9px;">
                                        <span style="font-size: 9px;">A16</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div data-state="disponible" data-value="A10" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 9px;">
                                        <span style="font-size: 9px;">A10</span>
                                    </div>
                                </div>
                                <div data-state="disponible" data-value="A11" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 9px;">
                                        <span style="font-size: 9px;">A11</span>
                                    </div>
                                </div>
                                <div data-state="disponible" data-value="A12" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 9px;">
                                        <span style="font-size: 9px;">A12</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div data-state="disponible" data-value="A7" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 12px;">
                                        <span style="font-size: 9px;">A7</span>
                                    </div>
                                </div>
                                <div data-state="vacio" data-value="A8" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 12px;">
                                        <span style="font-size: 9px;">A8</span>
                                    </div>
                                </div>
                                <div data-state="disponible" data-value="A9" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 12px;">
                                        <span style="font-size: 9px;">A9</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div data-state="disponible" data-value="A4" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 12px;">
                                        <span style="font-size: 9px;">A4</span>
                                    </div>
                                </div>
                                <div data-state="disponible" data-value="A5" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 12px;">
                                        <span style="font-size: 9px;">A5</span>
                                    </div>
                                </div>
                                <div data-state="disponible" data-value="A6" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 12px;">
                                        <span style="font-size: 9px;">A6</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div data-state="disponible" data-value="A2" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 12px;">
                                        <span style="font-size: 9px;">A2</span>
                                    </div>
                                </div>
                                <div data-state="disponible" data-value="A3" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 12px;">
                                        <span style="font-size: 9px;">A3</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 12px;">
                                        <span style="font-size: 9px;"></span>
                                    </div>
                                </div>
                                <div data-state="disponible" data-value="A1" style="position: relative;">
                                    <img src="assets/img/svg/asiento_vacio.svg" alt="" srcset="">
                                    <div style="position: absolute; top: 8px;left: 12px;">
                                        <span style="font-size: 9px;">A1</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div></div>`;
            break;
          default:
            plantillaHTML = '<div class="plantilla" id="plantilla_default">No se encontro plantilla.</div>';
        }
        // Mostrar la plantilla
        $('#plantillas').html(plantillaHTML);
        // Realizar solicitud AJAX al servidor para obtener los estados de los asientos
        $.ajax({
          url: 'config/travel/getStateTemplate.php',
          method: 'POST',
          data: { id: id },
          dataType: 'json',
          success: function (response) {
            if (Array.isArray(response)) {
              response.forEach(function (asiento) {
                var $asiento = $('[data-value="' + asiento.asiento + '"]');
                $asiento.attr('data-state', asiento.estado);

                // Actualizar la imagen del asiento según su estado
                switch (asiento.estado) {
                  case 'disponible':
                    $asiento.find('img').attr('src', 'assets/img/svg/asiento_vacio.svg');
                    break;
                  case 'seleccionado':
                    $asiento.find('img').attr('src', 'assets/img/svg/asiento_seleccionado.svg');
                    break;
                  case 'ocupado':
                    $asiento.find('img').attr('src', 'assets/img/svg/asiento_lleno.svg');
                    break;
                  default:
                    break;
                }
              });
            } else {
              console.error('La respuesta no es un array válido:', response);
            }
          },
          error: function (xhr, status, error) {
            console.error('Error al obtener los estados de los asientos: ' + error);
          }
        });
      }
    });
    // Evento de clic para los asientos
    $(document).on('click', '.asiento', function () {
      var $asiento = $(this);
      var estado = $asiento.attr('data-state');

      // Verificar si el asiento está disponible y si no se ha alcanzado el límite de asientos seleccionados
      if (estado === 'disponible' && selectedSeats.length < maxSeats) {
        // Cambiar el estado a seleccionado y la imagen a asiento_seleccionado.svg
        $asiento.attr('data-state', 'seleccionado');
        $asiento.find('img').attr('src', 'assets/img/svg/asiento_seleccionado.svg');
        selectedSeats.push($asiento.attr('data-value')); // Agregar el asiento al arreglo de asientos seleccionados
      } else if (estado === 'seleccionado') {
        // Cambiar el estado a disponible y la imagen a asiento_vacio.svg
        $asiento.attr('data-state', 'disponible');
        $asiento.find('img').attr('src', 'assets/img/svg/asiento_vacio.svg');
        selectedSeats = selectedSeats.filter(value => value !== $asiento.attr('data-value')); // Quitar el asiento del arreglo de asientos seleccionados
      } else if (estado === 'ocupado') {
        // No hacer nada si el asiento está ocupado
        return;
      }
      // Actualizar el precio total y el número de pasajeros
      updateTotalPrice();
      updatePasajeros();
    });
  }
  // Evento clic para seleccionar/deseleccionar asientos
  $('.asiento').on('click', function () {
    const seatValue = $(this).attr('data-value');
    if (!selectedSeats.includes(seatValue)) {
      selectedSeats.push(seatValue);
      $(this).addClass('selected'); // Clase para resaltar visualmente el asiento seleccionado
    } else {
      selectedSeats = selectedSeats.filter(value => value !== seatValue);
      $(this).removeClass('selected'); // Deseleccionar asiento
    }
    console.log(selectedSeats); // Ver los asientos seleccionados en la consola
  });
  // Inicializar la función para agregar los campos de pasajeros
  updatePasajeros();
});
