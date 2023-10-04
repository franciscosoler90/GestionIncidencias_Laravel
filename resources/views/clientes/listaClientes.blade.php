<div class="col-12">

	@if (isset($clientes))
	<div class="card flex-fill">

		<div class="card-body justify-content-center">

			@include('clientes.agregarCliente')

			<div class="table-responsive">

				<table class="table display compact table-hover table-bordered table-sm" id="tablaClientes">
					
					<thead class="sky50">
						<tr>
							<th class="small fw-bold">Código</th>
							<th class="small fw-bold">Nombre</th>
							<th class="small fw-bold">Provincia</th>
							<th class="small fw-bold">Teléfono</th>
							<th class="small fw-bold">Observaciones</th>
						</tr>
					</thead>
					
					<tbody>
						@foreach ($clientes as $cliente)
							<tr>
								<td class="small text-truncate">{{ $cliente->codigo }}</td>
								<td class="small text-truncate">{{ $cliente->nombre }}</td>
								<td class="small text-truncate">{{ $cliente->provincia }}</td>
								<td class="small text-truncate">{{ $cliente->telefono }}</td>
								<td class="small text-truncate small_column">{{ $cliente->observaciones }}</td>
							</tr>
						@endforeach
					</tbody>
					
					<tfoot class="sky50">
						<tr>
							<th class="small fw-bold">Código</th>
							<th class="small fw-bold">Nombre</th>
							<th class="small fw-bold">Provincia</th>
							<th class="small fw-bold">Teléfono</th>
							<th class="small fw-bold">Observaciones</th>
						</tr>
					</tfoot>
					
				</table>
				
			</div>
			
		</div>
	</div>

	@include('clientes.modal')

	<script src="{{ asset('js/clientes/datatableEmpleados.js') }}"></script>
	<script src="{{ asset('js/clientes/datatableClientes.js') }}"></script>

	<script>
		var currentUserName = @json(auth()->user()->name); // Obtén el nombre de usuario actual y conviértelo en JSON
	</script>

	<link rel="stylesheet" href="https://cdn.datatables.net/colreorder/1.7.0/css/colReorder.dataTables.min.css">
	<script src="https://cdn.datatables.net/colreorder/1.7.0/js/dataTables.colReorder.min.js"></script>

	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
	<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
	
	@else
		<div class="card flex-fill">
			<div class="card-header">
				<h5 class="card-title mb-0">No hay incidencias registradas.</h5>
			</div>
			<div class="card-body"></div>
		</div>
	@endif

</div>