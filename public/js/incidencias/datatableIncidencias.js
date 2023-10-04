let table = new DataTable('#tablaIncidencias', {

    columnDefs: [
        {
            target: 10,
            visible: false,
            searchable: true,
        },
    ],

    searchCols: [
        null, // Columna 1
        null, // Columna 2
        null, // Columna 3
        null, // Columna 4
        null, // Columna 5
        null, // Columna 6
        null, // Columna 7
        null, // Columna 8
        null, // Columna 9
        null, // Columna 10
    ],

    dom: 'Bfrtip',
    buttons: [
        {
            text: 'Añadir incidencia',
            action: function(e, dt, node, config) {
              // Aquí puedes escribir el código para abrir tu ventana modal
              $('#incidenciaModal2').modal('show');
            }
        },
        {
            extend: 'excelHtml5',
            text: 'Exportar a Excel',
            header: true,
            footer: false,
            messageTop: null,
            sheetName: 'Hoja1',
            filename: 'Incidencias_' + getCurrentDate(),
            title: 'Informe de incidencias creado por ' + currentUserName + ' en ' + getCurrentDate2(),
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
        }
    ],
    

    responsive: true,

    select: true,

    colReorder: true,

    "pageLength": 50, // muestra las primeras 50 filas

    "lengthChange": false, // oculta el campo de "Mostrar" registros

    "order": [
        [9, "asc"],
        [7, "desc"]
    ],

    "ordering": true,

    "orderMulti": true,

    "columns": [{
            "data": "id"
        },
        {
            "data": "titulo"
        },
        {
            "data": "nombreUsuario"
        },
        {
            "data": "nombreDepartamento"
        },
        {
            "data": "nombreCliente"
        },
        {
            "data": "nombreEmpleado"
        },
        {
            "data": "fechaCreacion",
            "render": function(data, type, row, meta) {
                // Formatear fecha
                var date = new Date(data);
                var formattedDate = date.getFullYear() + "/" +
                    ("0" + (date.getMonth() + 1)).slice(-2) + "/" +
                    ("0" + date.getDate()).slice(-2) + " " +
                    ("0" + date.getHours()).slice(-2) + ":" +
                    ("0" + date.getMinutes()).slice(-2);
                return formattedDate;
            }
        },
        {
            "data": "fechaActualizacion",
            "render": function(data, type, row, meta) {
                // Formatear fecha
                var date = new Date(data);
                var formattedDate = date.getFullYear() + "/" +
                    ("0" + (date.getMonth() + 1)).slice(-2) + "/" +
                    ("0" + date.getDate()).slice(-2) + " " +
                    ("0" + date.getHours()).slice(-2) + ":" +
                    ("0" + date.getMinutes()).slice(-2);
                return formattedDate;
            }
        },  
        {
            "data": "prioridad",
            "render": function(data, type, row, meta) {
                let buttonClass = '';
                switch (data) {
                    case 'Alta':
                        buttonClass = 'red';
                        break;
                    case 'Media':
                        buttonClass = 'yellow';
                        break;
                    case 'Baja':
                        buttonClass = 'green';
                        break;
                    default:
                        buttonClass = 'secondary';
                }
                return '<div class="text-center"><span class="badge rounded-pill full-width text-bg-' + buttonClass + '">' + data + '</span></div>';
            },
        },
        {
            "data": "estado",
            "render": function(data, type, row, meta) {
                let buttonClass = '';
                let buttonText = '';
                switch (data) {
                    case '1. Pendiente':
                        buttonClass = 'red';
                        buttonText = 'Pendiente';
                        break;
                    case '2. En curso':
                        buttonClass = 'yellow';
                        buttonText = 'En curso';
                        break;
                    case '3. Solucionado':
                        buttonClass = 'green';
                        buttonText = 'Solucionado';
                        break;
                    case '4. Suspendido':
                        buttonClass = 'secondary';
                        buttonText = 'Suspendido';
                        break;
                    default:
                        buttonClass = 'secondary';
                        buttonText = data;
                }
                return '<div class="text-center"><span class="badge rounded-pill full-width text-bg-' + buttonClass + '">' + buttonText + '</span></div>';
            },
        },
        {
            "data": "areas"
        },

    ],

    language: {
        search: "",
        searchPlaceholder: 'Búsqueda general',
        url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
    },

});

table.buttons().container().appendTo( '#tablaIncidencias_wrapper .col-md-6:eq(0)' );

// Manejar el evento click en las filas de la tabla
$('#tablaIncidencias tbody').on('click', 'tr', function() {

    // Obtener los datos de la fila seleccionada
    var row = table.row(this).data();

    mostrarModal(row.id);

});

function mostrarModal(id) {
    $.ajax({
        url: '/incidencias/' + id,
        type: 'GET',
        success: function(data) {

            // Rellenar la ventana modal con los datos de la incidencia
            $('#incidenciaModalLabel').text(data.id + " - " + data.titulo);

            $('#descripcionModal').html(data.descripcion);
            
            $('#tituloModal').val(data.titulo);

            $('#estadoModal').val(data.idEstado);
            $('#idEstadoModal').val(data.idEstado);

            $('#prioridadModal').val(data.idPrioridad);
            $('#idPrioridadModal').val(data.idPrioridad);

            $('#departamentoModal').val(data.idDepartamento);
            $('#idDepartamentoModal').val(data.idDepartamento);

            $('#facturacionModal').val(data.idFacturacion);
            $('#idFacturacionModal').val(data.idFacturacion);

            // Obtener el nombre del cliente y establecerlo en el campo de entrada
            var nombreClienteModal = $('#datalistClienteModal option[data-codigo="' + data.idCliente + '"]').attr('data-nombre');
            var codigoClienteModal = $('#datalistClienteModal option[data-nombre="' + nombreClienteModal + '"]').data('codigo');

            $('#idClienteModal').val(codigoClienteModal);
            $('#clienteModal').val(nombreClienteModal);
            $('#datalistClienteModal').trigger('input');

            // Actualizar la URL del formulario con el ID de la incidencia
            var formAction = $('#editarForm').attr('action');
            formAction = '/incidencias/' + data.id;
            $('#editarForm').attr('action', formAction);

            // Actualizar la URL del formulario con el ID de la incidencia
            var formAction2 = $('#mensajeForm').attr('action');
            formAction2 = '/incidenciaLinea';
            $('#mensajeForm').attr('action', formAction2);

            getEmpleados(data);
            getAreas(data);

            $('#idIncidenciaMensaje').val(data.id);
            $('#idEstadoMensaje').val(1);

            $('#fechaMensaje').text(formatFecha(data.fechaCreacion));

            $('#tituloMensaje').text(data.titulo);
            $('#clienteMensaje').text(nombreClienteModal);

            getUsuario(data.idUsuario, function(usuarioMensaje) {
                $('#usuarioMensaje').text("  " + usuarioMensaje);
            });
        
            getDepartamento(data.idDepartamento);
            getPrioridad(data.idPrioridad);
            getEmpleado(data.idEmpleado);
            getIncidenciaLineas(data.id);

            if (data.descripcion) {
                var descripcionHTML = data.descripcion;
                $('#descripcionBody').html(descripcionHTML);
            } else {
                $('#descripcionBody').html("");
            }

            if (data.nombreArchivo) {
                var archivoHTML =  '<a href="/incidencia/download/' + data.id + '" class="btn btn-blue mb-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Descargar archivo">Descargar archivo: ' + data.nombreArchivo + '</a>';
                $('#archivoBody').html(archivoHTML);
            } else {
                $('#archivoBody').html("");
            }

            // Mostrar la ventana modal
            $('#incidenciaModal').modal('show');

        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log("Error en la solicitud AJAX: " + textStatus + ", " + errorThrown);
        }
    });
};

function getAreas(data) {

    // Desmarcar todos los checkboxes
    $('.area').prop('checked', false);

    // Hacer una petición AJAX para obtener las areas de la incidencia seleccionada
    $.ajax({
        url: '/incidencias/' + data.id + '/areas',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            
            // Seleccionar los checkboxes correspondientes a las areas de la incidencia
            response.forEach(function(area) {
                $('.area[value="' + area.id + '"]').prop('checked', true);
            });
            
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });

}

function getEmpleados(data) {
    // Obtener los empleados del cliente de la incidencia
    $.ajax({
        url: '/empleados/cliente/' + data.idCliente,
        type: 'GET',
        success: function(response) {

            // Rellenar el select de empleados con los empleados devueltos
            var selectEmpleadoModal = $('#empleadoModal');

            selectEmpleadoModal.empty();

            $.each(response, function(i, empleado) {
                selectEmpleadoModal.append($('<option>', {
                    value: empleado.id,
                    text: empleado.nombre
                }));
            });

            // Seleccionar la opción correspondiente al empleado de la incidencia
            $('#empleadoModal').val(data.idEmpleado);

        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log("Error en la solicitud AJAX: " + textStatus + ", " + errorThrown);
        }
    });
};

function getEmpleados2(idCliente) {
    // Obtener los empleados del cliente de la incidencia
    $.ajax({
        url: '/empleados/cliente/' + idCliente,
        type: 'GET',
        success: function(response) {

            // Rellenar el select de empleados con los empleados devueltos
            var selectEmpleadoModal = $('#empleadoModal');

            selectEmpleadoModal.empty();

            $.each(response, function(i, empleado) {
                selectEmpleadoModal.append($('<option>', {
                    value: empleado.id,
                    text: empleado.nombre
                }));
            });

        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log("Error en la solicitud AJAX: " + textStatus + ", " + errorThrown);
        }
    });
};

function getUsuario(idUsuario, callback) {
    $.ajax({
        url: '/usuarios/' + idUsuario,
        type: 'GET',
        dataType: 'json',
        success: function(usuario) {

            if (usuario) {

                // Si la respuesta indica éxito, llamar al callback con el nombre del usuario
                callback(usuario.name);
            } else {

                // Si la respuesta indica un error, llamar al callback con un mensaje de error
                callback('');
            }
        },
        error: function(xhr, textStatus, errorThrown) {

            // En caso de un error de conexión, llamar al callback con un mensaje de error
            callback('');
        }
    });
};

function getDepartamento(idDepartamento) {
    $.ajax({
        url: '/departamentos/' + idDepartamento,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            if (data.success) {
                // Si la respuesta indica éxito, mostrar el nombre del departamento
                $('#departamentoMensaje').text("Departamento: " + data.departamento.nombre);
            } else {
                // Si la respuesta indica un error, mostrar un mensaje de error
                console.log('Error al obtener el departamento: ' + textStatus);
            }
        },
        error: function(xhr, textStatus, errorThrown) {
            // En caso de un error de conexión, mostrar un mensaje de error
            console.log('Error al obtener el departamento: ' + textStatus);
        }
    });
};

function getPrioridad(idPrioridad) {
    $.ajax({
        url: '/prioridades/' + idPrioridad,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            if (data.success) {
                // Si la respuesta indica éxito, mostrar el nombre de prioridad
                $('#prioridadMensaje').text("Prioridad: " + data.prioridad.nombre);
            } else {
                // Si la respuesta indica un error, mostrar un mensaje de error
                console.log('Error al obtener la prioridad: ' + textStatus);
            }
        },
        error: function(xhr, textStatus, errorThrown) {
            // En caso de un error de conexión, mostrar un mensaje de error
            console.log('Error al obtener la prioridad: ' + textStatus);
        }
    });
};

function getEmpleado(idEmpleado) {

    if (idEmpleado === null) {

        $('#empleadoMensaje').text("");

    } else {

        $.ajax({
            url: '/empleados/' + idEmpleado,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    // Si la respuesta indica éxito, mostrar el nombre de empleado
                    $('#empleadoMensaje').text(data.empleado.nombre);
                } else {
                    // Si la respuesta indica un error, mostrar un mensaje de error
                    console.log('Error al obtener el empleado: ' + idEmpleado);
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                // En caso de un error de conexión, mostrar un mensaje de error
                console.log('Error al obtener el empleado: ' + textStatus);
            }
        });

    }

};

function getIncidenciaLineas(idIncidencia) {
    $.ajax({
        url: '/incidenciaLinea/' + idIncidencia,
        type: 'GET',
        dataType: 'json',

        success: function(data) {
            if (data) {

                // Limpiar el contenido previo del contenedor
                $('#incidenciaLineasList').html("");

                if (data.length > 0) {

                    // Agregar cada línea de incidencia en forma de HTML
                    var html = '';
                    
                    data.forEach(function(incidenciaLinea, index) {

                        html += '<li>';
                        html += '<div class="card">';
                        html += '<div class="card-header d-flex justify-content-between p-2 blue2">';
                        html += '<p class="fw-bold mb-0 text-white" id="usuarioLinea' + index +'"></p>';
                        html += '<p class="small mb-0 ms-auto text-white">' + formatFecha(incidenciaLinea.fecha) + '</p>';
                        html += '</div>';

                        if (incidenciaLinea.descripcion) {
                            html += '<div class="card-body p-2">';
                            html += incidenciaLinea.descripcion;
                            html += '</div>';
                        }

                        if (incidenciaLinea.nombreArchivo) {
                            html += '<div class="card-body p-2">';
                            html += '<a href="/incidenciaLinea/download/' + incidenciaLinea.id + '" class="btn btn-blue" data-bs-toggle="tooltip" data-bs-placement="top" title="Descargar archivo">Descargar archivo: ' + incidenciaLinea.nombreArchivo + '</a>';
                            html += '</div>';
                        }

                        getUsuario(incidenciaLinea.idUsuario, function(nombreUsuario2) {
                            $('#usuarioLinea' + index).text(nombreUsuario2);
                        });

                    });

                    document.getElementById('incidenciaLineasList').innerHTML = html;

                }

            } else {
                // Si la respuesta indica un error, mostrar un mensaje de error
                $('#incidenciaLineasList').html("");
                console.log('No existen lineas de incidencia: ' + idIncidencia);
            }
        },
        error: function(xhr, textStatus, errorThrown) {
            // En caso de un error de conexión, mostrar un mensaje de error
            $('#incidenciaLineasList').html("");
            console.log('Error al obtener las lineas de incidencia: ' + textStatus);
        }
    });
};

function formatFecha(fecha) {
    const options = {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    };
    const date = new Date(fecha);
    return date.toLocaleDateString('es-ES', options);
}

function getEstadoColor(idEstado) {
    switch (idEstado) {
        case "1":
            return 'primary';
        case "2":
            return 'warning';
        case "3":
            return 'success';
        default:
            return 'secondary';
    }
}

function getEstadoNombre(idEstado) {
    switch (idEstado) {
        case "1":
            return 'Pendiente';
        case "2":
            return 'En curso';
        case "3":
            return 'Solucionado';
        default:
            return '';
    }
};

// Agregar filtro por estado al cambiar los switches
$('.switch-estado').on('change', function() {
    var estadosSeleccionados = []; // Creamos un array para almacenar los estados seleccionados

    // Iteramos sobre todos los switches dentro del contenedor #filtros
    $('.switch-estado:checked').each(function() {
        var estado = $(this).siblings('.form-check-label').text().trim(); // Obtenemos el texto del label asociado al switch

        if (estado) {
            estadosSeleccionados.push(estado); // Agregamos el estado al array de estados seleccionados
        }
    });

    // Convertimos el array en un string separado por '|'
    var estadosFiltro = estadosSeleccionados.join('|');

    if (estadosFiltro) {
        // Aplicamos el filtro en la columna 9 de la tabla usando el operador OR ('|') para buscar cualquiera de los estados seleccionados
        table.column(9).search(estadosFiltro, true, false).draw();
    } else {
        // Filtrar por columna "id" si hay IDs para filtrar
        table.column(9).search('^$').draw();
    }
});

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