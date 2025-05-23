<!-- BARRRA DE NAVEGACIÓN -->
<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('images/logo-sin-fondo-blanco.png') }}" width="100" height="30" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                @if(Auth::user()->id_rol == 2)
                    <li class="nav-item">
                        <a class="nav-link" href="#">Ordenes de trabajo</a>
                    </li>
                @endif
                @if(Auth::user()->id_rol == 1)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            Administración
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Stock</a>
                            <a class="dropdown-item" href="#">Maquinaria</a>
                            <a class="dropdown-item" href="#">Compras</a>
                            <a class="dropdown-item" href="#">Proveedores</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('usuarios.index') }}">Usuarios</a>
                            <a class="dropdown-item" href="{{ route('roles.index') }}">Roles</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Reportes</a>
                        </div>
                    </li>
                @endif
            </ul>
            <ul class="navbar-nav my-2 my-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->nombre }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item">Cerrar sesión</button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>