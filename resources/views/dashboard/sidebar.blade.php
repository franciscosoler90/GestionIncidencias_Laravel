<nav id="sidebar" class="sidebar js-sidebar blue1">
	
	<div class="sidebar-content js-simplebar">
		
		<div class="sidebar-brand">

			<img src="{{ asset('img/logo2.png') }}" class="avatar img-fluid rounded me-1" alt="usuarioImagen">
			<span class="align-middle umbra h1 text-white">ACK</span>
			
		</div>
		
		<div class="sidebar-user">

			<div class="d-flex justify-content-center">
				
				<div class="flex-shrink-0">
					<img src="{{ asset('img/avatar.png') }}" class="avatar img-fluid rounded me-1" alt="usuarioImagen">
				</div>
				
				<div class="flex-grow-1 ps-2">
					
					<a class="sidebar-user-title dropdown-toggle" href="#" data-bs-toggle="dropdown">
						{{ Auth::user()->name }}
					</a>
					
					<div class="dropdown-menu dropdown-menu-start">
						
						<form action="{{ route('logout') }}" method="POST" id="logout-form">
							
							@csrf
							<div class="list-group">
								<button type="submit" class="list-group-item list-group-item-action">Cerrar sesión</button>
							</div>
							
						</form>
						
					</div>
					
				</div>

			</div>

		</div>
		
		<ul class="sidebar-nav">

			<li class="sidebar-item {{ $currentRoute == 'incidencias' ? ' active' : '' }}">
				<a class="sidebar-link" href="{{ route('incidencias') }}">
					<i class="align-middle" data-feather="list"></i> <span class="align-middle">Incidencias</span>
				</a>
			</li>
			
			<li class="sidebar-item">
				
				<a data-bs-toggle="collapse" href="#configuracion" class="sidebar-link collapsed" aria-expanded="false">
					<i class="align-middle" data-feather="settings"></i> <span class="align-middle">Maestros<i class="align-middle ms-6" data-feather="chevron-down"></i></span>
				</a>
				
				<ul id="configuracion" class="sidebar-dropdown list-unstyled {{ $currentRoute == 'clientes' || $currentRoute == 'marcas' || $currentRoute == 'departamentos' || $currentRoute == 'usuarios' || $currentRoute == 'estados' ? ' show' : ' collapse' }}" data-bs-parent="#sidebar">
					
					<li class="sidebar-item {{ $currentRoute == 'clientes' ? ' active' : '' }}">
						<a class="sidebar-link" href="{{ route('clientes') }}">
							<i class="align-middle" data-feather="users"></i> <span class="align-middle">Clientes</span>
						</a>
					</li>
					
					<li class="sidebar-item {{ $currentRoute == 'marcas' ? ' active' : '' }}">
						<a class="sidebar-link" href="{{ route('marcas') }}">
							<i class="align-middle" data-feather="tag"></i> <span class="align-middle">Marcas</span>
						</a>
					</li>

					<li class="sidebar-item {{ $currentRoute == 'departamentos' ? ' active' : '' }}">
						<a class="sidebar-link" href="{{ route('departamentos') }}">
							<i class="align-middle" data-feather="layers"></i> <span class="align-middle">Departamentos</span>
						</a>
					</li>

					<li class="sidebar-item {{ $currentRoute == 'usuarios' ? ' active' : '' }}">
						<a class="sidebar-link" href="{{ route('usuarios') }}">
							<i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Usuarios</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('estados') }}">
							<i class="align-middle" data-feather="zap"></i> <span class="align-middle">Estados</span>
						</a>
					</li>
					
				</ul>
				
			</li>
			
		</ul>
				
	</div>
	
</nav>										