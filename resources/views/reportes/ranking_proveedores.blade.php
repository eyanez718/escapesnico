@extends('layouts.app')

@section('title', '- Ranking de proveedores')

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
        <h1><i class="mdi mdi-newspaper" aria-hidden="true"></i> Ranking de proveedores</h1>
        <table class="table table-striped table-hover table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre del proveedor</th>
                    <th class="text-right">Compras</th>
                </tr>
            </thead>
            <tbody>
                @php $posicion = 0; @endphp
                @foreach($proveedores as $proveedor)
                @php $posicion += 1; @endphp
                <tr>
                    <td>{{ $posicion }}</td>
                    <td>{{ $proveedor->nombre }}</td>
                    <td class="text-right">{{ $proveedor->compras_count }}
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