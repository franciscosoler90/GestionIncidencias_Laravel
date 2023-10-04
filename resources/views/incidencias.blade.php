@extends('dashboard')

@section('title', 'Incidencias')

@section('content')

	<div class="row contenedor">

		@include('incidencias.listaIncidencias')

	</div>

	<script src="https://cdn.tiny.cloud/1/9spi47keh4acenm0mpex0ukvbrm4cejj0391p6di9con7ptj/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

	<script src="{{ asset('js/incidencias/tinymce.js') }}"></script>		
	
@endsection