<div class="row">
	
	<div class="col-md-12 col-lg-12 col-xl-12">
		
		<ul class="list-unstyled">
			
			<li>
				
				<div class="card">
					
					<div class="card-header d-flex justify-content-between p-2 blue2">
						
						<h5 class="card-title mb-0 text-white me-2"><i class="align-middle" data-feather="user"></i></h5>
						<p class="fw-bold mb-0 text-white" id="usuarioMensaje"></p>
						<p class="small mb-0 ms-auto text-white" id="fechaMensaje"></p>
						
					</div>
					
					<div class="card-body p-2">
						
						<form id="mensajeForm" method="POST" action="" enctype="multipart/form-data">
							
							@csrf
							<input type="hidden" id="idIncidenciaMensaje" name="idIncidencia" value="">
							
							<div class="row">
								
								<div class="col-lg-12">
									
									<ul class="list-inline">
										<li class="list-inline-item"><strong>Incidencia: </strong><small class="text-muted" id="incidenciaModalLabel"></small></li>
										<li class="list-inline-item"><strong>Cliente: </strong><small class="text-muted" id="clienteMensaje"></small></li>
										<li class="list-inline-item"><strong>Empleado: </strong><small class="text-muted" id="empleadoMensaje"></small></li>
									</ul>
									
								</div>
								
								<div class="col-lg-4">
									<div class="form-floating">
										<datalist id="datalistClienteModal">
											@foreach ($clientes->sortBy('nombre') as $cliente)
												<option value="{{ $cliente->nombre }}" data-nombre="{{ $cliente->nombre }}" data-codigo="{{ $cliente->id }}">{{ $cliente->id }}</option>
											@endforeach
										</datalist>
										<input type="hidden" name="idClienteModal" id="idClienteModal" value="">
									</div>
								</div>
								
								<div class="col-lg-12" id="descripcionBody"></div>
								<div class="col-lg-12" id="archivoBody"></div>
								
								<div class="col-lg-3">
									<div class="mb-3 form-floating">
										<select class="form-select" id="estadoModal" name="estado" required>
											@foreach ($estados as $estado)
												<option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
											@endforeach
										</select>
										<label for="estadoModal">Estado *</label>
										
										<input type="hidden" name="idEstadoModal" id="idEstadoModal" value="">
									</div>
								</div>
								
								<div class="col-lg-3">
									<div class="mb-3 form-floating">
										<select class="form-select" id="prioridadModal" name="prioridad" required>
											@foreach ($prioridades as $prioridad)
												<option value="{{ $prioridad->id }}">{{ $prioridad->nombre }}</option>
											@endforeach
										</select>
										<label for="prioridadModal" class="form-label">Prioridad *</label>
										
										<input type="hidden" name="idPrioridadModal" id="idPrioridadModal" value="">
									</div>
								</div>
								
								<div class="col-lg-3">
									<div class="mb-3 form-floating">
										<select class="form-select" id="departamentoModal" name="departamento" required>
											@foreach ($departamentos as $departamento)
												<option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
											@endforeach
										</select>
										<label for="departamentoModal" class="form-label">Departamento *</label>
										
										<input type="hidden" name="idDepartamentoModal" id="idDepartamentoModal" value="">
									</div>
								</div>
								
								<div class="col-lg-3">
									<div class="mb-3 form-floating">
										<select class="form-select" id="facturacionModal" name="facturacion" required>
											@foreach ($facturaciones as $facturacion)
												<option value="{{ $facturacion->id }}">{{ $facturacion->nombre }}</option>
											@endforeach
										</select>
										<label for="facturacionModal" class="form-label">Facturación *</label>
										
										<input type="hidden" name="idFacturacionModal" id="idFacturacionModal" value="">
									</div>
								</div>

								<div class="col-lg-6">
									<div class="mb-3 checkbox-frame">
									<p class="mb-0"><small>Uso interno (elegir al menos una opción) *</small></p>
										@foreach ($areas as $area)
										<div class="form-check form-check-inline">
											<input class="form-check-input area" type="checkbox" id="area2_{{ $area->id }}" value="{{ $area->id }}" name="areas[]">
											<label class="form-check-label" for="area2_{{ $area->id }}">{{ $area->nombre }}</label>
										</div>
										@endforeach
									</div>
								</div>
								
								<div class="col-lg-6">
									<div class="mb-3">
										<div class="input-group">
											<input type="file" class="form-control border-secondary" id="archivoMensaje" name="archivo">
										</div>
										<small class="form-text text-muted">Arrastra y suelta un archivo o haz clic en el botón para seleccionar un archivo</small>
									</div>
								</div>
								
								<div class="col-lg-12">
									<div class="mb-3 form-floating">
										<textarea class="form-control" id="descripcionModal" name="descripcion" placeholder="Descripción"></textarea>
										<label for="descripcionModal" class="form-label">Descripción</label>
									</div>
								</div>
								
								<div class="col-lg-12 text-end">
									<button type="submit" class="btn btn-blue"><i class="align-middle" data-feather="save"></i><span class="align-middle"> Guardar cambios</button>
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="align-middle" data-feather="corner-down-left"></i><span class="align-middle"> Volver</span></button>
								</div>

							</div>
								
						</form>
							
					</div>
						
				</div>
					
			</li>
				
		</ul>
			
		<ul class="list-unstyled" id="incidenciaLineasList"></ul>
			
	</div>
		
</div>