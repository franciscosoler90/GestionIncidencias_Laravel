<div class="modal fade" id="editarModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
	
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
		
		<div class="modal-content">
			
			<div class="modal-header blue1">
				<h5 class="modal-title text-white">Editar usuario</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			
			<form action="" method="post" autocomplete="off">
				
				@csrf
				@method('PUT')
				
				<div class="modal-body">

					<div class="row mb-3">

						<div class="col-lg-3">

							<div class="mb-3 form-floating">
								<input type="text" class="form-control" id="nombreModal" name="name" maxlength="50" placeholder="Nombre" autocomplete="off" required>
							    <label for="nombreModal" class="form-label">Nombre</label>
							</div>

						</div>

						<div class="col-lg-3">

							<div class="mb-3 form-floating">
								<input type="email" class="form-control" id="emailModal" name="email" autocomplete="off" required>
								<label for="emailModal" class="form-label">Email</label>
							</div>

						</div>

						<div class="col-lg-3">

							<div class="mb-3 form-floating">
								<input type="number" class="form-control" id="movilModal" name="movil" min=1>
								<label for="movilModal" class="form-label">Teléfono</label>
							</div>

						</div>

						<div class="col-lg-3">

							<div class="mb-3 form-floating">
								<input type="number" class="form-control" id="codigoModal" name="codigo" min=1 max=99999>
								<label for="codigoModal" class="form-label">Teléfono interno</label>
							</div>

						</div>
		
					</div>

				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-blue" data-bs-toggle="modal" data-bs-target="#editarModal2" id="btnCambiarContraseña">Cambiar contraseña</button>
					<button type="submit" class="btn btn-blue">Guardar cambios</button>
				</div>

			</form>

			<!-- Formulario para borrar usuario -->
			<form action="" method="post" autocomplete="off">
				
				@csrf
				@method('DELETE')
				
				<div class="modal-footer">
                    <button type="submit" class="btn btn-blue">Borrar usuario</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
				</div>
				
			</form>

		</div>
	</div>
</div>