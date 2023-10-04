<div class="col-12">
	
	<div class="card flex-fill">
		
		<div class="card-body">
			
			<form action="{{ route('empleados.store') }}" method="post" id="agregarEmpleadoForm" autocomplete="off">
				@csrf
				
				<div class="row">

					<div class="col-lg-12">
						<h3 class="h5 mb-3 text-primary" id="clienteEmpleadoModal"></h3>
						<input type="hidden" name="idCliente" id="idClienteEmpleadoModal" value="">
					</div>
					
					<div class="col-lg-4">
						<div class="mb-3 form-floating">
							<input type="text" class="form-control" id="nombreModal" name="nombre" maxlength="50" placeholder="Nombre" required>
							<label for="nombreModal" class="form-label">Nombre *</label>
						</div>
					</div>

					<div class="col-lg-4">
						<div class="mb-3 form-floating">
							<input type="text" class="form-control" id="cargoModal" name="cargo" maxlength="50" placeholder="Cargo">
							<label for="cargoModal" class="form-label">Cargo</label>
						</div>
					</div>

					<div class="col-lg-4">
						<div class="mb-3 form-floating">
							<input type="text" class="form-control" id="telefonoFijoModal" name="telefonoFijo" placeholder="Teléfono fijo">
							<label for="telefonoFijoModal" class="form-label">Teléfono fijo</label>
						</div>
					</div>

					<div class="col-lg-4">
						<div class="mb-3 form-floating">
							<input type="text" class="form-control" id="telefonoMovilModal" name="telefonoMovil" placeholder="Teléfono móvil">
							<label for="telefonoMovilModal" class="form-label">Teléfono móvil</label>
						</div>
					</div>

					<div class="col-lg-4">
						<div class="mb-3 form-floating">
							<input type="email" class="form-control" id="correoEmpresaModal" name="correoEmpresa" placeholder="Correo empresa">
							<label for="correoEmpresaModal" class="form-label">Correo empresa</label>
						</div>
					</div>

					<div class="col-lg-4">
						<div class="mb-3 form-floating">
							<input type="email" class="form-control" id="correoPersonalModal" name="correoPersonal" placeholder="Correo personal">
							<label for="correoPersonalModal" class="form-label">Correo personal</label>
						</div>
					</div>

				</div>
				
				<div class="d-grid gap-2 d-md-flex justify-content-md-end">
					<button type="submit" class="btn btn-blue"><i class="align-middle" data-feather="plus"></i><span class="align-middle"> Añadir empleado</span></button>
					<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#incidenciaModal2"><i class="align-middle" data-feather="corner-down-left"></i><span class="align-middle"> Volver</span></button>
				</div>
				
			</form>
			
		</div>
		
	</div>
	
</div>

<script>
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
					updateCliente();
					} else {
					alert('Error al crear el empleado.');
				}
				
			},
			error: function() {
				alert('Error al enviar el formulario.');
			}
		});
	});
</script>