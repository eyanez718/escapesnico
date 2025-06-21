@extends('layouts.app')

@section('title', '- Materiales')

@section('content')
    <div class="container">
        <a href="{{ route('materiales.create') }}" class="btn btn-dark float-right mb-3"><i class="mdi mdi-plus" aria-hidden="true"></i> Agregar material</a>
        <h1><i class="mdi mdi-car-door" aria-hidden="true"></i> Materiales</h1>
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
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Cantidad</th>
                    <th>Costo unitario</th>
                    <th>Costo total</th>
                    <th class="text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($materiales as $material)
                <tr>
                    <td>{{ $material->id }}</td>
                    <td>{{ $material->codigo }}</td>
                    <td>{{ $material->descripcion }}</td>
                    <td>{{ $material->tipoUso->nombre }}</td>
                    <td>{{ $material->tipoVehiculo->nombre }}</td>
                    <td>{{ $material->marcaVehiculo->nombre }}</td>
                    <td>{{ $material->modeloVehiculo->nombre }}</td>
                    <td class="text-right">{{ $material->cantidad }}</td>
                    <td class="text-right">$ {{ $material->costo_unitario_formatted }}</td>
                    <td class="text-right">$ {{ $material->costoTotal() }}</td>
                    <td class="text-right">
                        <a href="{{ route('materiales.show', $material) }}" class="btn btn-dark btn-sm"><i class="mdi mdi-eye" aria-hidden="true"></i></a>
                        <a href="{{ route('materiales.edit', $material) }}" class="btn btn-dark btn-sm"><i class="mdi mdi-pencil" aria-hidden="true"></i></a>
                        <!--<form action="{{ route('materiales.destroy', $material) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"><i class="mdi mdi-trash-can" aria-hidden="true"></i></button>
                        </form>-->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-right">
            <a href="{{ route('stock.index') }}" class="btn btn-secondary"><i class="mdi mdi-arrow-left" aria-hidden="true"></i> Volver</a>
        </div>
    </div>
@endsection