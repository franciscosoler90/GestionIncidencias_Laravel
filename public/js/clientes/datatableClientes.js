$(document).ready(function() {

    // Setup - add a text input to each footer cell
    $('#tablaClientes thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#tablaClientes thead');

    let tablaClientes = $('#tablaClientes').DataTable({

        initComplete: function () {
            var api = this.api();
    
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="Filtrar por ' + title + '" />');
    
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')

                        .on('change', function (e) {
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
    
                            
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
                        })
                        
                        .on('keyup', function (e) {
                            e.stopPropagation();

                            var cursorPosition = this.selectionStart;
    
                            $(this).trigger('change');
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },

        language: {
            search: "",
            searchPlaceholder: 'Búsqueda general',
            url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
        },

        orderCellsTop: true,
        fixedHeader: true,
        pageLength: 50,
        lengthChange: false,
        paging: true,
        processing: true,
        select: false,
        ordering: true,
        individualSearch: true, // Habilitar búsqueda individual por columnas
        responsive: true,
        serverSide: false,
        pagingType: 'full_numbers',
        colReorder: true,

        order: [
            [1, "asc"]
        ],

        columns: [
            {
                data: 'id',
                name: 'Código',
                searchable: true, // Hacer que esta columna sea buscable
                orderable: true,
            },
            {
                data: 'nombre',
                name: 'Nombre',
                searchable: true, // Hacer que esta columna sea buscable
                orderable: true,
            },
            {
                data: 'provincia',
                name: 'Provincia',
                searchable: true, // Hacer que esta columna sea buscable
                orderable: true,
            },
            {
                data: 'telefono',
                name: 'Teléfono',
                searchable: true, // Hacer que esta columna sea buscable
                orderable: true,
            },
            {
                data: 'observaciones',
                name: 'Observaciones',
                searchable: true, // Hacer que esta columna no sea buscable
                orderable: true,
            },
        ],

        dom: 'Bfrtip',
        buttons: [
            {
                text: 'Añadir cliente',
                action: function(e, dt, node, config) {
                  // Aquí puedes escribir el código para abrir tu ventana modal
                  $('#agregarCliente').modal('show');
                }
            },
            {
                extend: 'excelHtml5',
                text: 'Exportar a Excel',
                header: true,
                footer: false,
                messageTop: null,
                sheetName: 'Hoja1',
                filename: 'Clientes_' + getCurrentDate(), // Aquí agregamos la fecha actual al nombre del archivo
                title: 'Informe de clientes creado por ' + currentUserName + ' en ' + getCurrentDate2(), // Utiliza la variable currentUserName
                autoFilter: true,
                exportOptions: {
                    modifier: {
                        page: 'all',
                    }
                },
    
                customize: function(xlsx) {
    
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                
                    // Aumentar la altura de la primera fila (por ejemplo, a 30 puntos)
                    $('row:first', sheet).attr('ht', '40');
                    $('row:first', sheet).attr('customHeight', '1');
        
                    // También puedes establecer el estilo de la primera fila aquí si es necesario
                    $('row:first c', sheet).attr('s', '2');
    
                    // Establecer el estilo '47' en la segunda fila
                    $('row:eq(1) c', sheet).attr('s', '47');

                }
            },
    
        ],

    });

    // Manejar el evento click en las filas de la tabla
    $('#tablaClientes tbody').on('click', 'tr', function() {

        // Obtener los datos de la fila seleccionada
        var data = tablaClientes.row(this).data();

        // Hacer una petición AJAX para obtener las marcas del cliente seleccionado
        $.ajax({
            url: '/clientes/' + data.id,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                updateCliente(response.cliente);
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });

        // Hacer una petición AJAX para obtener las marcas del cliente seleccionado
        $.ajax({
            url: '/clientes/' + data.id + '/marcas',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
        
                // Seleccionar los checkboxes correspondientes a las marcas del cliente
                response.forEach(function(marca) {
                    $('.marca[value="' + marca.id + '"]').prop('checked', true);
                });
        
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });

        tablaEmpleados.clear();

        $.ajax({
            url: '/empleados/cliente/' + data.id,
            method: 'GET',
            dataType: 'json',
            success: function(empleados) {
                var empleadosData = empleados.map(function(empleado) {
                    return [
                        empleado.id,
                        empleado.nombre,
                        empleado.cargo ? empleado.cargo : '-',
                        empleado.telefonoFijo ? empleado.telefonoFijo : '-',
                        empleado.telefonoMovil ? empleado.telefonoMovil : '-',
                        empleado.correoEmpresa ? empleado.correoEmpresa : '-',
                        empleado.correoPersonal ? empleado.correoPersonal : '-'
                    ];
                });
                tablaEmpleados.rows.add(empleadosData).draw();
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });

        // Mostrar la ventana modal
        $('#clienteModal').modal('show');

    });

});

function updateCliente(data) {

    $('#clienteModalLabel').text("Cliente: " + data.nombre + " - Código: " + data.codigo);

    // Rellenar la ventana modal con los datos del cliente
    $('#idClienteEmpleado').val(data.id);

    $('#codigoModal').val(data.codigo);
    $('#nombreModal').val(data.nombre);
    $('#provinciaModal').val(data.provincia);
    $('#poblacionModal').val(data.municipio);
    $('#domicilioModal').val(data.domicilio);
    $('#observacionesModal').text(data.observaciones);
    $('#telefonoModal').val(data.telefono);
    $('#emailModal').val(data.email);
    $('#movilModal').val(data.movil);
    $('#faxModal').val(data.fax);
    $('#nifModal').val(data.nif);
    $('#escaleraModal').val(data.escalera);
    $('#numeroModal').val(data.numero);
    $('#pisoModal').val(data.piso);
    $('#puertaModal').val(data.puerta);
    $('#codigoPostalModal').val(data.codigoPostal);

    // Limpiar los campos de entrada
    $('#nombre2').val("");
    $('#cargo').val("");
    $('#telefonoMovil').val("");
    $('#telefonoFijo').val("");
    $('#correoEmpresa').val("");
    $('#correoPersonal').val("");

    // Seleccionar la opción correspondiente del select de País
    if (data.pais === null) {
        $('#paisModal option[data-value=""]').prop('selected', true);
    } else {
        $('#paisModal option[data-value="' + data.pais + '"]').prop('selected', true);
    }

    // Seleccionar la opción correspondiente del select de CCAA
    if (data.ccaa === null) {
        $('#ccaaModal option[data-value=""]').prop('selected', true);
    } else {
        $('#ccaaModal option[data-value="' + data.ccaa + '"]').prop('selected', true);
    }

    // Seleccionar la opción correspondiente del select de Provincia
    if (data.provincia === null) {
        $('#provinciaModal option[data-value=""]').prop('selected', true);
    } else {
        $('#provinciaModal option[data-value="' + data.provincia + '"]').prop('selected', true);
    }

    // Seleccionar la opción correspondiente del datalist de Municipio
    if (data.municipio === null) {
        $('#municipio').val("");
    } else {
        $('#municipio').val(data.municipio);
    }

    // Seleccionar la opción correspondiente del select de Tipo Cliente
    if (data.tipoCliente === null) {
        $('#tipoClienteModal option[data-value=""]').prop('selected', true);
    } else {
        $('#tipoClienteModal option[data-value="' + data.tipoCliente + '"]').prop('selected', true);
    }

    // Actualizar la URL del formulario con el ID del cliente
    var formAction1 = $('#editarClienteForm').attr('action');
    formAction1 = '/clientes/' + data.id;
    $('#editarClienteForm').attr('action', formAction1);

    var formAction2 = $('#agregarEmpleadoForm').attr('action');
    formAction2 = '/empleados';
    $('#agregarEmpleadoForm').attr('action', formAction2);

    // Desmarcar todos los checkboxes
    $('.marca').prop('checked', false);


}

function updateMunicipio() {

    var municipio = document.getElementById("municipio");
    var municipioModal = document.getElementById("municipioModal");
    var selectedOption = document.querySelector("#municipios option[value='" + municipio.value + "']");

    if (selectedOption) {
        municipioModal.value = selectedOption.getAttribute("data-value");
    } else {
        municipioModal.value = "";
    }
}

function updateMunicipio2() {

    var municipio = document.getElementById("municipioNuevo");
    var municipioModal = document.getElementById("idMunicipioNuevo");
    var selectedOption = document.querySelector("#municipios2 option[value='" + municipio.value + "']");

    if (selectedOption) {
        municipioModal.value = selectedOption.getAttribute("data-value");
    } else {
        municipioModal.value = "";
    }
}

// Función para obtener la fecha actual en formato 'YYYYMMDD'
function getCurrentDate() {
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const day = String(today.getDate()).padStart(2, '0');
    return year + month + day;
}

// Función para obtener la fecha actual en formato 'YYYYMMDD'
function getCurrentDate2() {
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const day = String(today.getDate()).padStart(2, '0');
    return day + '/' + month + '/' + year;
}