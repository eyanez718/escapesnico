@extends('layouts.app')

@section('title', '- Editando rol')

@section('content')
    <div class="container">
        <h1><i class="mdi mdi-pencil" aria-hidden="true"></i> Editando rol: {{ $rol->nombre }}</h1>
        <form method="POST" action="{{ route('roles.update', $rol) }}">
            @csrf
            @method('PUT')
            <!-- ID -->
            <div class="form-group">
                <label for="id" class="form-label">ID:</label>
                <input type="text" name="id" class="form-control" value="{{ old('id', $rol->id) }}" readonly>
                @error('id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Nombre -->
            <div class="form-group">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $rol->nombre) }}">
                @error('nombre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Descripción -->
            <div class="form-group">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" name="descripcion" class="form-control" value="{{ old('descripcion', $rol->descripcion) }}">
                @error('descripcion')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Opciones -->
            <div class="text-right">    
                <button class="btn btn-dark"><i class="mdi mdi-content-save-edit" aria-hidden="true"></i> Guardar</button>
                <a href="{{ route('roles.index') }}" class="btn btn-secondary"><i class="mdi mdi-cancel" aria-hidden="true"></i> Cancelar</a>
            </div>
        </form>
    </div>
@endsection