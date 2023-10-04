<div class="modal fade" id="editarModal2" data-bs-backdrop="static" tabindex="-1" aria-labelledby="editarModalLabel2" aria-hidden="true">
	
	<div class="modal-dialog modal-dialog-centered">
		
		<div class="modal-content">
			
			<div class="modal-header blue1">
				<h5 class="modal-title text-white">Cambiar contraseña</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			
			<form action="" method="post" autocomplete="off">
				
				@csrf

				<div class="modal-body">

					<div class="row mb-3">

						<div class="col-lg-12">

							<div class="mb-3 form-floating">
								<input type="password" class="form-control" id="password1" name="current_password" autocomplete="off" required>
							    <label for="password1" class="form-label">Contraseña actual</label>
							</div>

						</div>

						<div class="col-lg-12">

							<div class="mb-3 form-floating">
								<input type="password" class="form-control" id="password2" name="new_password" minlength="6" autocomplete="off" required>
								<label for="password2" class="form-label">Nueva contraseña</label>
							</div>

						</div>

                        <div class="col-lg-12">

                            <div class="mb-3 form-floating">
                                <input type="password" class="form-control" id="password3" name="confirm_password" minlength="6" autocomplete="off" required>
                                <label for="password3" class="form-label">Vuelve a introducir la contraseña</label>
                            </div>

                        </div>

					</div>

				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-blue">Guardar cambios</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
				</div>

			</form>

		</div>
	</div>
</div>