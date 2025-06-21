@extends('layouts.app')

@section('title', '- Stock')

@section('content')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success"><i class="mdi mdi-check-bold" aria-hidden="true"></i> {{ session('success') }}</div>
        @endif
        <div class="row row-cols-1 row-cols-md-3">
            @if (Auth::user()->id_rol == 2)
            <div class="col mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><i class="mdi mdi-nut" aria-hidden="true"></i> Insumos</h5>
                        <p class="card-text">Gestiona el stock de insumos.</p>
                    </div>
                    <a href="{{ route('insumos.index') }}" class="btn btn-secondary stretched-link"></a>
                </div>
            </div>
            @endif
            @if (Auth::user()->id_rol == 2)
            <div class="col mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><i class="mdi mdi-car-door" aria-hidden="true"></i> Materiales</h5>
                        <p class="card-text">Gestiona el stock de materiales.</p>
                    </div>
                    <a href="{{ route('materiales.index') }}" class="btn btn-secondary stretched-link"></a>
                </div>
            </div>
            @endif
            @if (Auth::user()->id_rol == 2)
            <div class="col mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><i class="mdi mdi-microsoft-excel" aria-hidden="true"></i> Importar listado de precios</h5>
                        <p class="card-text">Importar un listado de precios desde excel.</p>
                    </div>
                    <a href="{{ route('stock.importar_listado_precios') }}" class="btn btn-secondary stretched-link"></a>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection