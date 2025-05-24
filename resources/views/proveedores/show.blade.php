@extends('layouts.app')

@section('title', '- Detalle de proveedor')

@section('content')
    <div class="container">
        <h1><i class="mdi mdi-truck" aria-hidden="true"></i> Detalle del proveedor: {{ $proveedor->nombre }}</h1>
        <p><strong>ID:</strong> {{ $proveedor->id }}</p>
        <p><strong>Nombre:</strong> {{ $proveedor->nombre }}</p>
        <p><strong>Descripción:</strong> {{ $proveedor->descripcion }}</p>
        <p><strong>Email</strong> {{ $proveedor->email }}</p>
        <!-- Opciones -->
        <div class="text-right">
            <a href="{{ route('proveedores.edit', $proveedor) }}" class="btn btn-dark"><i class="mdi mdi-pencil" aria-hidden="true"></i> Editar</a>
            <a href="{{ route('proveedores.index') }}" class="btn btn-secondary"><i class="mdi mdi-arrow-left" aria-hidden="true"></i> Volver</a>
        </div>
    </div>
@endsection