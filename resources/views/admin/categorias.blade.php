@extends('layouts.admin')

@section('content')

<div class="container mt-5">

    <h2>Categorías</h2>

    <a href="/admin" class="btn btn-secondary mb-3">← Volver</a>

    <!-- CREAR -->
    <form action="/admin/categorias/store" method="POST" enctype="multipart/form-data" class="mb-4">
        @csrf

        <input type="text" name="nombre" placeholder="Nombre categoría" class="form-control mb-2" required>
        <input type="file" name="imagen" class="form-control mb-2" required>

        <button class="btn btn-success">Crear categoría</button>
    </form>

    <!-- LISTA -->
    <table class="table table-bordered text-center">

        <tr>
            <th>Nombre</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>

        @foreach($categorias as $c)
        <tr>
            <td>{{ $c->nombre }}</td>

            <td>
                @if($c->activo)
                    <span class="badge bg-success">Activa</span>
                @else
                    <span class="badge bg-secondary">Oculta</span>
                @endif
            </td>

            <td>
                <a href="/admin/categorias/toggle/{{ $c->id }}" class="btn btn-warning btn-sm">Activar/Desactivar</a>
                <a href="/admin/categorias/delete/{{ $c->id }}" class="btn btn-danger btn-sm">Eliminar</a>
            </td>
        </tr>
        @endforeach

    </table>

</div>

@endsection