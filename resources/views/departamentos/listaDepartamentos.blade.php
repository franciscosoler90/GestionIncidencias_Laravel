<div class="col-12 col-md-6">

    @if (isset($departamentos))
	<div class="card flex-fill">
		
		<div class="card-header blue1">
			<h5 class="card-title mb-0 text-white"><i class="align-middle" data-feather="layers"></i><span class="align-middle"> Departamentos</h5>
		</div>
		
		<div class="card-body">

            <table class="table table-hover compact table-sm" id="tablaDepartamentos">
                            
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                    </tr>
                </thead>
                            
                <tbody>
                    @foreach ($departamentos as $departamento)
                        <tr>
                            <td>{{ $departamento->id }}</td>
                            <td>{{ $departamento->nombre }}</td>
                        </tr>
                    @endforeach
                </tbody>
                            
            </table>

		</div>

	</div>

    @include('departamentos.editarDepartamento')

    <script src="{{ asset('js/departamentos/datatableDepartamentos.js') }}"></script>

	@else
	<div class="card flex-fill">
		<div class="card-header blue1">
			<h5 class="card-title mb-0 text-white">No hay departamentos registrados.</h5>
		</div>
		<div class="card-body"></div>
	</div>
	@endif

</div>