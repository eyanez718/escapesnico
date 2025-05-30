@extends('layouts.app')

@section('title', '- Detalle del material')

@section('content')
    <div class="container">
        <h1><i class="mdi mdi-eye" aria-hidden="true"></i> Detalle del insumo: {{ $material->nombre }}</h1>
        <p><strong>ID:</strong> {{ $material->id }}</p>
        <p><strong>Código:</strong> {{ $material->codigo }}</p>
        <p><strong>Descripción:</strong> {{ $material->descripcion }}</p>
        <p><strong>Tipo de uso:</strong> {{ $material->tipoUso->nombre }}</p>
        <p><strong>Tipo de vehículo:</strong> {{ $material->tipoVehiculo->nombre }}</p>
        <p><strong>Marca de vehículo:</strong> {{ $material->marcaVehiculo->nombre }}</p>
        <p><strong>Modelo de vehículo:</strong> {{ $material->modeloVehiculo->nombre }}</p>
        <p><strong>Cantidad:</strong> {{ $material->cantidad }}</p>
        <p><strong>Costo unitario:</strong> $ {{ $material->costo_unitario_formatted }}</p>
        <p><strong>Costo total:</strong> $ {{ $material->costoTotal() }}</p>
        <!-- Opciones -->
        <div class="text-right">
            <a href="{{ route('materiales.edit', $material) }}" class="btn btn-dark"><i class="mdi mdi-pencil" aria-hidden="true"></i> Editar</a>
            <a href="{{ route('materiales.index') }}" class="btn btn-secondary"><i class="mdi mdi-arrow-left" aria-hidden="true"></i> Volver</a>
        </div>
    </div>
@endsection