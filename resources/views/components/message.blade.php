<li class="d-flex justify-content-between mb-4">
	<div class="card">
		<div class="card-header d-flex justify-content-between p-3">
			<p class="fw-bold mb-0">{{ $linea->nombreUsuario }}</p>
			<p class="text-muted small mb-0"><i class="far fa-clock"></i> {{ $linea->fecha->diffForHumans() }}</p>
		</div>
		<div class="card-body">
			<p class="mb-0">
				{{ $linea->mensaje }}
			</p>
		</div>
	</div>
</li>