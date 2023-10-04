@extends('dashboard')

@section('title', 'Marcas')

@section('content')

<div class="row">

    @include('marcas.agregarNuevaMarca')
    
    @include('marcas.listaMarcas')

</div>

@endsection