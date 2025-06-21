@extends('layouts.app')

@section('title', '- Reportes')

@section('content')
    <div class="container">
        <div class="row row-cols-1 row-cols-md-3">
            <div class="col mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><i class="mdi mdi-newspaper" aria-hidden="true"></i> Stock valorizado</h5>
                        <p class="card-text">Stock valorizado actual.</p>
                    </div>
                    <a href="{{ route('reportes.stock_valorizado') }}" class="btn btn-secondary stretched-link"></a>
                </div>
            </div>
            <!--<div class="col mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><i class="mdi mdi-newspaper" aria-hidden="true"></i> Stock valorizado en período</h5>
                        <p class="card-text">Stock valorizado en cierto período.</p>
                    </div>
                    <a href="{{ route('reportes.stock_valorizado_período') }}" class="btn btn-secondary stretched-link"></a>
                </div>
            </div>-->
            <div class="col mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><i class="mdi mdi-newspaper" aria-hidden="true"></i> Ranking de proveedores</h5>
                        <p class="card-text">Ranking de compra a los proveedores.</p>
                    </div>
                    <a href="{{ route('reportes.ranking_proveedores') }}" class="btn btn-secondary stretched-link"></a>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><i class="mdi mdi-newspaper" aria-hidden="true"></i> Estadísticas de operadores</h5>
                        <p class="card-text">Estadísticas de trabajo de los operadores.</p>
                    </div>
                    <a href="{{ route('reportes.estadisticas_operadores') }}" class="btn btn-secondary stretched-link"></a>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><i class="mdi mdi-newspaper" aria-hidden="true"></i> Estadísticas de máquinaria</h5>
                        <p class="card-text">Estadísticas de uso de la maquinaria.</p>
                    </div>
                    <a href="{{ route('reportes.estadisticas_maquinaria') }}" class="btn btn-secondary stretched-link"></a>
                </div>
            </div>
        </div>
    </div>
@endsection