<div class="modal-body sky50">
	
	<div class="container-fluid">
		
		<div class="container">
			
			<div class="row">
				
				<div class="col-lg-12">
					
					<div class="card">
						
						<div class="card-body">
							
							<form action="{{ route('empleados.store') }}" method="post" id="agregarEmpleadoForm" autocomplete="off">
								@csrf
								
								<input type="hidden" name="idCliente" id="idClienteEmpleado" value="">
								
								<h3 class="h5 text-primary"><i class="align-middle" data-feather="user"></i> <span class="align-middle">Añadir empleado</span></h3>
								
								<div class="row">
									
									<div class="col-lg-4">
										
										<div class="mb-3">
											<label for="nombre2" class="form-label">Nombre *</label>
											<input type="text" class="form-control" id="nombre2" name="nombre" maxlength="50" placeholder="Nombre" autocomplete="off" required>
										</div>
										
									</div>
									
									<div class="col-lg-4">
										
										<div class="mb-3">
											<label for="cargo" class="form-label">Cargo</label>
											<input type="text" class="form-control" id="cargo" name="cargo" maxlength="50" placeholder="Cargo" autocomplete="off">
										</div>
										
									</div>
									
									<div class="col-lg-4">
										
										<div class="mb-3">
											<label for="telefonoFijo" class="form-label">Teléfono fijo</label>
											<input type="text" class="form-control" id="telefonoFijo" name="telefonoFijo" placeholder="Teléfono fijo" autocomplete="off">
										</div>
										
									</div>
									
									<div class="col-lg-4">
										
										<div class="mb-3">
											<label for="telefonoMovil" class="form-label">Teléfono móvil</label>
											<input type="text" class="form-control" id="telefonoMovil" name="telefonoMovil" placeholder="Teléfono móvil" autocomplete="off">
										</div>
										
									</div>
									
									<div class="col-lg-4">
										
										<div class="mb-3">
											<label for="correoEmpresa" class="form-label">Correo empresa</label>
											<input type="email" class="form-control" id="correoEmpresa" name="correoEmpresa" placeholder="Correo empresa" autocomplete="off">
										</div>
										
									</div>
									
									<div class="col-lg-4">					
										
										<div class="mb-3">
											<label for="correoPersonal" class="form-label">Correo personal</label>
											<input type="email" class="form-control" id="correoPersonal" name="correoPersonal" placeholder="Correo personal" autocomplete="off">
										</div>
										
									</div>
									
									<div class="text-end">
										
										<button type="submit" class="btn btn-blue"><i class="align-middle" data-feather="plus"></i><span class="align-middle"> Añadir empleado</button>
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="align-middle" data-feather="corner-down-left"></i><span class="align-middle"> Volver</span></button>
										</div>
										
									</div>
									
							</form>
								
						</div>
							
					</div>
						
				</div>
					
			</div>
				
		</div>
			
	</div>
		
</div>
	
<script src="{{ asset('js/clientes/agregarEmpleado.js') }}"></script>																			