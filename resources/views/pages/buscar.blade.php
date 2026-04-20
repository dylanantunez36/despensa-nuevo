@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <h2>Resultados para: "{{ $q }}"</h2>

    <div class="grid-products mt-4">

        @forelse($productos as $p)

            <div class="product-card">
                <img src="{{ asset('img/Productos/' . $p->imagen) }}">
                <h5>{{ $p->nombre }}</h5>

                @if($p->oferta && $p->precio_oferta)
                    <p>
                        <span style="text-decoration: line-through; color: gray;">
                            L. {{ $p->precio }}
                        </span>
                        <span style="color:red; font-weight:bold;">
                            L. {{ $p->precio_oferta }}
                        </span>
                    </p>
                @else
                    <p>L. {{ $p->precio }}</p>
                @endif

                <button class="btn btn-success add-cart">Agregar</button>
            </div>

        @empty
            <p>No se encontraron productos</p>
        @endforelse

    </div>

</div>

@endsection