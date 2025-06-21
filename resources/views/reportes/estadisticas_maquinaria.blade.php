@extends('layouts.app')

@section('title', '- Estadísticas de maquinaria')

@section('content')
    <div class="container">
        <h1><i class="mdi mdi-newspaper" aria-hidden="true"></i> Estadísticas de maquinaria</h1>
        <table class="table table-striped table-hover table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Máquina</th>
                    <th class="text-right">Tiempo de uso</th>
                    <th class="text-right">Cambios de combustible</th>
                </tr>
            </thead>
            <tbody>
                @foreach($maquinas as $maquina)
                <tr>
                    <td>{{ $maquina->id }}</td>
                    <td>{{ $maquina->nombre }}</td>
                    <td class="text-right">{{ $maquina->total_minutos }}</td>
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
    </div>
@endsection