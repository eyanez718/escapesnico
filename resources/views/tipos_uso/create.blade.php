@extends('layouts.app')

@section('title', '- Agregando tipo de uso')

@section('content')
    <div class="container">
        <h1><i class="mdi mdi-plus" aria-hidden="true"></i> Agregando tipo de uso</h1>
        <form method="POST" action="{{ route('tipos_uso.store') }}">
            @csrf
            <!-- Nombre -->
            <div class="form-group">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}">
                @error('nombre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Opciones -->
            <div class="text-right">
                <button class="btn btn-dark"><i class="mdi mdi-content-save" aria-hidden="true"></i> Guardar</button>
                <a href="{{ route('tipos_uso.index') }}" class="btn btn-secondary"><i class="mdi mdi-cancel" aria-hidden="true"></i> Cancelar</a>
            </div>
        </form>
    </div>
@endsection