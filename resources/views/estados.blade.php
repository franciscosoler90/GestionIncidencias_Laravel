@extends('dashboard')

@section('title', 'Estados')

@section('content')

    <div class="row">

        @include('estados.agregarNuevoEstado')
    
        @include('estados.listaEstados')

    </div>

@endsection