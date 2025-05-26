@extends('layouts.app')

@section('title', '- Detalle de modelo de vehículo')

@section('content')
    <div class="container">
        <h1><i class="mdi mdi-eye" aria-hidden="true"></i> Detalle del modelo de vehículo: {{ $modeloVehiculo->nombre }}</h1>
        <p><strong>ID:</strong> {{ $modeloVehiculo->id }}</p>
        <p><strong>Nombre:</strong> {{ $modeloVehiculo->nombre }}</p>
        <p><strong>Marca:</strong> {{ $modeloVehiculo->marcaVehiculo->nombre }}</p>
        <!-- Opciones -->
        <div class="text-right">
            <a href="{{ route('modelos_vehiculo.edit', $modeloVehiculo) }}" class="btn btn-dark"><i class="mdi mdi-pencil" aria-hidden="true"></i> Editar</a>
            <a href="{{ route('modelos_vehiculo.index') }}" class="btn btn-secondary"><i class="mdi mdi-arrow-left" aria-hidden="true"></i> Volver</a>
        </div>
    </div>
@endsection