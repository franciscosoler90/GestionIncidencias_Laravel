@extends('dashboard')

@section('title', 'Clientes')

@section('content')

	<div class="row">

		@include('clientes.listaClientes')

	</div>

@endsection