@extends('layouts.admin')

@section('content')

<div class="container mt-5">

    <h2 class="mb-4">Configuración del Sistema</h2>
    
    <a href="/admin" class="btn btn-secondary mb-3">
        ← Volver
    </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="/admin/configuracion" enctype="multipart/form-data">
        @csrf

        <!-- LOGO -->
        <div class="mb-3">
            <label>CAMBIAR LOGO</label>
            <input type="file" name="logo" class="form-control">
        </div>

        <!-- IMAGEN HERO -->
        <div class="mb-3">
            <label>Imagen del encabezado</label>
            <input type="file" name="hero" class="form-control">
        </div>

        <!-- ACTIVAR DESTACADOS -->
        <div class="mb-3">
            <label>Mostrar productos destacados</label>
            <select name="destacados" class="form-control">
                <option value="1" {{ ($config['destacados'] ?? '') == 1 ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ ($config['destacados'] ?? '') == 0 ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <!-- ACTIVAR OFERTAS -->
        <div class="mb-3">
            <label>Mostrar ofertas</label>
            <select name="ofertas" class="form-control">
                <option value="1" {{ ($config['ofertas'] ?? '') == 1 ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ ($config['ofertas'] ?? '') == 0 ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <button class="btn btn-success">
            Guardar cambios
        </button>

    </form>

</div>

@endsection