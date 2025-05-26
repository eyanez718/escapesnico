@extends('layouts.app')

@section('title', '- Agregando insumo')

@section('content')
    <div class="container">
        <h1><i class="mdi mdi-plus" aria-hidden="true"></i> Agregando insumo</h1>
        <form method="POST" action="{{ route('insumos.store') }}">
            @csrf
            <!-- Código -->
            <div class="form-group">
                <label for="codigo" class="form-label">Código:</label>
                <input type="text" name="codigo" class="form-control" value="{{ old('codigo') }}">
                @error('codigo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Descripción -->
            <div class="form-group">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" name="descripcion" class="form-control" value="{{ old('descripcion') }}">
                @error('descripcion')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Tipo de uso -->
            <div class="form-group">
                <label for="id_tipo_uso">Tipo de uso</label>
                <select class="form-control" name="id_tipo_uso">
                    @foreach($tiposUso as $tipoUso)
                        <option value="{{ $tipoUso->id }}">{{ $tipoUso->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Tipo de vehículo -->
            <div class="form-group">
                <label for="id_tipo_vehiculo">Tipo de vehículo</label>
                <select class="form-control" name="id_tipo_vehiculo">
                    @foreach($tiposVehiculo as $tipoVehiculo)
                        <option value="{{ $tipoVehiculo->id }}">{{ $tipoVehiculo->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Cantidad -->
            <div class="form-group">
                <label for="cantidad" class="form-label">Cantidad:</label>
                <input type="number" name="cantidad" class="form-control" value="{{ old('cantidad') }}">
                @error('cantidad')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Costo unitario -->
            <div class="form-group">
                <label for="costo_unitario" class="form-label">Costo unitario:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                    </div>
                    <input type="text" name="costo_unitario" class="form-control" value="{{ old('costo_unitario') }}">
                </div>
                @error('costo_unitario')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Opciones -->
            <div class="text-right">    
                <button class="btn btn-dark"><i class="mdi mdi-content-save-edit" aria-hidden="true"></i> Guardar</button>
                <a href="{{ route('insumos.index') }}" class="btn btn-secondary"><i class="mdi mdi-cancel" aria-hidden="true"></i> Cancelar</a>
            </div>
        </form>
    </div>
@endsection