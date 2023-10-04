<form id="editarClienteForm" action="" method="post" autocomplete="off">
	@csrf
	@method('PUT')
	
	<div class="modal-body sky50">
		
		<div class="container-fluid">
			
			<div class="container">
				
				<div class="row">
					
					<div class="col-lg-12">
						
						<div class="card">
							
							<div class="card-body">
								
								<h3 class="h5 text-primary"><i class="align-middle" data-feather="user"></i> <span class="align-middle">Información del cliente</span></h3>
								
								<div class="row">
									
									<div class="col-lg-3">
										<div class="mb-3">
											<label for="nombreModal" class="form-label">Nombre *</label>
											<input type="text" class="form-control" id="nombreModal" name="nombreModal" required>
										</div>
									</div>

									<div class="col-lg-3">
										<div class="mb-3">
											<label for="codigoModal" class="form-label">Código *</label>
											<input type="number" class="form-control" id="codigoModal" name="codigoModal" value="" required>
										</div>
									</div>
									
									<div class="col-lg-3">
										<div class="mb-3">
											<label for="nifModal" class="form-label">NIF</label>
											<input type="text" class="form-control" id="nifModal" name="nifModal" value="">
										</div>
									</div>
									
									<div class="col-lg-3">
										<div class="mb-3">
											<label for="tipoClienteModal" class="form-label">Tipo de cliente *</label>
											<select class="form-select" id="tipoClienteModal" name="tipoClienteModal" required>
												<option value="" data-value="">Seleccione un tipo de cliente</option>
												<option value="AUTOS" data-value="AUTOS">AUTOS</option>
												<option value="SAT" data-value="SAT">SAT</option>
											</select>
										</div>
									</div>
									
									<h3 class="h5 text-primary"><i class="align-middle" data-feather="smartphone"></i> <span class="align-middle">Datos de contacto</span></h3>
									
									<div class="col-lg-3">
										<div class="mb-3">
											<label for="emailModal" class="form-label">Correo electrónico</label>
											<input type="email" class="form-control" id="emailModal" name="emailModal" value="" spellcheck="true">
										</div>
									</div>
									
									<div class="col-lg-3">
										<div class="mb-3">
											<label for="movilModal" class="form-label">Móvil</label>
											<input type="text" class="form-control" id="movilModal" name="movilModal" value="">
										</div>
									</div>
									
									<div class="col-lg-3">
										<div class="mb-3">
											<label for="telefonoModal" class="form-label">Teléfono</label>
											<input type="text" class="form-control" id="telefonoModal" name="telefonoModal" value="">
										</div>
									</div>
									
									<div class="col-lg-3">
										<div class="mb-3">
											<label for="faxModal" class="form-label">Fax</label>
											<input type="text" class="form-control" id="faxModal" name="faxModal" value="">
										</div>
									</div>
									
									<h3 class="h5 text-primary"><i class="align-middle" data-feather="navigation"></i> <span class="align-middle">Dirección</span></h3>
									
									<div class="col-lg-3">
										<div class="mb-3">
											<label for="paisModal" class="form-label">País</label>
											<select class="form-select" id="paisModal" name="paisModal">
												<option value="" data-value="">Seleccione un país</option>
												@foreach ($paises as $pais)
													<option value="{{ $pais->nombre }}" data-value="{{ $pais->nombre }}">{{ $pais->nombre }}</option>
												@endforeach
											</select>
										</div>
									</div>
									
									<div class="col-lg-3">
										<div class="mb-3">
											<label for="ccaaModal" class="form-label">Comunidad autónoma</label>
											<select class="form-select" id="ccaaModal" name="ccaaModal">
												<option value="" data-value="">Seleccione una comunidad autónoma</option>
												@foreach ($ccaas as $ccaa)
													<option value="{{ $ccaa->Nombre }}" data-value="{{ $ccaa->Nombre }}">{{ $ccaa->Nombre }}</option>
												@endforeach
											</select>
										</div>
									</div>
									
									<div class="col-lg-3">
										<div class="mb-3">
											<label for="provinciaModal" class="form-label">Provincia</label>
											<select class="form-select" id="provinciaModal" name="provinciaModal">
												<option value="" data-value="">Seleccione una provincia</option>
												@foreach ($provincias as $provincia)
													<option value="{{ $provincia->Provincia }}" data-value="{{ $provincia->Provincia }}">{{ $provincia->Provincia }}</option>
												@endforeach
											</select>
										</div>
									</div>
									
									<div class="col-lg-3">
										<div class="mb-3">
											<label for="municipio" class="form-label">Municipio</label>
											<input type="search" class="form-control" id="municipio" name="municipio" list="municipios" onchange="updateMunicipio()" >
											<datalist id="municipios">
												<option value="" data-value="">Seleccione un municipio</option>
												@foreach ($municipios as $municipio)
													<option value="{{ $municipio->Municipio }}" data-value="{{ $municipio->Municipio }}">{{ $municipio->Municipio }}</option>
												@endforeach
											</datalist>
											<input type="hidden" name="municipioModal" id="municipioModal" value="">
										</div>
									</div>
									
									<div class="col-lg-3">
										<div class="mb-3">
											<label for="domicilioModal" class="form-label">Domicilio</label>
											<input type="text" class="form-control" id="domicilioModal" name="domicilioModal" value="" spellcheck="true">
										</div>
									</div>
									
									<div class="col-lg-3">
										<div class="mb-3">
											<label for="codigoPostalModal" class="form-label">Código Postal</label>
											<input type="text" class="form-control" id="codigoPostalModal" name="codigoPostalModal" maxlength="5">
										</div>
									</div>
									
									<div class="col-lg-1">
										<div class="mb-3">
											<label for="numeroModal" class="form-label">Número</label>
											<input type="number" class="form-control" id="numeroModal" name="numeroModal" min="0" max="99999">
										</div>
									</div>
									
									<div class="col-lg-2">
										<div class="mb-3">
											<label for="pisoModal" class="form-label">Piso</label>
											<input type="number" class="form-control" id="pisoModal" min="0" max="99999" name="pisoModal">
										</div>
									</div>
									
									<div class="col-lg-1">
										<div class="mb-3">
											<label for="escaleraModal" class="form-label">Escalera</label>
											<input type="text" class="form-control" id="escaleraModal" name="escaleraModal">
										</div>
									</div>
									
									<div class="col-lg-2">
										<div class="mb-3">
											<label for="puertaModal" class="form-label">Puerta</label>
											<input type="text" class="form-control" id="puertaModal" name="puertaModal">
										</div>
									</div>

									<h3 class="h5 text-primary"><i class="align-middle" data-feather="tag"></i> <span class="align-middle">Marcas</span></h3>
									
									<div class="col-lg-12">
										<div class="mb-3">
											@foreach ($marcas as $marca)
												<div class="form-check form-check-inline">
													<input class="form-check-input marca" type="checkbox" id="checkbox{{ $marca->id }}" name="marcas[]" value="{{ $marca->id }}">
													<label class="form-check-label" for="checkbox{{ $marca->id }}">{{ $marca->nombre }}</label>
												</div>
											@endforeach
										</div>
									</div>

									<div class="col-lg-12">
										<div class="mb-3">
											<label for="observacionesModal" class="form-label">Observaciones</label>
											<textarea class="form-control" rows="3" id="observacionesModal" name="observacionesModal"></textarea>
										</div>
									</div>

									<div class="col-lg-12 text-end">
										<button type="submit" class="btn btn-blue"><i class="align-middle" data-feather="save"></i><span class="align-middle"> Guardar cambios</button>
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="align-middle" data-feather="corner-down-left"></i><span class="align-middle"> Volver</button>
									</div>

								</div>
								
							</div>
							
						</div>
						
					</div>
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
</form>																																																																																																		