@extends('layouts.app')

@section('title', '- Agregando máquina')

@section('content')
    <div class="container">
        <h1><i class="mdi mdi-plus" aria-hidden="true"></i> Agregando máquina</h1>
        <form method="POST" action="{{ route('maquinas.store') }}">
            @csrf
            <!-- Nombre -->
            <div class="form-group">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}">
                @error('nombre')
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
            <!-- Usa combustible -->
            <div class="form-group">
                <div class="form-group form-check">
                    <input type="hidden" name="usa_combustible" value="0">
                    <input type="checkbox" class="form-check-input" name="usa_combustible" value="1" {{ old('usa_combustible', $modelo->activo ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="usa_combustible">Usa combustible</label>
                </div>
                @error('usa_combustible')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Opciones -->
            <div class="text-right">
                <button class="btn btn-dark"><i class="mdi mdi-content-save" aria-hidden="true"></i> Guardar</button>
                <a href="{{ route('maquinas.index') }}" class="btn btn-secondary"><i class="mdi mdi-cancel" aria-hidden="true"></i> Cancelar</a>
            </div>
        </form>
    </div>
@endsection