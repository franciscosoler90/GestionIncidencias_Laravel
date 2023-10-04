<nav class="navbar navbar-expand blue2">
	
	<a class="sidebar-toggle js-sidebar-toggle text-white">
		<i class="hamburger align-self-center"></i>
	</a>
	
	<h5 class="text-white">
		<span class="align-middle">
			@if($currentRoute == 'incidencias')
				Incidencias
			@elseif($currentRoute == 'clientes')
				Clientes
			@elseif($currentRoute == 'marcas')
				Marcas
			@elseif($currentRoute == 'departamentos')
				Departamentos
			@elseif($currentRoute == 'usuarios')
				Usuarios
			@elseif($currentRoute == 'estados')
				Estados
			@else
				
			@endif
		</span>
	</h5>

	<div class="navbar-collapse collapse">
		
		<ul class="navbar-nav navbar-align">
						
			<li class="nav-item dropdown">
				<a class="nav-icon pe-md-0 dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
					<img src="{{ asset('img/avatar.png') }}" class="avatar img-fluid rounded" alt="usuarioImagen">
				</a>
				<div class="dropdown-menu dropdown-menu-end">
					
					<a class="dropdown-item" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user align-middle me-1"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> {{ Auth::user()->name }}</a>
					
					<div class="dropdown-divider"></div>
					
					<form action="{{ route('logout') }}" method="POST" id="logout-form2">
						@csrf
						<div class="list-group">
							<button type="submit" class="list-group-item list-group-item-action">Cerrar sesión</button>
						</div>
					</form>

				</div>
				
			</li>
			
		</ul>
        
	</div>
	
</nav>					