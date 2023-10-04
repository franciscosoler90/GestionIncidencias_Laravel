<div class="col-12 col-md-6">

    @if (isset($estados))
	<div class="card flex-fill">
		
		<div class="card-header blue1">
			<h5 class="card-title mb-0 text-white"><i class="align-middle" data-feather="zap"></i><span class="align-middle"> Estados</h5>
		</div>
		
		<div class="card-body">

            <table class="table table-hover compact table-sm" id="tablaEstados">
                            
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                    </tr>
                </thead>
                            
                <tbody>
                    @foreach ($estados as $estado)
                        <tr>
                            <td>{{ $estado->id }}</td>
                            <td>{{ $estado->nombre }}</td>
                        </tr>
                    @endforeach
                </tbody>
                            
            </table>

		</div>

	</div>

    @include('estados.editarEstado')

    <script src="{{ asset('js/estados/datatableEstados.js') }}"></script>

	@else
        <div class="card flex-fill">
            <div class="card-header blue1">
                <h5 class="card-title mb-0 text-white">No hay estados registrados.</h5>
            </div>
            <div class="card-body"></div>
        </div>
	@endif

</div>