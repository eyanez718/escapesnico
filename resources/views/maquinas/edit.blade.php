@extends('layouts.app')

@section('title', '- Editando máquina')

@section('content')
    <div class="container">
        <h1><i class="mdi mdi-pencil" aria-hidden="true"></i> Editando máquina: {{ $maquina->nombre }}</h1>
        <form method="POST" action="{{ route('maquinas.update', $maquina) }}">
            @csrf
            @method('PUT')
            <!-- ID -->
            <div class="form-group">
                <label for="id" class="form-label">ID:</label>
                <input type="text" name="id" class="form-control" value="{{ old('id', $maquina->id) }}" readonly>
                @error('id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Nombre -->
            <div class="form-group">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $maquina->nombre) }}">
                @error('nombre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Descripción -->
            <div class="form-group">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" name="descripcion" class="form-control" value="{{ old('descripcion', $maquina->descripcion) }}">
                @error('descripcion')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Usa combustible -->
            <div class="form-group">
                <div class="form-group form-check">
                    <input type="hidden" name="usa_combustible" value="0">
                    <input type="checkbox" class="form-check-input" name="usa_combustible" value="1" {{ old('usa_combustible', $maquina->usa_combustible ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="usa_combustible">Usa combustible</label>
                </div>
                @error('usa_combustible')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Opciones -->
            <div class="text-right">    
                <button class="btn btn-dark"><i class="mdi mdi-content-save-edit" aria-hidden="true"></i> Guardar</button>
                <a href="{{ route('maquinas.index') }}" class="btn btn-secondary"><i class="mdi mdi-cancel" aria-hidden="true"></i> Cancelar</a>
            </div>
        </form>
    </div>
@endsection