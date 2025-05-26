@extends('layouts.app')

@section('title', '- Agregando modelo de vehículo')

@section('content')
    <div class="container">
        <h1><i class="mdi mdi-plus" aria-hidden="true"></i> Agregando modelo de vehículo</h1>
        <form method="POST" action="{{ route('modelos_vehiculo.store') }}">
            @csrf
            <!-- Nombre -->
            <div class="form-group">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}">
                @error('nombre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Marca de vehículo -->
            <div class="form-group">
                <label for="id_marca">Marca:</label>
                <select class="form-control" name="id_marca">
                    @foreach($marcasVehiculo as $marcaVehiculo)
                        <option value="{{ $marcaVehiculo->id }}">{{ $marcaVehiculo->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Opciones -->
            <div class="text-right">
                <button class="btn btn-dark"><i class="mdi mdi-content-save" aria-hidden="true"></i> Guardar</button>
                <a href="{{ route('modelos_vehiculo.index') }}" class="btn btn-secondary"><i class="mdi mdi-cancel" aria-hidden="true"></i> Cancelar</a>
            </div>
        </form>
    </div>
@endsection