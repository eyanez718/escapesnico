@extends('layouts.app')

@section('title', '- Tipos de vehículo')

@section('content')
    <div class="container">
        <a href="{{ route('tipos_vehiculo.create') }}" class="btn btn-dark float-right mb-3"><i class="mdi mdi-plus" aria-hidden="true"></i> Agregar tipo de vehículo</a>
        <h1><i class="mdi mdi-car-multiple" aria-hidden="true"></i> Tipos de vehículo</h1>
        @if(session('success'))
            <div class="alert alert-success"><i class="mdi mdi-check-bold" aria-hidden="true"></i> {{ session('success') }}</div>
        @endif
        <table class="table table-striped table-hover table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th class="text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tiposVehiculo as $tipoVehiculo)
                <tr>
                    <td>{{ $tipoVehiculo->id }}</td>
                    <td>{{ $tipoVehiculo->nombre }}</td>
                    <td class="text-right">
                        <a href="{{ route('tipos_vehiculo.show', $tipoVehiculo) }}" class="btn btn-dark btn-sm"><i class="mdi mdi-eye" aria-hidden="true"></i></a>
                        <a href="{{ route('tipos_vehiculo.edit', $tipoVehiculo) }}" class="btn btn-dark btn-sm"><i class="mdi mdi-pencil" aria-hidden="true"></i></a>
                        <!--<form action="{{ route('tipos_vehiculo.destroy', $tipoVehiculo) }}" method="POST" style="display:inline;">
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