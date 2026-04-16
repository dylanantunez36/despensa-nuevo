@extends('layouts.admin')

@section('content')

<div class="container">

    <!-- HEADER -->
    <div class="mb-3">
        <h2 class="fw-bold">Agregar Producto</h2>
    </div>

    <a href="/admin" class="btn btn-secondary mb-3">
        ← Volver
    </a>

    <!-- FORM CARD -->
    <div class="card shadow border-0 p-4">

        <form action="/admin/store" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">

                <!-- NOMBRE -->
                <div class="col-md-6">
                    <label>Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <!-- PRECIO -->
                <div class="col-md-6">
                    <label>Precio</label>
                    <input type="number" step="0.01" name="precio" class="form-control" required>
                </div>

                <!-- CATEGORIA -->
                <div class="col-md-6">
                    <label>Categoría</label>
                    <select name="categoria" class="form-control">
                        <option value="alimentos">Alimentos</option>
                        <option value="bebidas">Bebidas</option>
                        <option value="higiene">Higiene</option>
                    </select>
                </div>

                <!-- IMAGEN -->
                <div class="col-md-6">
                    <label>Imagen</label>
                    <input type="file" name="imagen" class="form-control" required>
                </div>

            </div>

            <!-- BOTÓN -->
            <div class="mt-4 text-end">
                <button class="btn btn-success px-4">
                    Guardar Producto
                </button>
            </div>

        </form>

    </div>

</div>

@endsection