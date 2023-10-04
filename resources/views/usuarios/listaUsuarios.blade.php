<div class="col-12 col-md-6">

    @if (isset($usuarios))
	<div class="card flex-fill">
		
		<div class="card-header blue1">
			<h5 class="card-title mb-0 text-white"><i class="align-middle" data-feather="users"></i><span class="align-middle"> Usuarios</h5>
		</div>
		
		<div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover compact table-sm" id="tablaUsuarios">
                
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Teléfono interno</th>
                        </tr>
                    </thead>
                                
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->id }}</td>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->movil }}</td>
                                <td>{{ $usuario->codigo }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                                
                </table>

            </div>

		</div>

	</div>

    @include('usuarios.editarUsuario')
    @include('usuarios.cambiarContraseña')

    <script>
        var usuarioActualID = "{{ auth()->user()->id }}";
    </script>

    <script src="{{ asset('js/usuarios/datatableUsuarios.js') }}"></script>

	@else
	<div class="card flex-fill">
		<div class="card-header blue1">
			<h5 class="card-title mb-0 text-white">No hay usuarios registrados.</h5>
		</div>
		<div class="card-body"></div>
	</div>
	@endif

</div>