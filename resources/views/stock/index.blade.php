@extends('layouts.app')

@section('title', '- Stock')

@section('content')
    <div class="container">
        <div class="row row-cols-1 row-cols-md-2">
            @if (Auth::user()->id_rol == 2)
            <div class="col mb-6">
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
            <div class="col mb-6">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><i class="mdi mdi-shopping" aria-hidden="true"></i> Materiales</h5>
                        <p class="card-text">Gestiona el stock de materiales.</p>
                    </div>
                    <a href="#" class="btn btn-secondary stretched-link"></a>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection