@php
$config = \App\Models\Configuracion::pluck('valor', 'clave');
@endphp
@extends('layouts.app')

@section('content')

<!-- HERO -->
<header class="hero">
    <h1>Despensa Espinoza</h1>
    <p>Todo lo que necesitas, en un solo lugar</p>
</header>

<!-- CATEGORÍAS (SE QUEDA IGUAL) -->
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

@if(($config['destacados'] ?? 1) == 1)
<!-- 🔥 DESTACADOS DINÁMICOS -->
<section id="destacados" class="section container">

    <div class="section-green">

        <h2 class="text-center mb-4">Productos Destacados</h2>

        <div class="grid-products">

            @php
                $destacados = \App\Models\Producto::where('destacado', true)->take(6)->get();
            @endphp

            @forelse($destacados as $p)

                <div class="product-card">
                    <img src="{{ asset('img/Productos/' . $p->imagen) }}">
                    <h5>{{ $p->nombre }}</h5>
                    <p>L. {{ $p->precio }}</p>
                    <button class="btn btn-success add-cart">Agregar</button>
                </div>

            @empty

                <p class="text-center">No hay productos destacados</p>

            @endforelse

        </div>

    </div>

</section>
@endif

@if(($config['ofertas'] ?? 1) == 1)
<!-- 🔥 OFERTAS (YA LO TENÍAS, SOLO LO DEJO BIEN) -->
<section id="ofertas" class="section container mt-5">

    <div class="section-green">

        <h2 class="text-center mb-4">Ofertas</h2>

        <div class="grid-products">

            @php
                $ofertas = \App\Models\Producto::where('oferta', true)->take(3)->get();
            @endphp

            @forelse($ofertas as $p)

                <div class="product-card">
                    <img src="{{ asset('img/Productos/' . $p->imagen) }}">
                    <h5>{{ $p->nombre }}</h5>
                    <p style="color:red; font-weight:bold;">
                        L. {{ $p->precio }}
                    </p>
                    <button class="btn btn-success add-cart">Agregar</button>
                </div>

            @empty

                <p class="text-center">No hay ofertas disponibles</p>

            @endforelse

        </div>

    </div>

</section>
@endif

@endsection