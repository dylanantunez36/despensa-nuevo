@extends('layouts.admin')

@section('content')

<div class="container mt-5">

    <h2>Editar Producto</h2>

    <form action="/admin/update/{{ $producto->id }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="nombre" value="{{ $producto->nombre }}" class="form-control mb-2">
        <input type="number" name="precio" value="{{ $producto->precio }}" class="form-control mb-2">

        <input type="text" name="categoria" value="{{ $producto->categoria }}" class="form-control mb-2">

        <input type="file" name="imagen" class="form-control mb-3">

        <button class="btn btn-success">Actualizar</button>

    </form>

</div>

@endsection