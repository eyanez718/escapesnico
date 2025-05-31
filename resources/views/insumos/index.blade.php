@extends('layouts.app')

@section('title', '- Insumos')

@section('content')
    <div class="container">
        <a href="{{ route('insumos.create') }}" class="btn btn-dark float-right mb-3"><i class="mdi mdi-plus" aria-hidden="true"></i> Agregar insumo</a>
        <h1><i class="mdi mdi-nut" aria-hidden="true"></i> Insumos</h1>
        @if(session('success'))
            <div class="alert alert-success"><i class="mdi mdi-check-bold" aria-hidden="true"></i> {{ session('success') }}</div>
        @endif
        <table class="table table-striped table-hover table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Tipo de uso</th>
                    <th>Tipo de vehículo</th>
                    <th>Cantidad</th>
                    <th>Costo unitario</th>
                    <th>Costo total</th>
                    <th class="text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($insumos as $insumo)
                <tr>
                    <td>{{ $insumo->id }}</td>
                    <td>{{ $insumo->codigo }}</td>
                    <td>{{ $insumo->descripcion }}</td>
                    <td>{{ $insumo->tipoUso->nombre }}</td>
                    <td>{{ $insumo->tipoVehiculo->nombre }}</td>
                    <td class="text-right">{{ $insumo->cantidad }}</td>
                    <td class="text-right">$ {{ $insumo->costo_unitario_formatted }}</td>
                    <td class="text-right">$ {{ $insumo->costoTotal() }}</td>
                    <td class="text-right">
                        <a href="{{ route('insumos.show', $insumo) }}" class="btn btn-dark btn-sm"><i class="mdi mdi-eye" aria-hidden="true"></i></a>
                        <a href="{{ route('insumos.edit', $insumo) }}" class="btn btn-dark btn-sm"><i class="mdi mdi-pencil" aria-hidden="true"></i></a>
                        <!--<form action="{{ route('insumos.destroy', $insumo) }}" method="POST" style="display:inline;">
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