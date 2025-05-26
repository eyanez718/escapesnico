<!-- BARRRA DE NAVEGACIÓN -->
<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('images/logo-sin-fondo-blanco.png') }}" width="100" height="30" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('home') }}"> <i class="mdi mdi-home" aria-hidden="true"></i> Home <span class="sr-only">(current)</span></a>
                </li>
                @if(Auth::user()->id_rol == 3)
                    <li class="nav-item {{ request()->routeIs('ordenesTrabajo') ? 'active' : '' }}">
                        <a class="nav-link" href="#"><i class="mdi mdi-file-document-edit" aria-hidden="true"></i> Ordenes de trabajo</a>
                    </li>
                @endif
                <li class="nav-item {{ request()->routeIs('reportes') ? 'active' : '' }}">
                    <a class="nav-link" href="#"><i class="mdi mdi-newspaper" aria-hidden="true"></i> Reportes</a>
                </li>
                @if(Auth::user()->id_rol == 1 || Auth::user()->id_rol == 2)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-cogs" aria-hidden="true"></i> Administración
                        </a>
                        <div class="dropdown-menu">
                            @if(Auth::user()->id_rol == 2)
                            <a class="dropdown-item {{ request()->routeIs('stock.index') ? 'active' : '' }}" href="#"><i class="mdi mdi-package-variant" aria-hidden="true"></i> Stock</a>
                            @endif
                            @if(Auth::user()->id_rol == 1)
                            <a class="dropdown-item {{ request()->routeIs('maquinas.index') ? 'active' : '' }}" href="{{ route('maquinas.index') }}"><i class="mdi mdi-wrench" aria-hidden="true"></i> Maquinaria</a>
                            @endif
                            @if(Auth::user()->id_rol == 2)
                            <a class="dropdown-item {{ request()->routeIs('compras.index') ? 'active' : '' }}" href="#"><i class="mdi mdi-shopping" aria-hidden="true"></i> Compras</a>
                            @endif
                            @if(Auth::user()->id_rol == 2)
                            <a class="dropdown-item {{ request()->routeIs('proveedores.index') ? 'active' : '' }}" href="{{ route('proveedores.index') }}"><i class="mdi mdi-truck" aria-hidden="true"></i> Proveedores</a>
                            @endif
                            @if(Auth::user()->id_rol == 1)
                            <a class="dropdown-item {{ request()->routeIs('usuarios.index') ? 'active' : '' }}" href="{{ route('usuarios.index') }}"><i class="mdi mdi-account-multiple" aria-hidden="true"></i> Usuarios</a>
                            @endif
                            @if(Auth::user()->id_rol == 1)
                            <a class="dropdown-item {{ request()->routeIs('roles.index') ? 'active' : '' }}" href="{{ route('roles.index') }}"><i class="mdi mdi-shield" aria-hidden="true"></i> Roles</a>
                            @endif
                            @if(Auth::user()->id_rol == 1)
                            <a class="dropdown-item {{ request()->routeIs('tipos_uso.index') ? 'active' : '' }}" href="{{ route('tipos_uso.index') }}"><i class="mdi mdi-car-turbocharger" aria-hidden="true"></i> Tipos de uso</a>
                            @endif
                            @if(Auth::user()->id_rol == 1)
                            <a class="dropdown-item {{ request()->routeIs('tipos_vehiculo.index') ? 'active' : '' }}" href="{{ route('tipos_vehiculo.index') }}"><i class="mdi mdi-car-multiple" aria-hidden="true"></i> Tipos de vehículo</a>
                            @endif
                        </div>
                    </li>
                @endif
            </ul>
            <ul class="navbar-nav my-2 my-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        <i class="mdi mdi-account" aria-hidden="true"></i> {{ Auth::user()->nombre }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item"><i class="mdi mdi-logout" aria-hidden="true"></i> Cerrar sesión</button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>