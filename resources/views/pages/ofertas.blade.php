@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <h2 class="text-center mb-4">Ofertas Especiales</h2>

    <div class="grid-products">

        @forelse($productos as $p)

        <div class="product-card position-relative">

            <!-- BADGE -->
            <span class="badge bg-danger position-absolute top-0 start-0 m-2">
                OFERTA
            </span>

            <img src="{{ asset('img/Productos/'.$p->imagen) }}">
            <h5>{{ $p->nombre }}</h5>

            <!-- PRECIO -->
            <p style="color:#16a34a; font-weight:bold;">
                L. {{ $p->precio }}
            </p>

            <button class="btn btn-success add-cart">Agregar</button>

        </div>

        @empty
            <p class="text-center">No hay ofertas disponibles</p>
        @endforelse

    </div>

</div>

@endsection