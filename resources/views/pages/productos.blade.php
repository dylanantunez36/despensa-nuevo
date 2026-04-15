@extends('layouts.app')

@section('content')

<header class="hero">
    <h1>PRODUCTOS</h1>
</header>

<div class="container">

    <div class="grid">

        <div class="card">
            <img src="{{ asset('img/Productos/cafeoro.jpg') }}">
            <h5>Café Oro</h5>
            <p>L. 75</p>
            <button class="btn btn-success add-cart">Agregar</button>
        </div>

        <div class="card">
            <img src="{{ asset('img/Productos/panartesano.jpg') }}">
            <h5>Pan Artesano</h5>
            <p>L. 30</p>
            <button class="btn btn-success add-cart">Agregar</button>
        </div>

    </div>

</div>

@endsection