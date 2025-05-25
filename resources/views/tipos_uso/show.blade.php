@extends('layouts.app')

@section('title', '- Detalle del tipo de uso')

@section('content')
    <div class="container">
        <h1><i class="mdi mdi-eye" aria-hidden="true"></i> Detalle del tipo de uso: {{ $tipoUso->nombre }}</h1>
        <p><strong>ID:</strong> {{ $tipoUso->id }}</p>
        <p><strong>Nombre:</strong> {{ $tipoUso->nombre }}</p>
        <!-- Opciones -->
        <div class="text-right">
            <a href="{{ route('tipos_uso.edit', $tipoUso) }}" class="btn btn-dark"><i class="mdi mdi-pencil" aria-hidden="true"></i> Editar</a>
            <a href="{{ route('tipos_uso.index') }}" class="btn btn-secondary"><i class="mdi mdi-arrow-left" aria-hidden="true"></i> Volver</a>
        </div>
    </div>
@endsection