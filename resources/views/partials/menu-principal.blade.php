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
                @if(Auth::user()->id_rol == 2)
                    <li class="nav-item {{ request()->routeIs('ordenesTrabajo') ? 'active' : '' }}">
                        <a class="nav-link" href="#"><i class="mdi mdi-file-document-edit" aria-hidden="true"></i> Ordenes de trabajo</a>
                    </li>
                @endif
                @if(Auth::user()->id_rol == 1)
                    <li class="nav-item {{ request()->routeIs('reportes') ? 'active' : '' }}">
                        <a class="nav-link" href="#"><i class="mdi mdi-newspaper" aria-hidden="true"></i> Reportes</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-cogs" aria-hidden="true"></i> Administración
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item {{ request()->routeIs('stock.index') ? 'active' : '' }}" href="#"><i class="mdi mdi-package-variant" aria-hidden="true"></i> Stock</a>
                            <a class="dropdown-item {{ request()->routeIs('maquinas.index') ? 'active' : '' }}" href="{{ route('maquinas.index') }}"><i class="mdi mdi-wrench" aria-hidden="true"></i> Maquinaria</a>
                            <a class="dropdown-item {{ request()->routeIs('compras.index') ? 'active' : '' }}" href="#"><i class="mdi mdi-shopping" aria-hidden="true"></i> Compras</a>
                            <a class="dropdown-item {{ request()->routeIs('proveedores.index') ? 'active' : '' }}" href="{{ route('proveedores.index') }}"><i class="mdi mdi-truck" aria-hidden="true"></i> Proveedores</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ request()->routeIs('usuarios.index') ? 'active' : '' }}" href="{{ route('usuarios.index') }}"><i class="mdi mdi-account-multiple" aria-hidden="true"></i> Usuarios</a>
                            <a class="dropdown-item {{ request()->routeIs('roles.index') ? 'active' : '' }}" href="{{ route('roles.index') }}"><i class="mdi mdi-shield" aria-hidden="true"></i> Roles</a>
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