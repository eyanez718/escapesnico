@extends('layouts.app')

@section('title', '- Ordenes de trabajo')

@section('content')
    <div class="container">
        <a href="{{ route('ordenes_trabajo.create') }}" class="btn btn-dark float-right mb-3"><i class="mdi mdi-plus" aria-hidden="true"></i> Agregar orden de trabajo</a>
        <h1><i class="mdi mdi-file-document-edit" aria-hidden="true"></i> Ordenes de trabajo</h1>
        @if(session('success'))
            <div class="alert alert-success"><i class="mdi mdi-check-bold" aria-hidden="true"></i> {{ session('success') }}</div>
        @endif
        <table class="table table-striped table-hover table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Empresa</th>
                    <th>Patente</th>
                    <th>Operador</th>
                    <th class="text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ordenesTrabajo as $ordenTrabajo)
                <tr class="{{ $ordenTrabajo->estado == 1 ? 'table-success' : '' }}{{ $ordenTrabajo->estado == 2 ? 'table-danger' : '' }}">
                    <td>{{ $ordenTrabajo->id }}</td>
                    <td>@if($ordenTrabajo->estado == 0) Cargada @else @if($ordenTrabajo->estado == 1) Finalizada @else Cancelada @endif @endif</td>
                    <td>{{ \Carbon\Carbon::parse($ordenTrabajo->fecha)->format('d/m/Y') }}</td>
                    <td>{{ $ordenTrabajo->empresa }}</td>
                    <td>{{ $ordenTrabajo->patente }}</td>
                    <td>{{ $ordenTrabajo->usuario->nombre }}</td>
                    <td class="text-right">
                        <a href="{{ route('ordenes_trabajo.show', $ordenTrabajo) }}" class="btn btn-dark btn-sm"><i class="mdi mdi-eye" aria-hidden="true"></i></a>
                        @if($ordenTrabajo->estado == 0)
                            <form action="{{ route('ordenes_trabajo.cambiar_estado', ['id' => $ordenTrabajo->id, 'estado' => 1]) }}" method="POST" style="display:inline;">
                                @csrf
                                <button class="btn btn-success btn-sm"><i class="mdi mdi-check-bold" aria-hidden="true"></i></button>
                            </form>
                            <form action="{{ route('ordenes_trabajo.cambiar_estado', ['id' => $ordenTrabajo->id, 'estado' => 2]) }}" method="POST" style="display:inline;">
                                @csrf
                                <button class="btn btn-danger btn-sm"><i class="mdi mdi-close-thick" aria-hidden="true"></i></button>
                            </form>
                        @endif
                        <!--<a href="{{ route('ordenes_trabajo.edit', $ordenTrabajo) }}" class="btn btn-dark btn-sm"><i class="mdi mdi-pencil" aria-hidden="true"></i></a>-->
                        <!--<form action="{{ route('compras.destroy', $ordenTrabajo) }}" method="POST" style="display:inline;">
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