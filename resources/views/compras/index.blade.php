@extends('layouts.app')

@section('title', '- Compras')

@section('content')
    <div class="container">
        <a href="{{ route('compras.create') }}" class="btn btn-dark float-right mb-3"><i class="mdi mdi-plus" aria-hidden="true"></i> Agregar compra</a>
        <h1><i class="mdi mdi-shopping" aria-hidden="true"></i> Compras</h1>
        @if(session('success'))
            <div class="alert alert-success"><i class="mdi mdi-check-bold" aria-hidden="true"></i> {{ session('success') }}</div>
        @endif
        <table class="table table-striped table-hover table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Factura</th>
                    <th>Proveedor</th>
                    <th>Usuario</th>
                    <th class="text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($compras as $compra)
                <tr>
                    <td>{{ $compra->id }}</td>
                    <td>{{ \Carbon\Carbon::parse($compra->fecha)->format('d/m/Y') }}</td>
                    <td>{{ $compra->numero_factura }}</td>
                    <td>{{ $compra->proveedor->nombre }}</td>
                    <td>{{ $compra->usuario->nombre }}</td>
                    <td class="text-right">
                        <a href="{{ route('compras.show', $compra) }}" class="btn btn-dark btn-sm"><i class="mdi mdi-eye" aria-hidden="true"></i></a>
                        <!--<a href="{{ route('compras.edit', $compra) }}" class="btn btn-dark btn-sm"><i class="mdi mdi-pencil" aria-hidden="true"></i></a>-->
                        <!--<form action="{{ route('compras.destroy', $compra) }}" method="POST" style="display:inline;">
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