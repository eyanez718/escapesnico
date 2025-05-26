@extends('layouts.app')

@section('title', '- Detalle de marca de vehículo')

@section('content')
    <div class="container">
        <h1><i class="mdi mdi-eye" aria-hidden="true"></i> Detalle de la marca de vehículo: {{ $marcaVehiculo->nombre }}</h1>
        <p><strong>ID:</strong> {{ $marcaVehiculo->id }}</p>
        <p><strong>Nombre:</strong> {{ $marcaVehiculo->nombre }}</p>
        <!-- Opciones -->
        <div class="text-right">
            <a href="{{ route('marcas_vehiculo.edit', $marcaVehiculo) }}" class="btn btn-dark"><i class="mdi mdi-pencil" aria-hidden="true"></i> Editar</a>
            <a href="{{ route('marcas_vehiculo.index') }}" class="btn btn-secondary"><i class="mdi mdi-arrow-left" aria-hidden="true"></i> Volver</a>
        </div>
    </div>
@endsection