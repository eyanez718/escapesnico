@extends('layouts.app')

@section('title', '- Importar listado de precios')

@section('content')
    <div class="container">
        <h1><i class="mdi mdi-microsoft-excel" aria-hidden="true"></i> Importar listado de precios</h1>
        <br>
        <form action="{{ route('stock.procesar_listado_precios') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlFile1">Seleccione el archivo a importar (.xls, .xlsx, .csv)</label>
                <input type="file" name="file" class="form-control-file" required>
            </div>
            @error('file')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="text-right">
                <button type="submit" class="btn btn-dark"><i class="mdi mdi-file-upload" aria-hidden="true"></i> Importar</button>
                <a href="{{ route('stock.index') }}" class="btn btn-secondary"><i class="mdi mdi-arrow-left" aria-hidden="true"></i> Volver</a>
            </div>
        </form>
    </div>
@endsection