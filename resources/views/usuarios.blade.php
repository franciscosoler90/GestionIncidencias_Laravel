@extends('dashboard')

@section('title', 'Usuarios')

@section('content')

<div class="row">

    @include('usuarios.agregarNuevoUsuario')
    
    @include('usuarios.listaUsuarios')

</div>

@endsection