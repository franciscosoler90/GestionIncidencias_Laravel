$('#agregarEmpleadoForm').submit(function(event) {
    event.preventDefault();
    
    var formData = $(this).serialize();
    
    $.ajax({
        url: '/empleados',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {

            if (response.success) {
                    alert(response.message);
                } else {
                    alert('Error al crear el empleado.');
            }

        },
        error: function() {
            alert('Error al enviar el formulario.');
        }
    });
});