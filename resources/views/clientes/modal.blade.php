<div class="modal fade" id="clienteModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="clienteModalLabel" aria-hidden="true">
	
    <div class="modal-dialog modal-fullscreen">
        
        <div class="modal-content sky50">
			
			<ul class="nav nav-tabs blue2">
				
				<li class="nav-item">
					<button class="nav-link active" id="tab1" data-bs-toggle="tab" data-bs-target="#tabpanel1" type="button" role="tab" aria-controls="tab1" aria-selected="false">Editar cliente</button>
				</li>
				
				<li class="nav-item">
					<button class="nav-link" id="tab2" data-bs-toggle="tab" data-bs-target="#tabpanel2" type="button" role="tab" aria-controls="tab2" aria-selected="false">Empleados</button>
				</li>
				
			</ul>
			
			<div class="tab-content" id="myTabContent">
				
				<div class="tab-pane fade show active" id="tabpanel1" role="tabpanel" aria-labelledby="tab1">
					
					@include('clientes.editarCliente')
					
				</div>
				
				<div class="tab-pane fade" id="tabpanel2" role="tabpanel" aria-labelledby="tab2">
					
					@include('clientes.agregarEmpleado')

					@include('clientes.listaEmpleados')

					@include('clientes.editarEmpleados')

				</div>
				
			</div>

		</div>

	</div>
	
</div>