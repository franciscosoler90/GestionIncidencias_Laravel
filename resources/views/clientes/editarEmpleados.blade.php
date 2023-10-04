<div class="modal fade" id="empleadoModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="empleadoModalLabel" aria-hidden="true">
	
    <div class="modal-dialog modal-dialog-centered modal-xl">
        
        <div class="modal-content">

			<div class="modal-header blue1">
				
                <h5 class="modal-title text-white">Editar empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				
			</div>

			<form id="editarEmpleadosForm" action="" method="post" autocomplete="off">
				@csrf
				@method('PUT')
				
				<div class="modal-body sky100">
					
					<div class="container-fluid">
						
						<div class="container">
							
							<div class="row mb-3">

								<div class="col-lg-4">

									<div class="mb-3 form-floating">
										<input type="text" class="form-control" id="nombreEmpleado" name="nombre" maxlength="50" placeholder="Nombre" required>
										<label for="nombre2" class="form-label">Nombre</label>
									</div>

								</div>

								<div class="col-lg-4">
									
									<div class="mb-3 form-floating">
										<input type="text" class="form-control" id="cargo2" name="cargo" maxlength="50" placeholder="Cargo">
										<label for="cargo2" class="form-label">Cargo</label>
									</div>
									
								</div>

								<div class="col-lg-4">
															
									<div class="mb-3 form-floating">
										<input type="text" class="form-control" id="telefonoFijo2" name="telefonoFijo" placeholder="Teléfono fijo">
										<label for="telefonoFijo2" class="form-label">Teléfono fijo</label>
									</div>

								</div>

								<div class="col-lg-4">
									
									<div class="mb-3 form-floating">
										<input type="text" class="form-control" id="telefonoMovil2" name="telefonoMovil" placeholder="Teléfono móvil">
										<label for="telefonoMovil2" class="form-label">Teléfono móvil</label>
									</div>
									
								</div>
								
								<div class="col-lg-4">

									<div class="mb-3 form-floating">
										<input type="email" class="form-control" id="correoEmpresa2" name="correoEmpresa" placeholder="Correo empresa">
										<label for="correoEmpresa2" class="form-label">Correo empresa</label>
									</div>

								</div>

								<div class="col-lg-4">					
									
									<div class="mb-3 form-floating">
										<input type="email" class="form-control" id="correoPersonal2" name="correoPersonal" placeholder="Correo personal">
										<label for="correoPersonal2" class="form-label">Correo personal</label>
									</div>
									
								</div>

							</div>
							
						</div>
						
					</div>
					
				</div>
				
				<div class="modal-footer blue3">
					<button type="submit" class="btn btn-blue"><i class="align-middle" data-feather="save"></i><span class="align-middle"> Guardar cambios</button>
					<button type="button" class="btn btn-blue" data-bs-dismiss="modal"><i class="align-middle" data-feather="corner-down-left"></i><span class="align-middle"> Volver</button>
				</div>
				
			</form>
			
		</div>

	</div>
	
</div>