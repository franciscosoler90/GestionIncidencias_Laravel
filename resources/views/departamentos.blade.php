@extends('dashboard')

@section('title', 'Departamentos')

@section('content')

    <div class="row">

        @include('departamentos.agregarNuevoDepartamento')
        
        @include('departamentos.listaDepartamentos')

    </div>

@endsection