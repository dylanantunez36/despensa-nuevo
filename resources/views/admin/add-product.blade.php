@extends('layouts.app')

@section('content')

<div class="container mt-5" style="max-width:600px;">

    <h2 class="mb-4">Agregar Producto</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="/guardar-producto" enctype="multipart/form-data">
        @csrf

        <!-- NOMBRE -->
        <label class="form-label fw-bold">Nombre del producto</label>
        <input type="text" name="nombre" class="form-control mb-3" placeholder="Ej: Café Oro" required>

        <!-- PRECIO -->
        <label class="form-label fw-bold">Precio (Lempiras)</label>
        <input type="number" step="0.01" name="precio" class="form-control mb-3" placeholder="Ej: 75.00" required>

        <!-- IMAGEN -->
        <label class="form-label fw-bold">Imagen del producto</label>
        <input type="file" name="imagen" class="form-control mb-3" accept="image/*" required>

        <!-- CATEGORIA -->
        <label class="form-label fw-bold">Categoría</label>
        <select name="categoria" class="form-control mb-3" required>

            <option value="">-- Seleccionar categoría --</option>

            <option value="abarrotes">Abarrotes</option>
            <option value="higiene">Higiene y Belleza</option>
            <option value="bebes">Bebés y Niños</option>
            <option value="limpieza">Limpieza</option>
            <option value="jugos">Jugos y Bebidas</option>
            <option value="farmacia">Farmacia</option>
            <option value="lacteos">Lácteos</option>
            <option value="carnes">Carnes y Pescado</option>
            <option value="vinos">Vinos y Licores</option>
            <option value="embutidos">Embutidos</option>
            <option value="panaderia">Panadería</option>
            <option value="congelados">Alimentos Congelados</option>

        </select>

        <button class="btn btn-success w-100">
            Guardar Producto
        </button>

    </form>

</div>

@endsection