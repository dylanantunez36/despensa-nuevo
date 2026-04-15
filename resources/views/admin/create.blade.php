@extends('layouts.app')

@section('content')

<div class="admin-container">

    <div class="admin-card">

        <h2 class="admin-title">Agregar Producto</h2>

        <form method="POST" action="/admin/store" enctype="multipart/form-data">
            @csrf

            <!-- NOMBRE -->
            <div class="form-group">
                <label>Nombre del producto</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>

            <!-- PRECIO -->
            <div class="form-group">
                <label>Precio (Lempiras)</label>
                <input type="number" step="0.01" name="precio" class="form-control" required>
            </div>

            <!-- CATEGORÍA -->
            <div class="form-group">
                <label>Categoría</label>
                <select name="categoria" class="form-control" required>
                    <option value="">Seleccionar</option>
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
            <div class="form-group">
                <label>Imagen del producto</label>
                <input type="file" name="imagen" class="form-control" required>
            </div>

            <!-- BOTÓN -->
            <button class="btn-admin">Guardar Producto</button>

        </form>

    </div>

</div>

@endsection