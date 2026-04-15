@extends('layouts.app')

@section('content')

<!-- HERO -->
<header class="hero">
    <h1>Despensa Espinoza</h1>
    <p>Todo lo que necesitas, en un solo lugar</p>
</header>

<!-- CATEGORÍAS -->
<h2 class="section-title">Nuestras Categorías</h2>

<div class="carousel-categories" id="carouselCategorias">

    <a href="/categoria/abarrotes" class="cat-card">
        <img src="{{ asset('img/Apartados/Abarroteria.png') }}">
        <span>Abarrotes</span>
    </a>

    <a href="/categoria/higiene" class="cat-card">
        <img src="{{ asset('img/Apartados/HigieneyBelleza.png') }}">
        <span>Higiene y Belleza</span>
    </a>

    <a href="/categoria/bebes" class="cat-card">
        <img src="{{ asset('img/Apartados/BebesyNiños.png') }}">
        <span>Bebés y Niños</span>
    </a>

    <a href="/categoria/limpieza" class="cat-card">
        <img src="{{ asset('img/Apartados/Limpieza.png') }}">
        <span>Limpieza</span>
    </a>

    <a href="/categoria/bebidas" class="cat-card">
        <img src="{{ asset('img/Apartados/JugosyBebidas.png') }}">
        <span>Jugos y Bebidas</span>
    </a>

    <a href="/categoria/farmacia" class="cat-card">
        <img src="{{ asset('img/Apartados/Farmacia.png') }}">
        <span>Farmacia</span>
    </a>

    <a href="/categoria/lacteos" class="cat-card">
        <img src="{{ asset('img/Apartados/Lacteos.png') }}">
        <span>Lácteos</span>
    </a>

    <a href="/categoria/carnes" class="cat-card">
        <img src="{{ asset('img/Apartados/CarnesyPescado.png') }}">
        <span>Carnes y Pescado</span>
    </a>

    <a href="/categoria/vinos" class="cat-card">
        <img src="{{ asset('img/Apartados/VinosyLicore.png') }}">
        <span>Vinos y Licores</span>
    </a>

    <a href="/categoria/embutidos" class="cat-card">
        <img src="{{ asset('img/Apartados/Embutidos.png') }}">
        <span>Embutidos</span>
    </a>

    <a href="/categoria/panaderia" class="cat-card">
        <img src="{{ asset('img/Apartados/Panaderia.png') }}">
        <span>Panadería</span>
    </a>

    <a href="/categoria/congelados" class="cat-card">
        <img src="{{ asset('img/Apartados/AlimentosCongelados.png') }}">
        <span>Congelados</span>
    </a>

    <a href="/categoria/frutas" class="cat-card">
        <img src="{{ asset('img/Apartados/FrutasyVerduras.png') }}">
        <span>Frutas y Verduras</span>
    </a>

</div>
<!-- PRODUCTOS DESTACADOS (ÚNICA SECCIÓN) -->
<!-- PRODUCTOS DESTACADOS -->
<section class="section container">

    <div class="section-green">

        <h2 class="text-center mb-4">Productos Destacados</h2>

        <div class="grid-products">

    <!-- FILA 1 -->
    <div class="product-card">
        <img src="{{ asset('img/Productos/cafeoro.jpg') }}">
        <h5>Café Oro</h5>
        <p>L. 75.00</p>
        <button class="btn btn-success add-cart">Agregar</button>
    </div>

    <div class="product-card">
        <img src="{{ asset('img/Productos/frijoles.webp') }}">
        <h5>Frijoles Natura</h5>
        <p>L. 25.00</p>
        <button class="btn btn-success add-cart">Agregar</button>
    </div>

    <div class="product-card">
        <img src="{{ asset('img/Productos/Leche Entera.webp') }}">
        <h5>Leche Entera</h5>
        <p>L. 30.00</p>
        <button class="btn btn-success add-cart">Agregar</button>
    </div>

    <!-- FILA 2 -->
    <div class="product-card">
        <img src="{{ asset('img/Productos/atun.webp') }}">
        <h5>Atún Bumble Bee</h5>
        <p>L. 55.00</p>
        <button class="btn btn-success add-cart">Agregar</button>
    </div>

    <div class="product-card">
        <img src="{{ asset('img/Productos/colgate.jpg') }}">
        <h5>Pasta Colgate</h5>
        <p>L. 45.00</p>
        <button class="btn btn-success add-cart">Agregar</button>
    </div>

    <div class="product-card">
        <img src="{{ asset('img/Productos/cremanivea.jpg') }}">
        <h5>Crema Nivea</h5>
        <p>L. 75.00</p>
        <button class="btn btn-success add-cart">Agregar</button>
    </div>

</div>

    </div>

</section>

@endsection