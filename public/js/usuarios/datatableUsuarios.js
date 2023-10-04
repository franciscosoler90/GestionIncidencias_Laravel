$(document).ready(function() {

	let table = new DataTable('#tablaUsuarios', {

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
		deferRender: true,

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
	$('#tablaUsuarios tbody').on('click', 'tr', function() {

		// Obtener los datos de la fila seleccionada
		var tabla = table.row(this).data();

		if (tabla[0] === usuarioActualID){

			$.ajax({
				url: '/usuarios/' + tabla[0],
				type: 'GET',
				success: function(data) {

					console.log(data);

					// Rellenar la ventana modal con los datos de la marca
					$('#editarModalLabel').text("Editar usuario");

					$('#nombreModal').val(data.name);
					$('#emailModal').val(data.email);
					$('#movilModal').val(data.movil);
					$('#codigoModal').val(data.codigo);

					// Actualizar la URL del formulario con el ID del cliente
					var formAction = $('#editarModal form').attr('action');
					formAction = '/usuarios/' + data.id;
					$('#editarModal form').attr('action', formAction);

					// Actualizar la URL del formulario con el ID del cliente
					var formAction2 = $('#editarModal2 form').attr('action');
					formAction2 = '/usuarios/update-password';
					$('#editarModal2 form').attr('action', formAction2);

					// Mostrar la ventana modal
					$('#editarModal').modal('show');
		
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log("Error en la solicitud AJAX: " + textStatus + ", " + errorThrown);
				}
			});

		}

	});

});