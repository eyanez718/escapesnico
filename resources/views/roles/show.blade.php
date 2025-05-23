@extends('layouts.app')

@section('title', '- Detalle de rol')

@section('content')
    <div class="container">
        <h1><i class="mdi mdi-eye" aria-hidden="true"></i> Detalle del rol: {{ $rol->nombre }}</h1>
        <p><strong>ID:</strong> {{ $rol->id }}</p>
        <p><strong>Nombre:</strong> {{ $rol->nombre }}</p>
        <p><strong>Descripción:</strong> {{ $rol->descripcion }}</p>
        <!-- Opciones -->
        <div class="text-right">
            <a href="{{ route('roles.edit', $rol) }}" class="btn btn-dark"><i class="mdi mdi-pencil" aria-hidden="true"></i> Editar</a>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary"><i class="mdi mdi-arrow-left" aria-hidden="true"></i> Volver</a>
        </div>
    </div>
@endsection