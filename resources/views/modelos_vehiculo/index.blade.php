@extends('layouts.app')

@section('title', '- Modelos de vehículo')

@section('content')
    <div class="container">
        <a href="{{ route('modelos_vehiculo.create') }}" class="btn btn-dark float-right mb-3"><i class="mdi mdi-plus" aria-hidden="true"></i> Agregar modelo de vehículo</a>
        <h1><i class="mdi mdi-car-settings" aria-hidden="true"></i> Modelos de vehículo</h1>
        @if(session('success'))
            <div class="alert alert-success"><i class="mdi mdi-check-bold" aria-hidden="true"></i> {{ session('success') }}</div>
        @endif
        <table class="table table-striped table-hover table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th class="text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($modelosVehiculo as $modeloVehiculo)
                <tr>
                    <td>{{ $modeloVehiculo->id }}</td>
                    <td>{{ $modeloVehiculo->nombre }}</td>
                    <td>{{ $modeloVehiculo->marcaVehiculo->nombre }}</td>
                    <td class="text-right">
                        <a href="{{ route('modelos_vehiculo.show', $modeloVehiculo) }}" class="btn btn-dark btn-sm"><i class="mdi mdi-eye" aria-hidden="true"></i></a>
                        <a href="{{ route('modelos_vehiculo.edit', $modeloVehiculo) }}" class="btn btn-dark btn-sm"><i class="mdi mdi-pencil" aria-hidden="true"></i></a>
                        <!--<form action="{{ route('modelos_vehiculo.destroy', $modeloVehiculo) }}" method="POST" style="display:inline;">
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