<div class="modal fade" id="agregarCliente" data-bs-backdrop="static" tabindex="-1" aria-labelledby="agregarClienteLabel" aria-hidden="true">
	
	<div class="modal-dialog modal-fullscreen">
		
		<div class="modal-content">
						
			<div class="modal-body sky50">
				
				<div class="container-fluid">
					
					<div class="container">
						
						<div class="row">
							
							<div class="col-lg-12">
								
								<div class="card">
									
									<div class="card-body">
										
										<h3 class="h5 text-primary"><i class="align-middle" data-feather="user"></i> <span class="align-middle">Información del cliente</span></h3>
										
										<form action="{{ route('clientes.store') }}" method="post" autocomplete="off">
											@csrf
											
											<div class="row">
												
												<div class="col-lg-3">
													<div class="mb-3">
														<label for="nombreNuevo" class="form-label">Nombre *</label>
														<input type="text" class="form-control" id="nombreNuevo" name="nombreNuevo" autocomplete="off" required>
													</div>
												</div>
												
												<div class="col-lg-3">
													<div class="mb-3">
														<label for="idNuevo" class="form-label">Código *</label>
														<input type="number" class="form-control" id="idNuevo" name="idNuevo" min=1 max=999999 value="" autocomplete="off" required>
													</div>
												</div>
												
												<div class="col-lg-3">
													<div class="mb-3">
														<label for="nifNuevo" class="form-label">NIF</label>
														<input type="text" class="form-control" id="nifNuevo" name="nifNuevo" autocomplete="off" value="">
													</div>
												</div>
												
												<div class="col-lg-3">
													<div class="mb-3">
														<label for="tipoClienteNuevo" class="form-label">Tipo de cliente *</label>
														<select class="form-select" id="tipoClienteNuevo" name="tipoClienteNuevo" required>
															<option value="" data-value="">Seleccione un tipo de cliente</option>
															<option value="AUTOS" data-value="AUTOS">AUTOS</option>
															<option value="SAT" data-value="SAT">SAT</option>
														</select>
													</div>
												</div>
												
												<h3 class="h5 text-primary"><i class="align-middle" data-feather="smartphone"></i> <span class="align-middle">Datos de contacto</span></h3>
												
												<div class="col-lg-3">
													<div class="mb-3">
														<label for="emailNuevo" class="form-label">Correo electrónico</label>
														<input type="email" class="form-control" id="emailNuevo" name="emailNuevo" value="" autocomplete="off" spellcheck="true">
													</div>
												</div>
												
												<div class="col-lg-3">
													<div class="mb-3">
														<label for="movilNuevo" class="form-label">Móvil</label>
														<input type="text" class="form-control" id="movilNuevo" name="movilNuevo" autocomplete="off" value="">
													</div>
												</div>
												
												<div class="col-lg-3">
													<div class="mb-3">
														<label for="telefonoNuevo" class="form-label">Teléfono</label>
														<input type="text" class="form-control" id="telefonoNuevo" name="telefonoNuevo" autocomplete="off" value="">
													</div>
												</div>
												
												<div class="col-lg-3">
													<div class="mb-3">
														<label for="faxNuevo" class="form-label">Fax</label>
														<input type="text" class="form-control" id="faxNuevo" name="faxNuevo" autocomplete="off" value="">
													</div>
												</div>
												
												<h3 class="h5 text-primary"><i class="align-middle" data-feather="navigation"></i> <span class="align-middle">Dirección</span></h3>
												
												<div class="col-lg-3">
													<div class="mb-3">
														<label for="paisNuevo" class="form-label">País</label>
														<select class="form-select" id="paisNuevo" name="paisNuevo">
															<option value="" data-value="">Seleccione un país</option>
															@foreach ($paises as $pais)
															<option value="{{ $pais->nombre }}" data-value="{{ $pais->nombre }}" @if($pais->nombre === 'España') selected @endif>{{ $pais->nombre }}</option>
															@endforeach
														</select>
													</div>
												</div>
												
												<div class="col-lg-3">
													<div class="mb-3">
														<label for="ccaaNuevo" class="form-label">Comunidad autónoma</label>
														<select class="form-select" id="ccaaNuevo" name="ccaaNuevo">
															<option value="" data-value="">Seleccione una comunidad autónoma</option>
															@foreach ($ccaas as $ccaa)
															<option value="{{ $ccaa->Nombre }}" data-value="{{ $ccaa->Nombre }}">{{ $ccaa->Nombre }}</option>
															@endforeach
														</select>
													</div>
												</div>
												
												<div class="col-lg-3">
													<div class="mb-3">
														<label for="provinciaNuevo" class="form-label">Provincia</label>
														<select class="form-select" id="provinciaNuevo" name="provinciaNuevo">
															<option value="" data-value="">Seleccione una provincia</option>
															@foreach ($provincias as $provincia)
															<option value="{{ $provincia->Provincia }}" data-value="{{ $provincia->Provincia }}">{{ $provincia->Provincia }}</option>
															@endforeach
														</select>
													</div>
												</div>
												
												<div class="col-lg-3">
													<div class="mb-3">
														<label for="municipioNuevo" class="form-label">Municipio</label>
														<input type="search" class="form-control" id="municipioNuevo" name="municipioNuevo" list="municipios2" onchange="updateMunicipio2()" >
														<datalist id="municipios2">
															<option value="" data-value="">Seleccione un municipio</option>
															@foreach ($municipios as $municipio)
															<option value="{{ $municipio->Municipio }}" data-value="{{ $municipio->Municipio }}">{{ $municipio->Municipio }}</option>
															@endforeach
														</datalist>
														<input type="hidden" name="idMunicipioNuevo" id="idMunicipioNuevo" value="">
													</div>
												</div>
												
												<div class="col-lg-3">
													<div class="mb-3">
														<label for="domicilioNuevo" class="form-label">Domicilio</label>
														<input type="text" class="form-control" id="domicilioNuevo" name="domicilioNuevo" value="" autocomplete="off" spellcheck="true">
													</div>
												</div>
												
												<div class="col-lg-3">
													<div class="mb-3">
														<label for="codigoPostalNuevo" class="form-label">Código Postal</label>
														<input type="text" class="form-control" id="codigoPostalNuevo" name="codigoPostalNuevo" maxlength="5" autocomplete="off">
													</div>
												</div>
												
												<div class="col-lg-1">
													<div class="mb-3">
														<label for="numeroNuevo" class="form-label">Número</label>
														<input type="number" class="form-control" id="numeroNuevo" name="numeroNuevo" min="0" max="99999" autocomplete="off">
													</div>
												</div>
												
												<div class="col-lg-2">
													<div class="mb-3">
														<label for="pisoNuevo" class="form-label">Piso</label>
														<input type="number" class="form-control" id="pisoNuevo" min="0" max="99999" name="pisoNuevo" autocomplete="off">
													</div>
												</div>
												
												<div class="col-lg-1">
													<div class="mb-3">
														<label for="escaleraNuevo" class="form-label">Escalera</label>
														<input type="text" class="form-control" id="escaleraNuevo" name="escaleraNuevo" autocomplete="off">
													</div>
												</div>
												
												<div class="col-lg-2">
													<div class="mb-3">
														<label for="puertaNuevo" class="form-label">Puerta</label>
														<input type="text" class="form-control" id="puertaNuevo" name="puertaNuevo" autocomplete="off">
													</div>
												</div>
												
												<h3 class="h5 text-primary"><i class="align-middle" data-feather="tag"></i> <span class="align-middle">Marcas</span></h3>
												
												<div class="col-lg-12">
													<div class="mb-3">
														@foreach ($marcas as $marca)
														<div class="form-check form-check-inline">
															<input class="form-check-input marca" type="checkbox" id="inlineCheckbox{{ $marca->id }}" name="marcasNuevo[]" value="{{ $marca->id }}">
															<label class="form-check-label" for="inlineCheckbox{{ $marca->id }}">{{ $marca->nombre }}</label>
														</div>
														@endforeach
													</div>
												</div>
												
												<div class="col-lg-12">
													<div class="mb-3">
														<label for="observacionesNuevo" class="form-label">Observaciones</label>
														<textarea class="form-control" rows="3" id="observacionesNuevo" name="observacionesNuevo"></textarea>
													</div>
												</div>
												
											</div>
											
											<div class="col-lg-12 text-end">
												<button type="submit" class="btn btn-blue"><i class="align-middle" data-feather="plus"></i><span class="align-middle"> Añadir cliente</button>
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="align-middle" data-feather="corner-down-left"></i><span class="align-middle"> Volver</span></button>
											</div>
											
										</form>
										
									</div>
									
								</div>
								
							</div>
							
						</div>
						
					</div>
					
				</div>
				
			</div>
			
		</div>
	</div>
</div>																									