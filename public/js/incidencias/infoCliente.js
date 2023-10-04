function updateCliente() {
    var idCliente = document.getElementById("idCliente");
    var clienteInput = document.getElementById("cliente");
    var selectedOption = document.querySelector("#datalistCliente option[value='" + clienteInput.value + "']");

    if (selectedOption) {

        idCliente.value = selectedOption.getAttribute("data-codigo");

        var nombre = selectedOption.getAttribute("data-nombre");
        var codigo = selectedOption.getAttribute("data-codigo");

        document.getElementById("clienteEmpleadoModal").innerHTML = "Añadir empleado para el cliente: " + nombre;
        document.getElementById("idClienteEmpleadoModal").value = codigo;

        // Si se ha seleccionado un cliente, actualizar la tabla de empleados
        actualizarTablaCliente();

    } else {
        limpiarDatos();
    }
}

function limpiarDatos() {

    idCliente.value = "";

    document.getElementById("infoCliente").innerHTML = "<p class='lead'>Introduzca el código de cliente</p>";

    // Vaciar select de empleados
    document.getElementById("empleado").innerHTML = '';

    document.getElementById("btnAgregarEmpleado").disabled = true;

}

function actualizarTablaCliente() {

    var idCliente = document.getElementById("idCliente").value;

    var url = urlEmpleadosIndex.replace(':idCliente', idCliente);
    url = url.replace(':idCliente', idCliente);

    $.ajax({
        type: "GET",
        url: url,
        data: {
            idCliente: idCliente
        },
        dataType: 'json',
        success: function(response) {

            var cliente = response.cliente;

            $('#infoCliente').html("");

            var contenidoHTML = "<div class='col-6'><h3 class='h5 mb-3 text-primary'>" + cliente.nombre + "</h3>";

            contenidoHTML += "<ul class='list-group list-group-flush'>";
            
            if (cliente.nif !== null) {
                contenidoHTML += "<li class='list-group-item'><small class='text-muted'><strong>NIF: </strong>" + cliente.nif + "</small></li>";
            }
            
            if (cliente.tipoCliente !== null) {
                contenidoHTML += "<li class='list-group-item'><small class='text-muted'><strong>Tipo de cliente: </strong>" + cliente.tipoCliente + "</small></li>";
            }
            
            if (cliente.ccaa !== null) {
                contenidoHTML += "<li class='list-group-item'><small class='text-muted'><strong>Comunidad autónoma: </strong>" + cliente.ccaa + "</small></li>";
            }
            
            if (cliente.provincia !== null) {
                contenidoHTML += "<li class='list-group-item'><small class='text-muted'><strong>Provincia: </strong>" + cliente.provincia + "</small></li>";
            }

            if (cliente.municipio !== null) {
                contenidoHTML += "<li class='list-group-item'><small class='text-muted'><strong>Municipio: </strong>" + cliente.municipio + "</small></li>";
            }
            
            if (cliente.domicilio !== null) {
                contenidoHTML += "<li class='list-group-item'><small class='text-muted'><strong>Domicilio: </strong>" + cliente.domicilio + "</small></li>";
            }
            
            if (cliente.codigoPostal !== null) {
                contenidoHTML += "<li class='list-group-item'><small class='text-muted'><strong>Código Postal: </strong>" + cliente.codigoPostal + "</small></li>";
            }

            if (cliente.telefono !== null) {
                contenidoHTML += "<li class='list-group-item'><small class='text-muted'><strong>Teléfono: </strong>" + cliente.telefono + "</small></li>";
            }
            
            if (cliente.movil !== null) {
                contenidoHTML += "<li class='list-group-item'><small class='text-muted'><strong>Móvil: </strong>" + cliente.movil + "</small></li>";
            }
            
            if (cliente.email !== null) {
                contenidoHTML += "<li class='list-group-item'><small class='text-muted'><strong>Correo electrónico: </strong>" + cliente.email + "</small></li>";
            }
            
            if (cliente.observaciones !== null) {
                contenidoHTML += "<li class='list-group-item'><small class='text-muted'><strong>Observaciones: </strong>" + cliente.observaciones + "</small></li>";
            }
            
            contenidoHTML += "</ul></div>";
            
            $('#infoCliente').append(contenidoHTML);
            
            if (cliente.empleados.length > 0) {

                var empleadoHtml = "<div class='col-6'><div class='table-responsive'><table class='table table-hover table-sm caption-top'><caption>Empleados</caption><thead><tr><th>Nombre</th><th>Cargo</th><th>Teléfono fijo</th><th>Teléfono móvil</th><th>Correo empresa</th><th>Correo personal</th></tr></thead><tbody>";
                
                $.each(cliente.empleados, function(index,empleado) {

                    empleadoHtml += "<tr>";
                    empleadoHtml += "<td>" + empleado.nombre + "</td>";
                    empleadoHtml += "<td>" + (empleado.cargo ? empleado.cargo : '-') +"</td>";
                    empleadoHtml += "<td>" + (empleado.telefonoFijo ? empleado.telefonoFijo : '-') + "</td>";
                    empleadoHtml += "<td>" + (empleado.telefonoMovil ? empleado.telefonoMovil : '-') + "</td>";
                    empleadoHtml += "<td>" + (empleado.correoEmpresa ? empleado.correoEmpresa : '-') + "</td>";
                    empleadoHtml += "<td>" + (empleado.correoPersonal ? empleado.correoPersonal : '-') + "</td>";
                    empleadoHtml += "</tr>";

                });

                empleadoHtml += "</tbody></table></div></div>";

                $('#infoCliente').append(empleadoHtml);

            } else {

                $('#infoCliente').append("<div class='col-6'><small class='text-muted'>No hay empleados registrados para este cliente.</small></div>");

            }

            updateEmpleados(response.cliente.empleados);

            document.getElementById("btnAgregarEmpleado").disabled = false;

        },
        error: function(xhr, status, error) {
            console.log("Error: " + error);
            $('#infoCliente').html("<p class='lead'>Se ha producido un error.</p>");
        }
    });
}

function updateEmpleados(empleados) {
    
    var selectEmpleado = document.getElementById("empleado");

    selectEmpleado.innerHTML = '';

    empleados.forEach(function( empleado) {
         var option = document.createElement('option');
            option.value = empleado.id;
            option.setAttribute('data-nombre',
                empleado.nombre);
            option.setAttribute('data-codigo',
                empleado.id);
            option.textContent = empleado.nombre;
            selectEmpleado.appendChild(option);
    });

}