@extends('layouts.app')

@section('title', '- Usuarios')

@section('content')
    <div class="container">
        <a href="{{ route('usuarios.create') }}" class="btn btn-dark float-right mb-3"><i class="mdi mdi-plus" aria-hidden="true"></i> Agregar usuario</a>
        <h1><i class="mdi mdi-account-multiple" aria-hidden="true"></i> Usuarios</h1>
        @if(session('success'))
            <div class="alert alert-success"><i class="mdi mdi-check-bold" aria-hidden="true"></i> {{ session('success') }}</div>
        @endif
        <table class="table table-striped table-hover table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th class="text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->nombre }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->rol->nombre }}</td>
                    <td class="text-right">
                        <a href="{{ route('usuarios.show', $usuario) }}" class="btn btn-dark btn-sm"><i class="mdi mdi-eye" aria-hidden="true"></i></a>
                        <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-dark btn-sm"><i class="mdi mdi-pencil" aria-hidden="true"></i></a>
                        <!--<form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"><i class="mdi mdi-trash-can" aria-hidden="true"></i></button>
                        </form>-->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection