@extends('layouts.app')

@section('title', '- Editando modelo de vehículo')

@section('content')
    <div class="container">
        <h1><i class="mdi mdi-pencil" aria-hidden="true"></i> Editando modelo de vehículo: {{ $modeloVehiculo->nombre }}</h1>
        <form method="POST" action="{{ route('modelos_vehiculo.update', $modeloVehiculo) }}">
            @csrf
            @method('PUT')
            <!-- ID -->
            <div class="form-group">
                <label for="id" class="form-label">ID:</label>
                <input type="text" name="id" class="form-control" value="{{ old('id', $modeloVehiculo->id) }}" readonly>
                @error('id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Nombre -->
            <div class="form-group">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $modeloVehiculo->nombre) }}">
                @error('nombre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Marca de vehículo -->
            <div class="form-group">
                <label for="id_marca">Marca de vehículo</label>
                <select class="form-control" name="id_marca">
                    @foreach($marcasVehiculo as $marcaVehiculo)
                        <option value="{{ $marcaVehiculo->id }}"
                        {{ old('id_marca', $modeloVehiculo->id_marca) == $marcaVehiculo->id ? 'selected' : '' }}>{{ $marcaVehiculo->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Opciones -->
            <div class="text-right">    
                <button class="btn btn-dark"><i class="mdi mdi-content-save-edit" aria-hidden="true"></i> Guardar</button>
                <a href="{{ route('modelos_vehiculo.index') }}" class="btn btn-secondary"><i class="mdi mdi-cancel" aria-hidden="true"></i> Cancelar</a>
            </div>
        </form>
    </div>
@endsection