<div class="modal fade" id="editarModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
	
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
		
		<div class="modal-content">
			
			<div class="modal-header blue1">
				<h5 class="modal-title text-white" id="editarModalLabel"></h5>
				<button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			
			<!-- Formulario para editar marca -->
			<form action="" method="post" autocomplete="off">
				
				@csrf
				@method('PUT')
				
				<div class="modal-body">
					
					<div class="row mb-3">
						
						<div class="col-12 col-md-12">

                            <div class="col-12 col-md-12 mb-3 form-floating">
							    <input type="text" class="form-control" id="nombreModal" name="nombreModal" maxlength="50" placeholder="Nombre" required>
							    <label for="nombreModal" class="form-label">Nombre</label>
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