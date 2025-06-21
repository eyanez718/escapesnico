@extends('layouts.app')

@section('title', '- Home')

@section('content')
    <div class="container">
        <div class="row row-cols-1 row-cols-md-3">
            @if (Auth::user()->id_rol == 3)
            <div class="col mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><i class="mdi mdi-file-document-edit" aria-hidden="true"></i> Ordenes de trabajo</h5>
                        <p class="card-text">Gestión integral de tareas operativas o mantenimientos programados. Permite crear, asignar, supervisar y cerrar órdenes relacionadas con procesos técnicos, operativos o de servicio.</p>
                    </div>
                    <a href="{{ route('ordenes_trabajo.index') }}" class="btn btn-secondary stretched-link"></a>
                </div>
            </div>
            @endif
            @if (Auth::user()->id_rol != 3)
            <div class="col mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><i class="mdi mdi-newspaper" aria-hidden="true"></i> Reportes</h5>
                        <p class="card-text">Visualización y generación de informes sobre datos del sistema.</p>
                    </div>
                    <a href="{{ route('reportes.index') }}" class="btn btn-secondary stretched-link"></a>
                </div>
            </div>
            @endif
            @if (Auth::user()->id_rol == 2)
            <div class="col mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><i class="mdi mdi-package-variant" aria-hidden="true"></i> Stock</h5>
                        <p class="card-text">Control de inventario de materiales e insumos. Permite registrar ingresos, egresos, ajustes y consultar disponibilidad en tiempo real.</p>
                    </div>
                    <a href="{{ route('stock.index') }}" class="btn btn-secondary stretched-link"></a>
                </div>
            </div>
            @endif
            @if (Auth::user()->id_rol == 1)
            <div class="col mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><i class="mdi mdi-wrench" aria-hidden="true"></i> Maquinaria</h5>
                        <p class="card-text">Registro y seguimiento del parque de máquinas o equipos. Incluye datos técnicos, historial de uso, mantenimiento y estado actual.</p>
                    </div>
                    <a href="{{ route('maquinas.index') }}" class="btn btn-secondary stretched-link"></a>
                </div>
            </div>
            @endif
            @if (Auth::user()->id_rol == 2)
            <div class="col mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><i class="mdi mdi-shopping" aria-hidden="true"></i> Compras</h5>
                        <p class="card-text">Gestión de solicitudes y órdenes de compra. Controla el flujo de adquisición de insumos o repuestos, desde la solicitud hasta la recepción.</p>
                    </div>
                    <a href="{{ route('compras.index') }}" class="btn btn-secondary stretched-link"></a>
                </div>
            </div>
            @endif
            @if (Auth::user()->id_rol == 2)
            <div class="col mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><i class="mdi mdi-truck" aria-hidden="true"></i> Proveedores</h5>
                        <p class="card-text">Administración de empresas o personas que suministran productos o servicios. Incluye contactos, historial de compras y condiciones comerciales.</p>
                    </div>
                    <a href="{{ route('proveedores.index') }}" class="btn btn-secondary stretched-link"></a>
                </div>
            </div>
            @endif
            @if (Auth::user()->id_rol == 1)
            <div class="col mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><i class="mdi mdi-account-multiple" aria-hidden="true"></i> Usuarios</h5>
                        <p class="card-text">Módulo de administración de cuentas de acceso al sistema. Permite crear, editar, suspender y asignar roles a usuarios según sus funciones.</p>
                    </div>
                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary stretched-link"></a>
                </div>
            </div>
            @endif
            @if (Auth::user()->id_rol == 1)
            <div class="col mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><i class="mdi mdi-shield" aria-hidden="true"></i> Roles</h5>
                        <p class="card-text">Definición de permisos y niveles de acceso del sistema. Permite estructurar qué acciones puede realizar cada tipo de usuario en base a su rol asignado.</p>
                    </div>
                    <a href="{{ route('roles.index') }}" class="btn btn-secondary stretched-link"></a>
                </div>
            </div>
            @endif
            @if (Auth::user()->id_rol == 1)
            <div class="col mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><i class="mdi mdi-car-turbocharger" aria-hidden="true"></i> Tipos de uso</h5>
                        <p class="card-text">Registro los distintos tipos de uso asociados a los insumos y materiales.</p>
                    </div>
                    <a href="{{ route('tipos_uso.index') }}" class="btn btn-secondary stretched-link"></a>
                </div>
            </div>
            @endif
            @if (Auth::user()->id_rol == 1)
            <div class="col mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><i class="mdi mdi-car-multiple" aria-hidden="true"></i> Tipos de vehículo</h5>
                        <p class="card-text">Registro los distintos tipos de vehículo asociados a los insumos y materiales.</p>
                    </div>
                    <a href="{{ route('tipos_vehiculo.index') }}" class="btn btn-secondary stretched-link"></a>
                </div>
            </div>
            @endif
            @if (Auth::user()->id_rol == 1)
            <div class="col mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><i class="mdi mdi-car-select" aria-hidden="true"></i> Marcas de vehículo</h5>
                        <p class="card-text">Registra las distintas marcas de vehículo asociadas a los materiales.</p>
                    </div>
                    <a href="{{ route('marcas_vehiculo.index') }}" class="btn btn-secondary stretched-link"></a>
                </div>
            </div>
            @endif
            @if (Auth::user()->id_rol == 1)
            <div class="col mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><i class="mdi mdi-car-settings" aria-hidden="true"></i> Modelos de vehículo</h5>
                        <p class="card-text">Registra los distintos modelos de vehículo asociadas a los materiales.</p>
                    </div>
                    <a href="{{ route('modelos_vehiculo.index') }}" class="btn btn-secondary stretched-link"></a>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection