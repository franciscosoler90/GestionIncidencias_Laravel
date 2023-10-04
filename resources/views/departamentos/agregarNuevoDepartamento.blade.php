<div class="col-12 col-md-6">
	<div class="card flex-fill">
		
		<div class="card-header blue1">
			<h5 class="card-title mb-0 text-white"><i class="align-middle" data-feather="layers"></i><span class="align-middle"> Añadir departamento</h5>
		</div>
		
		<div class="card-body">
			<form action="{{ route('departamentos.store') }}" method="post" autocomplete="off">
				@csrf
				
				<div class="row mb-3">
					
					<div class="col-12 col-md-12">
						
                        <div class="col-12 col-md-12 mb-3 form-floating">
							<input type="text" class="form-control" id="nombre" name="nombre" maxlength="50" placeholder="Nombre" required>
							<label for="nombre" class="form-label">Nombre</label>
						</div>
						
					</div>
						
				</div>
				
				<div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
					<button type="submit" class="btn btn-blue"><i class="align-middle" data-feather="plus"></i><span class="align-middle"> Añadir departamento</button>
				</div>
				
			</form>
		</div>
	</div>
</div>