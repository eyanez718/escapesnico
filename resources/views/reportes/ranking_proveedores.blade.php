@extends('layouts.app')

@section('title', '- Ranking de proveedores')

@section('content')
    <div class="container">
        <h1><i class="mdi mdi-newspaper" aria-hidden="true"></i> Ranking de proveedores</h1>
        <table class="table table-striped table-hover table-sm">
            <thead>
                <tr>
                    <th>Nombre del proveedor</th>
                    <th class="text-right">Compras</th>
                </tr>
            </thead>
            <tbody>
                @foreach($proveedores as $proveedor)
                <tr>
                    <td>{{ $proveedor->nombre }}</td>
                    <td class="text-right">{{ $proveedor->compras_count }}
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection