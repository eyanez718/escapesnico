@extends('layouts.app')

@section('title', '- Detalle de la orden de trabajo')

@section('content')
    <div class="container">
        <h1><i class="mdi mdi-eye" aria-hidden="true"></i> Detalle de la orden de trabajo: {{ $ordenTrabajo->id }}</h1>
        <p><strong>Estado:</strong> @if($ordenTrabajo->estado == 0) Cargada @else @if($ordenTrabajo->estado == 1) Finalizada @else Cancelada @endif @endif</p>
        <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($ordenTrabajo->fecha)->format('d/m/Y') }}</p>
        <p><strong>Empresa:</strong> {{ $ordenTrabajo->empresa }}</p>
        <p><strong>Patente:</strong> {{ $ordenTrabajo->patente }}</p>
        <p><strong>Modelo de vehículo:</strong> {{ $ordenTrabajo->modeloVehiculo->marcaVehiculo->nombre }} {{ $ordenTrabajo->modeloVehiculo->nombre }}</p>
        <p><strong>Tipo de vehículo:</strong> {{ $ordenTrabajo->tipoVehiculo->nombre }}</p>
        <p><strong>Trabajos realizados:</strong> {{ Arr::get($trabajosRealizados, $ordenTrabajo->trabajo_realizado_1)['nombre'] }}
            @if($ordenTrabajo->trabajo_realizado_2)- {{ Arr::get($trabajosRealizados, $ordenTrabajo->trabajo_realizado_2)['nombre'] }}@endif
            @if($ordenTrabajo->trabajo_realizado_3)- {{ Arr::get($trabajosRealizados, $ordenTrabajo->trabajo_realizado_3)['nombre'] }}@endif
            @if($ordenTrabajo->trabajo_realizado_4)- {{ Arr::get($trabajosRealizados, $ordenTrabajo->trabajo_realizado_4)['nombre'] }}@endif
        </p>
        <p><strong>Operador:</strong> {{ $ordenTrabajo->usuario->nombre }}</p>
        <h2>Materiales e insumos:</h2>
        @if (count($ordenTrabajo->insumos) > 0 || count($ordenTrabajo->materiales) > 0)
            <table class="table table-striped table-hover table-sm" id="selectedListTable">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($ordenTrabajo->insumos) > 0)
                        @foreach ($ordenTrabajo->insumos as $insumo)
                        <tr>
                            <td><span class="badge badge-secondary text-capitalize">insumo</span></td>
                            <td>{{ $insumo->codigo }}</td>
                            <td>{{ $insumo->descripcion }}</td>
                            <td class="text-right">{{ $insumo->pivot->cantidad }}</td>
                        </tr>
                        @endforeach
                    @endif
                    @if (count($ordenTrabajo->materiales) > 0)
                        @foreach ($ordenTrabajo->materiales as $material)
                        <tr>
                            <td><span class="badge badge-secondary text-capitalize">material</span></td>
                            <td>{{ $material->codigo }}</td>
                            <td>{{ $material->descripcion }}</td>
                            <td class="text-right">{{ $material->pivot->cantidad }}</td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        @else
            <div class="alert alert-info"><i class="mdi mdi-info" aria-hidden="true"></i> No se utilizaron insumos ni materiales.</div>
        @endif
        <!-- Máquinas -->
        <h2>Máquinas:</h2>
        @if (count($ordenTrabajo->maquinas) > 0)
            <table class="table table-striped table-hover table-sm" id="selectedListTable">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Minutos usados</th>
                        <th>Cambio combustible</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ordenTrabajo->maquinas as $maquina)
                        <tr>
                            <td>{{ $maquina->nombre }}</td>
                            <td>{{ $maquina->pivot->minutos_uso }}</td>
                            <td>@if($maquina->pivot->cambio_combustible) Sí @else No @endif</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-info"><i class="mdi mdi-info" aria-hidden="true"></i> No se utilizó maquinaria en la orden de trabajo.</div>
        @endif
        <!-- Opciones -->
        <div class="text-right">
            <!--<a href="{{ route('ordenes_trabajo.edit', $ordenTrabajo) }}" class="btn btn-dark"><i class="mdi mdi-pencil" aria-hidden="true"></i> Editar</a>-->
            <a href="{{ route('ordenes_trabajo.index') }}" class="btn btn-secondary"><i class="mdi mdi-arrow-left" aria-hidden="true"></i> Volver</a>
            @if($ordenTrabajo->estado == 0)
                <form action="{{ route('ordenes_trabajo.cambiar_estado', ['id' => $ordenTrabajo->id, 'estado' => 1]) }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="btn btn-success"><i class="mdi mdi-check-bold" aria-hidden="true"></i> Finalizar</button>
                </form>
                <form action="{{ route('ordenes_trabajo.cambiar_estado', ['id' => $ordenTrabajo->id, 'estado' => 2]) }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="btn btn-danger"><i class="mdi mdi-close-thick" aria-hidden="true"></i> Cancelar</button>
                </form>
            @endif
        </div>
    </div>
@endsection