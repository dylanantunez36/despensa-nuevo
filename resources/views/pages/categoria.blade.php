@php
$config = \App\Models\Configuracion::pluck('valor', 'clave');
@endphp

@extends('layouts.app')

@section('content')

<header class="hero"
style="background:
linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.5)),
url('{{ asset($config['hero'] ?? 'img/Fondo.jpg') }}') !important;
background-size: cover;
background-position: center;">

<h2 class="section-title text-center mt-4 text-white">
    {{ $nombre }}
</h2>

<div class="container mt-5">

    <div class="grid-products">

        @if(count($productos) > 0)

            @foreach($productos as $producto)

                <div class="product-card">
                    <img src="{{ asset('img/Productos/' . $producto->imagen) }}">
                    <h5>{{ $producto->nombre }}</h5>
                    <p>L. {{ $producto->precio }}</p>
                    <button class="btn btn-success add-cart">Agregar</button>
                </div>

            @endforeach

        @else

            {{-- 🔥 FALLBACK VISUAL (NO ROMPE NADA) --}}

            @if($nombre == 'Abarrotes')

                <div class="product-card">
                    <img src="{{ asset('img/Productos/cafeoro.jpg') }}">
                    <h5>Café Oro</h5>
                    <p>L. 75.00</p>
                    <button class="btn btn-success add-cart">Agregar</button>
                </div>

                <div class="product-card">
                    <img src="{{ asset('img/Productos/harina.webp') }}">
                    <h5>Harina</h5>
                    <p>L. 40.00</p>
                    <button class="btn btn-success add-cart">Agregar</button>
                </div>

                <div class="product-card">
                    <img src="{{ asset('img/Productos/frijoles.webp') }}">
                    <h5>Frijoles</h5>
                    <p>L. 25.00</p>
                    <button class="btn btn-success add-cart">Agregar</button>
                </div>

            @elseif($nombre == 'Higiene')

                <div class="product-card">
                    <img src="{{ asset('img/Productos/colgate.jpg') }}">
                    <h5>Pasta Colgate</h5>
                    <p>L. 45.00</p>
                    <button class="btn btn-success add-cart">Agregar</button>
                </div>

                <div class="product-card">
                    <img src="{{ asset('img/Productos/desodorante.jpg') }}">
                    <h5>Desodorante</h5>
                    <p>L. 60.00</p>
                    <button class="btn btn-success add-cart">Agregar</button>
                </div>

                <div class="product-card">
                    <img src="{{ asset('img/Productos/rasuradora.png') }}">
                    <h5>Rasuradora</h5>
                    <p>L. 150.00</p>
                    <button class="btn btn-success add-cart">Agregar</button>
                </div>

            @elseif($nombre == 'Bebes')

                <div class="product-card">
                    <img src="{{ asset('img/Productos/pampers.webp') }}">
                    <h5>Pampers</h5>
                    <p>L. 150.00</p>
                    <button class="btn btn-success add-cart">Agregar</button>
                </div>

                <div class="product-card">
                    <img src="{{ asset('img/Productos/nido.webp') }}">
                    <h5>Leche Nido</h5>
                    <p>L. 120.00</p>
                    <button class="btn btn-success add-cart">Agregar</button>
                </div>

            @elseif($nombre == 'Lacteos')

                <div class="product-card">
                    <img src="{{ asset('img/Productos/Leche Entera.webp') }}">
                    <h5>Leche Entera</h5>
                    <p>L. 30.00</p>
                    <button class="btn btn-success add-cart">Agregar</button>
                </div>

                <div class="product-card">
                    <img src="{{ asset('img/Productos/Queso semiduro.jpg') }}">
                    <h5>Queso</h5>
                    <p>L. 60.00</p>
                    <button class="btn btn-success add-cart">Agregar</button>
                </div>

            @elseif($nombre == 'Carnes')

                <div class="product-card">
                    <img src="{{ asset('img/Productos/Chuleta de cerdo.jpg') }}">
                    <h5>Chuleta</h5>
                    <p>L. 115.00</p>
                    <button class="btn btn-success add-cart">Agregar</button>
                </div>

                <div class="product-card">
                    <img src="{{ asset('img/Productos/pollo.webp') }}">
                    <h5>Pollo</h5>
                    <p>L. 90.00</p>
                    <button class="btn btn-success add-cart">Agregar</button>
                </div>

            @endif

        @endif

    </div>

</div>

@endsection