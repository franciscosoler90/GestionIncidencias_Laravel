<div class="col-12 col-md-6">

    @if (isset($marcas))
	<div class="card flex-fill">
		
		<div class="card-header blue1">
			<h5 class="card-title mb-0 text-white"><i class="align-middle" data-feather="tag"></i><span class="align-middle"> Marcas</h5>
		</div>
		
		<div class="card-body">

            <table class="table table-hover compact table-sm" id="tablaMarcas">
                            
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                    </tr>
                </thead>
                            
                <tbody>
                    @foreach ($marcas as $marca)
                        <tr>
                            <td>{{ $marca->id }}</td>
                            <td>{{ $marca->nombre }}</td>
                        </tr>
                    @endforeach
                </tbody>
                            
            </table>

		</div>

	</div>

    @include('marcas.editarMarca')

    <script src="{{ asset('js/marcas/datatableMarcas.js') }}"></script>

	@else
	<div class="card flex-fill">
		<div class="card-header blue1">
			<h5 class="card-title mb-0 text-white">No hay marcas registradas.</h5>
		</div>
		<div class="card-body"></div>
	</div>
	@endif

</div>