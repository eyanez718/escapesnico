@extends('layouts.app')

@section('title', '- Editando usuario')

@section('content')
    <div class="container">
        <h1><i class="mdi mdi-plus" aria-hidden="true"></i> Agregando usuario</h1>
        <form method="POST" action="{{ route('usuarios.store') }}">
            @csrf
            <!-- Nombre -->
            <div class="form-group">
                <label for="nombre" class="form-label">Nombre de usuario:</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}">
                @error('nombre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Nombre completo -->
            <div class="form-group">
                <label for="nombre_completo" class="form-label">Nombre completo:</label>
                <input type="text" name="nombre_completo" class="form-control" value="{{ old('nombre_completo') }}">
                @error('nombre_completo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Email -->
            <div class="form-group">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Rol -->
            <div class="form-group">
                <label for="id_rol">Rol</label>
                <select class="form-control" name="id_rol">
                    @foreach($roles as $rol)
                        <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Contraseña -->
            <div class="form-group">
                <label for="contrasenia" class="form-label">Contraseña:</label>
                <input type="password" name="contrasenia" class="form-control" value="">
                @error('contrasenia')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Confirmación contraseña -->
            <div class="form-group">
                <label for="contrasenia_confirmation" class="form-label">Confirmar contraseña:</label>
                <input type="password" name="contrasenia_confirmation" class="form-control" value="">
            </div>
            <!-- Opciones -->
            <div class="text-right">    
                <button class="btn btn-dark"><i class="mdi mdi-content-save-edit" aria-hidden="true"></i> Guardar</button>
                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary"><i class="mdi mdi-cancel" aria-hidden="true"></i> Cancelar</a>
            </div>
        </form>
    </div>
@endsection