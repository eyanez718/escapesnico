@extends('layouts.app')

@section('title', '- Detalle de la compra')

@section('content')
    <div class="container">
        <h1><i class="mdi mdi-eye" aria-hidden="true"></i> Detalle de la compra: {{ $compra->id }}</h1>
        <p><strong>ID:</strong> {{ $compra->id }}</p>
        <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($compra->fecha)->format('d/m/Y') }}</p>
        <p><strong>Número de factura:</strong> {{ $compra->numero_factura }}</p>
        <p><strong>Proveedor:</strong> {{ $compra->proveedor->nombre }}</p>
        <p><strong>Usuario carga:</strong> {{ $compra->usuario->nombre }}</p>
        <h2>Materiales e insumos:</h2>
        <table class="table table-striped table-hover table-sm" id="selectedListTable">
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Costo Unitario</th>
                </tr>
            </thead>
            <tbody>
                @if (count($compra->insumos) > 0)
                    @foreach ($compra->insumos as $insumo)
                    <tr>
                        <td><span class="badge badge-secondary text-capitalize">insumo</span></td>
                        <td>{{ $insumo->codigo }}</td>
                        <td>{{ $insumo->descripcion }}</td>
                        <td class="text-right">{{ $insumo->pivot->cantidad }}</td>
                        <td class="text-right">$ {{ $insumo->pivot->costo_unitario }}</td>
                    </tr>
                    @endforeach
                @endif
                @if (count($compra->materiales) > 0)
                    @foreach ($compra->materiales as $material)
                    <tr>
                        <td><span class="badge badge-secondary text-capitalize">material</span></td>
                        <td>{{ $material->codigo }}</td>
                        <td>{{ $material->descripcion }}</td>
                        <td class="text-right">{{ $material->pivot->cantidad }}</td>
                        <td class="text-right">$ {{ $material->pivot->costo_unitario }}</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <!-- Opciones -->
        <div class="text-right">
            <!--<a href="{{ route('compras.edit', $compra) }}" class="btn btn-dark"><i class="mdi mdi-pencil" aria-hidden="true"></i> Editar</a>-->
            <a href="{{ route('compras.index') }}" class="btn btn-secondary"><i class="mdi mdi-arrow-left" aria-hidden="true"></i> Volver</a>
        </div>
    </div>
@endsection