<div class="col-12">
	
	<div class="card flex-fill">
		
		<div class="card-body">
			
			<form action="{{ route('incidencias.store') }}" method="post" enctype="multipart/form-data" id="agregarIncidenciaForm" autocomplete="off">
				@csrf
				
				<div class="row">
					
					<div class="col-lg-12">
						
						<h3 class="h5 text-primary"><i class="align-middle" data-feather="list"></i><span class="align-middle"> Añadir incidencia</span></h3>
			
						<div class="mb-3 form-floating">
							<input type="text" class="form-control" id="titulo" name="titulo" maxlength="50" placeholder="Título" required>
							<label for="titulo" class="form-label">Título *</label>
						</div>
						
					</div>
					
					<div class="col-lg-3">
						
						<div class="mb-3 form-floating">
							<input class="form-control" type="search" list="datalistCliente" id="cliente" name="cliente" value="" onchange="updateCliente()" onkeydown="if(event.key === 'Tab') { event.preventDefault(); updateCliente(); }" required>
							<label for="cliente" class="form-label">Cliente *</label>
							<datalist id="datalistCliente">
								@foreach ($clientes->sortBy('nombre') as $cliente)
								<option value="{{ $cliente->nombre }}" data-nombre="{{ $cliente->nombre }}" data-codigo="{{ $cliente->id }}">{{ $cliente->id }}</option>
								@endforeach
							</datalist>
							<input type="hidden" name="idCliente" id="idCliente" value="">
						</div>
						
					</div>
					
					<div class="col-lg-3">
						
						<div class="mb-3 form-floating input-group">
							<select class="form-select" id="empleado" name="empleado"></select>
							<label for="empleado" class="form-label">Empleado</label>
							<input type="hidden" name="idEmpleado" id="idEmpleado" value="">
							<button class="btn btn-blue" type="button" id="btnAgregarEmpleado" data-bs-toggle="modal" data-bs-target="#incidenciaModal3" data-bs-toggle="tooltip" data-bs-placement="top" title="Añadir empleado" disabled><i class="align-middle" data-feather="plus"></i></button>
						</div>
						
					</div>
					
					<div class="col-lg-2">
						
						<div class="mb-3 form-floating">
							<select class="form-select" id="departamento" name="departamento" required>
								<option value="">Selecciona un departamento</option>
								@foreach ($departamentos as $departamento)
								<option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
								@endforeach
							</select>
							<label for="departamento" class="form-label">Departamento *</label>
							<input type="hidden" name="idDepartamento" id="idDepartamento" value="">
						</div>
						
					</div>
					
					<div class="col-lg-2">
						
						<div class="mb-3 form-floating">
							<select class="form-select" id="prioridad" name="prioridad" required>
								<option value="">Selecciona una prioridad</option>
								@foreach ($prioridades as $prioridad)
								<option value="{{ $prioridad->id }}">{{ $prioridad->nombre }}</option>
								@endforeach
							</select>
							<label for="prioridad" class="form-label">Prioridad *</label>
							<input type="hidden" name="idPrioridad" id="idPrioridad" value="">
						</div>
						
					</div>
					
					<div class="col-lg-2">
						
						<div class="mb-3 form-floating">
							
							<select class="form-select" id="facturacion" name="facturacion" required>
								<option value="">Selecciona una facturación</option>
								@foreach ($facturaciones as $facturacion)
								<option value="{{ $facturacion->id }}">{{ $facturacion->nombre }}</option>
								@endforeach
							</select>
							
							<label for="facturacion" class="form-label">Facturación *</label>
							<input type="hidden" name="idFacturacion" id="idFacturacion" value="">
						</div>
						
					</div>
					
					<div class="col-lg-6">
						<div class="mb-3 checkbox-frame">
							<p class="mb-0"><small>Uso interno (elegir al menos una opción) *</small></p>
							@foreach ($areas as $area)
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" id="area{{ $area->id }}" value="{{ $area->id }}" name="areas[]">
								<label class="form-check-label" for="area{{ $area->id }}">{{ $area->nombre }}</label>
							</div>
							@endforeach
						</div>
					</div>
					
					<div class="col-lg-6">
						<div class="mb-3">
							<div class="input-group">
								<input type="file" class="form-control border-secondary" id="archivo" name="archivo">
							</div>
							<small class="form-text text-muted">Arrastra y suelta un archivo o haz clic en el botón para seleccionar un archivo</small>
						</div>
					</div>

					<div class="col-lg-12">
						<div class="mb-3 form-floating">
							<textarea class="form-control" placeholder="Descripción" id="descripcion" name="descripcion"></textarea>
							<label for="descripcion" class="form-label">Descripción</label>
						</div>
					</div>
					
				</div>
				
				<div class="d-grid gap-2 d-md-flex justify-content-md-end">
					<button type="submit" class="btn btn-blue"><i class="align-middle" data-feather="plus"></i><span class="align-middle"> Añadir incidencia</span></button>                    
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="align-middle" data-feather="corner-down-left"></i><span class="align-middle"> Volver</span></button>
				</div>
				
			</form>
			
		</div>
		
	</div>
	
</div>

<script>
	document.getElementById("agregarIncidenciaForm").addEventListener("submit", function(event) {
		// Obtener todos los checkboxes de áreas
		var checkboxes = document.querySelectorAll("input[type='checkbox'][name='areas[]']");
		
		// Verificar si al menos uno está seleccionado
		var isAnyCheckboxSelected = Array.from(checkboxes).some(function(checkbox) {
			return checkbox.checked;
		});
		
		// Si ningún checkbox está seleccionado, prevenir el envío del formulario y mostrar un mensaje de error
		if (!isAnyCheckboxSelected) {
			event.preventDefault();
			alert("Debe seleccionar al menos un área.");
		}
	});


	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
	var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
	return new bootstrap.Tooltip(tooltipTriggerEl)
	})
</script>														