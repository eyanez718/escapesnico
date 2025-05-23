@extends('layouts.app')

@section('title', '- Detalle del usuario')

@section('content')
    <div class="container">
        <h1>Detalle del usuario: {{ $usuario->nombre }}</h1>
        <p><strong>ID:</strong> {{ $usuario->id }}</p>
        <p><strong>Nombre de usuario:</strong> {{ $usuario->nombre_completo }}</p>
        <p><strong>Email:</strong> {{ $usuario->email }}</p>
        <p><strong>Rol:</strong> {{ $usuario->rol->nombre }}</p>
        <!-- Opciones -->
        <div class="text-right">
            <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-dark"><i class="mdi mdi-pencil" aria-hidden="true"></i> Editar</a>
            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary"><i class="mdi mdi-arrow-left" aria-hidden="true"></i> Volver</a>
        </div>
    </div>
@endsection