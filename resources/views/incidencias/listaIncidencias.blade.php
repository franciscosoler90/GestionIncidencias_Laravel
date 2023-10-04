<div class="col-12">

		<div class="card flex-fill">

			<div class="card-body">

				<ul class="list-group list-group-horizontal mb-2">

					<li class="list-group-item flex-fill sky50">						
						<p class="mb-0"><small>Filtrar por estados</small></p>
						<div id="filtros" class="btn-group btn-group-sm flex-wrap" role="group">
							@foreach ($estados as $key => $estado)
								<div class="form-check form-check-inline">
									<input class="form-check-input switch-estado" type="checkbox" id="switch{{ $estado->id }}" @if($key === 0) checked @endif>
									<label class="form-check-label" for="switch{{ $estado->id }}">{{ $estado->nombre }}</label>
								</div>
							@endforeach
						</div>
					</li>
						
					<li class="list-group-item flex-fill sky100">						
						<p class="mb-0"><small>Filtrar por áreas</small></p>
						<div id="filtros3" class="btn-group btn-group-sm flex-wrap" role="group">
							@foreach ($areas as $area)
								<div class="form-check form-check-inline">
									<input class="form-check-input btn-area" type="checkbox" value="" id="btn{{ $area->nombre }}" data-estado="{{ $area->nombre }}" data-id="{{ $area->id }}">
									<label class="form-check-label" for="btn{{ $area->nombre }}">{{ $area->nombre }}</label>
								</div>
							@endforeach
						</div>
					</li>

				</ul>

				@if (isset($incidencias))
				
					<div class="table-responsive">
						
						<table class="table display compact table-hover table-bordered table-sm" id="tablaIncidencias">
							
							<thead class="cabeceraTabla">
								<tr>
									<th class="small fw-bold">N°</th>
									<th class="small fw-bold">Título</th>
									<th class="small fw-bold">Usuario</th>
									<th class="small fw-bold">Departamento</th>
									<th class="small fw-bold">Cliente</th>
									<th class="small fw-bold">Empleado</th>
									<th class="small fw-bold">F. Creación</th>
									<th class="small fw-bold">F. Actualización</th>
									<th class="small fw-bold">Prioridad</th>
									<th class="small fw-bold">Estado</th>
									<th class="small fw-bold">Areas</th>
								</tr>
							</thead>
							
							<tbody>
								@foreach ($incidencias as $incidencia)
									<tr @if ($incidencia->prioridad->nombre == 'Alta') class="text-bg-red" @endif>
										<td class="small text-truncate small_column3">{{ $incidencia->id  }}</td>
										<td class="small text-truncate">{{ $incidencia->titulo }}</td>
										<td class="small text-truncate small_column2">{{ $incidencia->usuario->name }}</td>
										<td class="small text-truncate">{{ $incidencia->departamento->nombre }}</td>
										<td class="small text-truncate small_column">{{ $incidencia->cliente->nombre }}</td>
										<td class="small text-truncate small_column2">{{ $incidencia->empleado->nombre }}</td>
										<td class="small text-truncate">{{ $incidencia->fechaCreacion }}</td>
										<td class="small text-truncate">{{ $incidencia->fechaActualizacion }}</td>
										<td class="small text-truncate small_column2">{{ $incidencia->prioridad->nombre }}</td>
										<td class="small text-truncate small_column2">{{ $incidencia->estado->id }}. {{ $incidencia->estado->nombre }}</td>
										<td class="small text-truncate">
											@foreach ($incidencia->areas as $area)
												{{ $area->nombre }}<br>
											@endforeach
										</td>
									</tr>
								@endforeach
							</tbody>

							<tfoot class="cabeceraTabla">
								<tr>
									<th class="small fw-bold">N°</th>
									<th class="small fw-bold">Título</th>
									<th class="small fw-bold">Usuario</th>
									<th class="small fw-bold">Departamento</th>
									<th class="small fw-bold">Cliente</th>
									<th class="small fw-bold">Empleado</th>
									<th class="small fw-bold">F. Creación</th>
									<th class="small fw-bold">F. Actualización</th>
									<th class="small fw-bold">Prioridad</th>
									<th class="small fw-bold">Estado</th>
									<th class="small fw-bold">Areas</th>
								</tr>
							</tfoot>

						</table>

					</div>

					@include('incidencias.modal')
					@include('incidencias.modal2')
					@include('incidencias.modal3')

					<link rel="stylesheet" href="https://cdn.datatables.net/colreorder/1.7.0/css/colReorder.dataTables.min.css">
					<script src="https://cdn.datatables.net/colreorder/1.7.0/js/dataTables.colReorder.min.js"></script>

					<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
					<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>

					<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
					<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

					<script>
						var urlEmpleadosIndex = '{{ route("empleados.index", ":idCliente") }}';

						var currentUserName = @json(auth()->user()->name); // Obtén el nombre de usuario actual y conviértelo en JSON

						$(document).ready(function() {

							// Filtrar por estado "Pendiente" al inicializar la tabla
							table.column(9).search('Pendiente', true, false).draw();

							var areasUsuarioConectado = <?php echo json_encode(Auth::user()->areas->pluck('nombre')->toArray()); ?>;

							areasUsuarioConectado.forEach(function(area) {
								var boton = $(".btn-area[data-estado='" + area + "']");
								boton.prop("checked", true);
							});


							//AREAS
							var filters = [];

							$('.btn-area').on('click', function () {
								filters = [];

								$('.btn-area:checked').each(function () {
									var areaNombre = $(this).data('estado');
									filters.push(areaNombre);
								});

								if (filters.length > 0) {
									var regex = filters.join('|');
									table.column(10).search(regex, true, false).draw();
								} else {
									table.column(10).search('noexistentvalue').draw();
								}
							});

						});
					</script>

					<script src="{{ asset('js/incidencias/infoCliente.js') }}"></script>

					<script src="{{ asset('js/incidencias/incidencias.js') }}"></script>

					<script src="{{ asset('js/incidencias/datatableIncidencias.js') }}"></script>

				@else

					<h5 class="card-title mb-0">No hay incidencias registradas.</h5>

				@endif

			</div>

		</div>

</div>