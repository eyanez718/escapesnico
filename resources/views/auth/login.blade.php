@extends('layouts.app')
@section('content')
    <br><br><br>
    <div class="row w-60 justify-content-center">
        <img src="{{ asset('images/logo.png') }}" alt="Logo"><br><br><br>
    </div>
    <br><br><br>
    <div class="row justify-content-center">
        <div class="card w-60">
            <div class="card-header">Ingreso al sistema</div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                    @csrf
                    <!-- Nombre de usuario -->
                    <div class="form-group row">
                        <label for="nombre" class="col-sm-4 col-form-label"><i class="mdi mdi-account" aria-hidden="true"></i> Nombre de usuario</label>
                        <input type="text" name="nombre" class="form-control col-sm-8" placeholder="Nombre">
                    </div>
                    <!-- Contraseña -->
                    <div class="form-group row">
                        <label for="contrasenia" class="col-sm-4 col-form-label"><i class="mdi mdi-account-key" aria-hidden="true"></i> Contraseña</label>
                        <input type="password" name="contrasenia" class="form-control col-sm-8" placeholder="Contraseña">
                    </div>
                    <!-- Botón iniciar sesión -->
                    <div class="form-group-row">
                        <div class="col-sm-12 text-center">
                            <button type="submit" class="btn btn-danger"><i class="mdi mdi-login" aria-hidden="true"></i> Iniciar sesión</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection