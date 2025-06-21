@extends('layouts.app')

@section('title', '- Estadísticas de maquinaria')

@section('content')
    <div class="container">
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
                @foreach($operadores as $operador)
                <tr>
                    <td>{{ $operador->id }}</td>
                    <td>{{ $operador->nombre }}</td>
                    <td class="text-right">{{ $operador->total_trabajos }}</td>
                    <td class="text-right">{{ $operador->total_minutos_trabajo }}</td>
                    <td class="text-right">{{ $operador->total_minutos_trabajo / $operador->total_trabajos }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection