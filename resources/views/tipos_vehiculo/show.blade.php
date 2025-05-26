@extends('layouts.app')

@section('title', '- Detalle del tipo de vehículo')

@section('content')
    <div class="container">
        <h1><i class="mdi mdi-eye" aria-hidden="true"></i> Detalle del tipo de vehículo: {{ $tipoVehiculo->nombre }}</h1>
        <p><strong>ID:</strong> {{ $tipoVehiculo->id }}</p>
        <p><strong>Nombre:</strong> {{ $tipoVehiculo->nombre }}</p>
        <!-- Opciones -->
        <div class="text-right">
            <a href="{{ route('tipos_vehiculo.edit', $tipoVehiculo) }}" class="btn btn-dark"><i class="mdi mdi-pencil" aria-hidden="true"></i> Editar</a>
            <a href="{{ route('tipos_vehiculo.index') }}" class="btn btn-secondary"><i class="mdi mdi-arrow-left" aria-hidden="true"></i> Volver</a>
        </div>
    </div>
@endsection