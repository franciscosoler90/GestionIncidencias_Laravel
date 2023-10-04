let tablaEmpleados = new DataTable('#tablaEmpleados', {


    responsive: true,

    lengthChange: false, // desactivar la opción de cambio de número de registros por página
    paging: false, // desactivar paginación
    ordering: true, // desactivar ordenación
    searching: false, // desactivar campo de búsqueda
    select: false,
    responsive: true,

    order: [
        [1, "asc"]
    ],

    language: {
        search: "",
        searchPlaceholder: 'Introduce para buscar...',
        url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
    },
});

$(document).ready(function() {

    // Manejar el evento click en las filas de la tabla
    $('#tablaEmpleados tbody').on('click', 'tr', function() {

        var data = tablaEmpleados.row(this).data();

        console.log(data);

        // Obtener los elementos input
        var nombreInput = document.getElementById("nombreEmpleado");
        var cargoInput = document.getElementById("cargo2");
        var telefonoFijoInput = document.getElementById("telefonoFijo2");
        var telefonoMovilInput = document.getElementById("telefonoMovil2");
        var correoEmpresaInput = document.getElementById("correoEmpresa2");
        var correoPersonalInput = document.getElementById("correoPersonal2");

        // Limpiar los campos de entrada
        nombreInput.value = "";
        cargoInput.value = "";
        telefonoFijoInput.value = "";
        telefonoMovilInput.value = "";
        correoEmpresaInput.value = "";
        correoPersonalInput.value = "";

        if(data !== undefined){

            if(data[0]){

                $.ajax({
                    url: '/empleados/' + data[0],
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
        
                        if(response.success){
        
                            console.log(response.empleado);

                            var formAction3 = $('#editarEmpleadosForm').attr('action');
                            formAction3 = '/empleados/update/' + response.empleado.id;
                            $('#editarEmpleadosForm').attr('action', formAction3);                    
        
                            // Rellenar los campos de entrada con la información del empleado
                            nombreInput.value = response.empleado.nombre;
                            cargoInput.value = response.empleado.cargo;
                            telefonoFijoInput.value = response.empleado.telefonoFijo;
                            telefonoMovilInput.value = response.empleado.telefonoMovil;
                            correoEmpresaInput.value = response.empleado.correoEmpresa;
                            correoPersonalInput.value = response.empleado.correoPersonal;
        
                        }else{
        
                            // Limpiar los campos de entrada si no se encontró el empleado
                            nombreInput.value = "";
                            cargoInput.value = "";
                            telefonoFijoInput.value = "";
                            telefonoMovilInput.value = "";
                            correoEmpresaInput.value = "";
                            correoPersonalInput.value = "";
        
                        }
                    },
                    error: function(xhr, status, error) {
        
                        console.log(error);
                        // Limpiar los campos de entrada si no se encontró el empleado
                        nombreInput.value = "";
                        cargoInput.value = "";
                        telefonoFijoInput.value = "";
                        telefonoMovilInput.value = "";
                        correoEmpresaInput.value = "";
                        correoPersonalInput.value = "";
                    }
                });

            }else{

                // Limpiar los campos de entrada si no se encontró el empleado
                nombreInput.value = "";
                cargoInput.value = "";
                telefonoFijoInput.value = "";
                telefonoMovilInput.value = "";
                correoEmpresaInput.value = "";
                correoPersonalInput.value = "";

            }

        }
       
        // Mostrar la ventana modal
        $('#empleadoModal').modal('show');

    });

});