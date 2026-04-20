@extends('layouts.admin')

@section('content')

<div class="container mt-5">

    <h2>Editar Producto</h2>

    <a href="/admin/productos" class="btn btn-secondary mb-3">
        ← Volver
    </a>

    <form action="/admin/update/{{ $producto->id }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- NOMBRE -->
        <input type="text" name="nombre" value="{{ $producto->nombre }}" class="form-control mb-2">

        <!-- PRECIO -->
        <input type="number" name="precio" id="precioNormal" value="{{ $producto->precio }}" class="form-control mb-2">

        <!-- OFERTA -->
        <div class="form-group mb-2">
            <label>
                <input type="checkbox" name="oferta" value="1" id="chkOferta"
                    {{ $producto->oferta ? 'checked' : '' }}>
                Producto en oferta
            </label>
        </div>

        <!-- PRECIO OFERTA -->
        <div class="form-group mb-2" id="campoOferta"
            style="{{ $producto->oferta ? '' : 'display:none;' }}">
            <input type="number" step="0.01" name="precio_oferta" id="precioOferta"
                value="{{ $producto->precio_oferta }}"
                class="form-control" placeholder="Precio en oferta">
        </div>

        <!-- CATEGORIA -->
        <input type="text" name="categoria" value="{{ $producto->categoria }}" class="form-control mb-2">

        <!-- IMAGEN -->
        <input type="file" name="imagen" class="form-control mb-3">

        <button class="btn btn-success">Actualizar</button>

    </form>

</div>

<!-- 🔥 JS -->
<script>
document.getElementById('chkOferta').addEventListener('change', function() {
    document.getElementById('campoOferta').style.display =
        this.checked ? 'block' : 'none';
});

// 🔥 VALIDACIÓN
document.querySelector('form').addEventListener('submit', function(e){
    let precio = parseFloat(document.getElementById('precioNormal').value);
    let oferta = document.getElementById('chkOferta').checked;
    let precioOferta = parseFloat(document.getElementById('precioOferta').value);

    if(oferta && precioOferta >= precio){
        e.preventDefault();
        alert('El precio de oferta debe ser menor al precio normal');
    }
});
</script>

@endsection