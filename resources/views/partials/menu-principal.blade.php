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
                <li class="nav-item">
                    <a class="nav-link" href="#">Ordenes de trabajo</a>
                </li>
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
                        <a class="dropdown-item" href="#">Operadores</a>
                        <a class="dropdown-item" href="#">Roles</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Reportes</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>