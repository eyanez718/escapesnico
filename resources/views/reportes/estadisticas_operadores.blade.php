@extends('layouts.app')

@section('title', '- Estadísticas de maquinaria')

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
        <h1><i class="mdi mdi-newspaper" aria-hidden="true"></i> Estadísticas de operadores</h1>
        <table class="table table-striped table-hover table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Operador</th>
                    <th class="text-right">Ordenes atendidas</th>
                    <th class="text-right">Minutos trabajos</th>
                    <th class="text-right">Promedio minutos/trabajo</th>
                </tr>
            </thead>
            <tbody>
                @php $posicion = 0; @endphp
                @foreach($operadores as $operador)
                @php $posicion += 1; @endphp
                <tr>
                    <td>{{ $posicion }}</td>
                    <td>{{ $operador->nombre_completo }} ({{ $operador->nombre }})</td>
                    <td class="text-right">{{ $operador->total_trabajos }}</td>
                    <td class="text-right">{{ $operador->total_minutos_trabajo }}</td>
                    <td class="text-right">{{ number_format($operador->total_minutos_trabajo / $operador->total_trabajos, 2, '.', ',') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-right">
            <button class="btn btn-dark d-print-none" onclick="window.print()"><i class="mdi mdi-printer" aria-hidden="true"></i> Imprimir</button>
            <a href="{{ route('reportes.index') }}" class="btn btn-secondary"><i class="mdi mdi-arrow-left" aria-hidden="true"></i> Volver</a>
        </div>
    </div>
@endsection