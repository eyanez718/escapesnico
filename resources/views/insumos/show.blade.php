@extends('layouts.app')

@section('title', '- Detalle del insumo')

@section('content')
    <div class="container">
        <h1><i class="mdi mdi-eye" aria-hidden="true"></i> Detalle del insumo: {{ $insumo->nombre }}</h1>
        <p><strong>ID:</strong> {{ $insumo->id }}</p>
        <p><strong>Código:</strong> {{ $insumo->codigo }}</p>
        <p><strong>Descripción:</strong> {{ $insumo->descripcion }}</p>
        <p><strong>Tipo de uso:</strong> {{ $insumo->tipoUso->nombre }}</p>
        <p><strong>Tipo de vehículo:</strong> {{ $insumo->tipoVehiculo->nombre }}</p>
        <p><strong>Cantidad:</strong> {{ $insumo->cantidad }}</p>
        <p><strong>Costo unitario:</strong> $ {{ $insumo->costo_unitario }}</p>
        <p><strong>Costo total:</strong> $ {{ $insumo->costoTotal() }}</p>
        <!-- Opciones -->
        <div class="text-right">
            <a href="{{ route('insumos.edit', $insumo) }}" class="btn btn-dark"><i class="mdi mdi-pencil" aria-hidden="true"></i> Editar</a>
            <a href="{{ route('insumos.index') }}" class="btn btn-secondary"><i class="mdi mdi-arrow-left" aria-hidden="true"></i> Volver</a>
        </div>
    </div>
@endsection