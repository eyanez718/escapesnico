@extends('layouts.app')

@section('title', '- Detalle de máquina')

@section('content')
    <div class="container">
        <h1><i class="mdi mdi-eye" aria-hidden="true"></i> Detalle del rol: {{ $maquina->nombre }}</h1>
        <p><strong>ID:</strong> {{ $maquina->id }}</p>
        <p><strong>Nombre:</strong> {{ $maquina->nombre }}</p>
        <p><strong>Descripción:</strong> {{ $maquina->descripcion }}</p>
        <p><strong>Usa combustible:</strong> @if ($maquina->usa_combustible) Sí @else No @endif</p>
        <!-- Opciones -->
        <div class="text-right">
            <a href="{{ route('maquinas.edit', $maquina) }}" class="btn btn-dark"><i class="mdi mdi-pencil" aria-hidden="true"></i> Editar</a>
            <a href="{{ route('maquinas.index') }}" class="btn btn-secondary"><i class="mdi mdi-arrow-left" aria-hidden="true"></i> Volver</a>
        </div>
    </div>
@endsection