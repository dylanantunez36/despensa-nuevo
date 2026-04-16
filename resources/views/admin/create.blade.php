@extends('layouts.admin')

@section('content')

<div class="container">

    <!-- HEADER -->
    <div class="mb-3">
        <h2 class="fw-bold">Agregar Producto</h2>
    </div>

    <!-- BOTÓN VOLVER (IZQUIERDA BONITO) -->
    <a href="/admin/productos" class="btn btn-secondary mb-4">
        ← Volver
    </a>

    <!-- FORM CARD MEJORADA -->
    <div class="card shadow border-0 p-4" style="border-radius:15px;">

        <form action="/admin/store" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-4">

                <!-- NOMBRE -->
                <div class="col-md-6">
                    <label class="mb-1 fw-semibold">Nombre del producto</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <!-- PRECIO -->
                <div class="col-md-6">
                    <label class="mb-1 fw-semibold">Precio</label>
                    <input type="number" step="0.01" name="precio" class="form-control" required>
                </div>

                <!-- CATEGORIA -->
                <div class="col-md-6">
                    <label class="mb-1 fw-semibold">Categoría</label>
                    <select name="categoria" class="form-control">

                        <option value="abarrotes">Abarrotes</option>
                        <option value="higiene">Higiene y Belleza</option>
                        <option value="bebes">Bebés y Niños</option>
                        <option value="limpieza">Limpieza</option>
                        <option value="bebidas">Jugos y Bebidas</option>
                        <option value="farmacia">Farmacia</option>
                        <option value="lacteos">Lácteos</option>
                        <option value="carnes">Carnes y Pescado</option>
                        <option value="vinos">Vinos y Licores</option>
                        <option value="embutidos">Embutidos</option>
                        <option value="panaderia">Panadería</option>
                        <option value="congelados">Congelados</option>
                        <option value="frutas">Frutas y Verduras</option>

                    </select>
                </div>

                <!-- IMAGEN -->
                <div class="col-md-6">
                    <label class="mb-1 fw-semibold">Imagen del producto</label>
                    <input type="file" name="imagen" class="form-control" required>
                </div>

            </div>

            <!-- BOTÓN -->
            <div class="mt-4 text-end">
                <button class="btn btn-success px-4 shadow-sm">
                    Guardar Producto
                </button>
            </div>

        </form>

    </div>

</div>

@endsection