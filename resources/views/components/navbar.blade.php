<nav class="navbar navbar-expand-lg custom-navbar px-4">

    <!-- LOGO -->
    <a class="navbar-brand" href="/">
        <img src="{{ asset('img/logo.jpg') }}" width="50">
    </a>

    <div class="collapse navbar-collapse">

        <!-- 🔐 ADMIN -->
        @if(request()->is('admin*'))

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="/admin">Panel</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/admin/pedidos">Pedidos</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/admin/create">Agregar Producto</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-danger" href="/logout">Cerrar sesión</a>
                </li>

            </ul>

        @else

        <!-- 🛒 NAV NORMAL -->
        <ul class="navbar-nav ms-auto align-items-center">

            <li class="nav-item">
                <a class="nav-link" href="/">Inicio</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/ofertas">Ofertas</a>
            </li>

            <!-- 🔥 CARRITO -->
            <li class="nav-item ms-3">
                <button id="cart-toggle" class="btn btn-success position-relative">

                    🛒

                    <span id="cart-count"
                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        0
                    </span>

                </button>
            </li>

        </ul>

        @endif

    </div>

</nav>