@php
$config = \App\Models\Configuracion::pluck('valor', 'clave');
@endphp
@extends('layouts.app')

@section('content')

<!-- HERO -->
<header class="hero"
    style="
        background-image: url('{{ url($config['hero'] ?? 'img/Fondo.jpg') }}?v={{ time() }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        padding: 150px 20px 140px;
        text-align: center;
        color: white;
    "
>
    <h1>Despensa Espinoza</h1>
    <p>En el corazon del pueblo Trojeño</p>
</header>

<h2 class="section-title">Nuestras Categorías</h2>

<div class="carousel-categories" id="carouselCategorias">

    <!-- 🔥 CATEGORÍAS FIJAS (LAS QUE YA TENÍAS) -->

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

    <!-- 🔥 CATEGORÍAS DINÁMICAS -->
    @php
    $categorias = \App\Models\Categoria::where('activo', 1)->get();
    @endphp

    @foreach($categorias as $c)
        <a href="/categoria/{{ $c->slug }}" class="cat-card">
            <img src="{{ asset('img/categorias/' . $c->imagen) }}">
            <span>{{ $c->nombre }}</span>
        </a>
    @endforeach

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
                    <button 
                        class="btn btn-success add-cart"
                        data-name="{{ $p->nombre }}"
                        data-price="{{ $p->precio_oferta && $p->precio_oferta < $p->precio ? $p->precio_oferta : $p->precio }}"
                    >
                        Agregar
                    </button>
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

                <div class="product-card" style="position:relative;">

                    <!-- 🔥 BADGE OFERTA -->
                    <span style="
                        position:absolute;
                        top:10px;
                        left:10px;
                        background:red;
                        color:white;
                        padding:5px 10px;
                        border-radius:5px;
                        font-size:12px;
                        font-weight:bold;
                    ">
                        OFERTA
                    </span>

                    <!-- IMAGEN -->
                    <img src="{{ asset('img/Productos/' . $p->imagen) }}">

                    <!-- NOMBRE -->
                    <h5>{{ $p->nombre }}</h5>

                    @if($p->precio_oferta && $p->precio_oferta < $p->precio)

                        <!-- PRECIO VIEJO -->
                        <p style="text-decoration: line-through; color: gray; margin:0;">
                            L. {{ $p->precio }}
                        </p>

                        <!-- PRECIO NUEVO -->
                        <p style="color:red; font-weight:bold; font-size:18px;">
                            L. {{ $p->precio_oferta }}
                        </p>

                    @else

                        <!-- PRECIO NORMAL -->
                        <p>
                            L. {{ $p->precio }}
                        </p>

                    @endif

                    <!-- BOTÓN -->
                    <button 
                        class="btn btn-success add-cart"
                        data-name="{{ $p->nombre }}"
                        data-price="{{ $p->precio_oferta && $p->precio_oferta < $p->precio ? $p->precio_oferta : $p->precio }}"
                    >
                        Agregar
                    </button>

                </div>

            @empty

                <p class="text-center">No hay ofertas disponibles</p>

            @endforelse

        </div>

    </div>

</section>
@endif

@endsection