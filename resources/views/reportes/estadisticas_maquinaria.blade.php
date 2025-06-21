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
        <h1><i class="mdi mdi-newspaper" aria-hidden="true"></i> Estadísticas de maquinaria</h1>
        <table class="table table-striped table-hover table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Máquina</th>
                    <th class="text-right">Usos</th>
                    <th class="text-right">Tiempo de uso</th>
                    <th class="text-right">Promedio minutos/uso</th>
                    <th class="text-right">Cambios de combustible</th>
                </tr>
            </thead>
            <tbody>
                @php $posicion = 0; @endphp
                @foreach($maquinas as $maquina)
                @php $posicion += 1; @endphp
                <tr>
                    <td>{{ $posicion }}</td>
                    <td>{{ $maquina->nombre }}</td>
                    <td class="text-right">{{ $maquina->total_trabajos }}</td>
                    <td class="text-right">{{ $maquina->total_minutos }}</td>
                    <td class="text-right">{{ number_format($maquina->total_minutos / $maquina->total_trabajos, 2, '.', ',') }}</td>
                    <td class="text-right">
                        @if ($maquina->total_cambios_combustible == 0 || is_null($maquina->total_cambios_combustible))
                            0
                        @else
                            {{ $maquina->total_cambios_combustible }}
                        @endif
                    </td>
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