@extends('layouts.app')

@section('title', '- Proveedores')

@section('content')
    <div class="container">
        <a href="{{ route('proveedores.create') }}" class="btn btn-dark float-right mb-3"><i class="mdi mdi-plus" aria-hidden="true"></i> Agregar proveedor</a>
        <h1><i class="mdi mdi-truck" aria-hidden="true"></i> Proveedores</h1>
        @if(session('success'))
            <div class="alert alert-success"><i class="mdi mdi-check-bold" aria-hidden="true"></i> {{ session('success') }}</div>
        @endif
        <table class="table table-striped table-hover table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Email</th>
                    <th class="text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($proveedores as $proveedor)
                <tr>
                    <td>{{ $proveedor->id }}</td>
                    <td>{{ $proveedor->nombre }}</td>
                    <td>{{ $proveedor->descripcion }}</td>
                    <td>{{ $proveedor->email }}</td>
                    <td class="text-right">
                        <a href="{{ route('proveedores.show', $proveedor) }}" class="btn btn-dark btn-sm"><i class="mdi mdi-eye" aria-hidden="true"></i></a>
                        <a href="{{ route('proveedores.edit', $proveedor) }}" class="btn btn-dark btn-sm"><i class="mdi mdi-pencil" aria-hidden="true"></i></a>
                        <!--<form action="{{ route('proveedores.destroy', $proveedor) }}" method="POST" style="display:inline;">
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