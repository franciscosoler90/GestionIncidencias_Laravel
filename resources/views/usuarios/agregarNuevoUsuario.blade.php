<div class="col-12 col-md-6">
	<div class="card flex-fill">
		
		<div class="card-header blue1">
			<h5 class="card-title mb-0 text-white"><i class="align-middle" data-feather="user"></i><span class="align-middle"> Añadir usuario</h5>
		</div>
		
		<div class="card-body">
			<form action="{{ route('usuarios.store') }}" method="post" autocomplete="off">
				@csrf
				
				<div class="row mb-3">

					<div class="col-lg-4">

						<div class="mb-3 form-floating">
							<input type="text" class="form-control" id="name" name="name" maxlength="50" placeholder="Nombre" autocomplete="off" required>
							<label for="name" class="form-label">Nombre</label>
						</div>

					</div>

					<div class="col-lg-4">

						<div class="mb-3 form-floating">
							<input type="email" class="form-control" id="email" name="email" autocomplete="off" required>
							<label for="email" class="form-label">Email</label>
						</div>

					</div>

					<div class="col-lg-4">

						<div class="mb-3 form-floating">
							<input type="password" class="form-control" id="password" name="password" autocomplete="off" minlength="6" required>
							<label for="password" class="form-label">Contraseña</label>
						</div>

					</div>

					<div class="col-lg-4">

						<div class="mb-3 form-floating">
							<input type="number" class="form-control" id="movil" name="movil" min=1>
							<label for="movil" class="form-label">Teléfono</label>
						</div>

					</div>

					<div class="col-lg-4">

						<div class="mb-3 form-floating">
							<input type="number" class="form-control" id="codigo" name="codigo" min=1 max=99999>
							<label for="codigo" class="form-label">Teléfono interno</label>
						</div>

					</div>
	
				</div>
				
				<div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
					<button type="submit" class="btn btn-blue"><i class="align-middle" data-feather="plus"></i><span class="align-middle"> Añadir usuario</button>
				</div>
				
			</form>
		</div>
	</div>
</div>