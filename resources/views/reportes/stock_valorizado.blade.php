@extends('layouts.app')

@section('title', '- Stock valorizado')

@section('content')
    <div class="container">
        <div class="d-none d-print-block">
            <div class="row justify-content-center">
                <img src="{{ asset('images/logo.png') }}" 
                    alt="Logo impresión"
                    class="text-center"
                    style="width: 250px; margin-bottom: 20px;">
            </div>
        </div>
        <h1><i class="mdi mdi-newspaper" aria-hidden="true"></i> Stock valorizado</h1>
        <h2><i class="mdi mdi-nut" aria-hidden="true"></i> Insumos</h2>
        <table class="table table-striped table-hover table-sm">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Costo unitario</th>
                    <th>Costo total</th>
                </tr>
            </thead>
            <tbody>
                @php $totalInsumos = 0; @endphp
                @foreach($insumos as $insumo)
                <tr>
                    <td>{{ $insumo->codigo }}</td>
                    <td>{{ $insumo->descripcion }}</td>
                    <td class="text-right">{{ $insumo->cantidad }}</td>
                    <td class="text-right">$ {{ $insumo->costo_unitario_formatted }}</td>
                    <td class="text-right">$ {{ $insumo->costoTotal() }}</td>
                </tr>
                @php $totalInsumos += $insumo->cantidad * $insumo->costo_unitario; @endphp
                @endforeach
                <tr>
                    <td class="text-right" colspan=4><b>Total:</b></td>
                    <td class="text-right"><b>$ {{ $totalInsumos }}</b></td>
                </tr>
            </tbody>
        </table>
        <h2><i class="mdi mdi-car-door" aria-hidden="true"></i> Materiales</h2>
        <table class="table table-striped table-hover table-sm">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Costo unitario</th>
                    <th>Costo total</th>
                </tr>
            </thead>
            <tbody>
                @php $totalMateriales = 0; @endphp
                @foreach($materiales as $material)
                <tr>
                    <td>{{ $material->codigo }}</td>
                    <td>{{ $material->descripcion }}</td>
                    <td class="text-right">{{ $material->cantidad }}</td>
                    <td class="text-right">$ {{ $material->costo_unitario_formatted }}</td>
                    <td class="text-right">$ {{ $material->costoTotal() }}</td>
                </tr>
                @php $totalMateriales += $material->cantidad * $material->costo_unitario; @endphp
                @endforeach
                <tr>
                    <td class="text-right" colspan=4><b>Total:</b></td>
                    <td class="text-right"><b>$ {{ $totalMateriales }}</b></td>
                </tr>
            </tbody>
        </table>
        <div class="text-right">
            <button class="btn btn-dark d-print-none" onclick="window.print()"><i class="mdi mdi-printer" aria-hidden="true"></i> Imprimir</button>
            <a href="{{ route('reportes.index') }}" class="btn btn-secondary"><i class="mdi mdi-arrow-left" aria-hidden="true"></i> Volver</a>
        </div>
    </div>
@endsection