$(document).ready(function() {

	let table = new DataTable('#tablaEstados', {

		columnDefs: [
			{
				target: 0,
				visible: false,
				searchable: false,
			},
		],

		select: true,
		responsive: true,
		ordering: false, // Desactivar la opción de ordenación
		lengthChange: false, // Desactivar la opción de cambio de número de registros por página
		paging: false, // Desactivar paginación
		processing: false,
		searching: false,
		info: false, // Mostrar información del número de registros

		"order": [
			[1, "asc"],
		],

		"lengthChange": false, // desactivar la opción de cambio de número de registros por página
		"paging": false, // activar paginación
		"processing": false,
		"searching": false,

		language: {
			searchPlaceholder: 'Introduce para buscar...',
			url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
		},
	});

	// Manejar el evento click en las filas de la tabla
	$('#tablaEstados tbody').on('click', 'tr', function() {

		// Obtener los datos de la fila seleccionada
		var data = table.row(this).data();

		// Rellenar la ventana modal con los datos de la marca
		$('#editarModalLabel').text("Editar estado, Código: " + data[0]);

		$('#nombreModal').val(data[1]);

		// Actualizar la URL del formulario con el ID del cliente
		var formAction = $('#editarModal form').attr('action');
		formAction = '/estados/' + data[0];
		$('#editarModal form').attr('action', formAction);

        // Mostrar la ventana modal
        $('#editarModal').modal('show');

	});

});