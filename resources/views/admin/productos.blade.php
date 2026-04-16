@extends('layouts.admin')

@section('content')

<div class="container">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Productos</h2>

        <a href="/admin/create" class="btn btn-success shadow-sm">
            + Nuevo Producto
        </a>
    </div>

    <a href="/admin" class="btn btn-secondary mb-3">← Volver</a>

    <!-- 🔍 BUSCADOR + FILTRO -->
    <div class="row mb-4">

        <!-- BUSCAR -->
        <div class="col-md-6">
            <input 
                type="text" 
                id="buscador" 
                class="form-control" 
                placeholder="🔍 Buscar producto...">
        </div>

        <!-- FILTRO -->
        <div class="col-md-4">
            <select id="filtroCategoria" class="form-control">
                <option value="">Todas las categorías</option>

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

    </div>

    <!-- TABLA -->
    <div class="table-responsive">

        <table class="table table-bordered text-center align-middle" id="tablaProductos">

            <thead class="table-dark">
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                @foreach($productos as $p)
                <tr data-nombre="{{ strtolower($p->nombre) }}" data-categoria="{{ strtolower($p->categoria) }}">

                    <td>
                        <img src="{{ asset('img/Productos/' . $p->imagen) }}" width="60">
                    </td>

                    <td>{{ $p->nombre }}</td>

                    <td style="color:#16a34a; font-weight:bold;">
                        L. {{ $p->precio }}
                    </td>

                    <td>{{ ucfirst($p->categoria) }}</td>

                    <td>

                        <a href="/admin/edit/{{ $p->id }}" class="btn btn-warning btn-sm">
                            Editar
                        </a>

                        <a href="/admin/delete/{{ $p->id }}" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('¿Eliminar producto?')">
                            Eliminar
                        </a>

                        <form action="/admin/oferta/{{ $p->id }}" method="POST" style="display:inline;">
                            @csrf
                            <button class="btn btn-info btn-sm">
                                {{ $p->oferta ? 'Quitar Oferta' : 'Poner Oferta' }}
                            </button>
                        </form>

                    </td>

                </tr>
                @endforeach

            </tbody>

        </table>

    </div>

</div>

<!-- 🔥 SCRIPT BUSCADOR + FILTRO -->
<script>

const buscador = document.getElementById('buscador');
const filtro = document.getElementById('filtroCategoria');
const filas = document.querySelectorAll('#tablaProductos tbody tr');

function filtrar() {

    let texto = buscador.value.toLowerCase();
    let categoria = filtro.value.toLowerCase();

    filas.forEach(fila => {

        let nombre = fila.dataset.nombre;
        let cat = fila.dataset.categoria;

        let coincideTexto = nombre.includes(texto);
        let coincideCategoria = categoria === "" || cat === categoria;

        if (coincideTexto && coincideCategoria) {
            fila.style.display = "";
        } else {
            fila.style.display = "none";
        }

    });
}

buscador.addEventListener('keyup', filtrar);
filtro.addEventListener('change', filtrar);

</script>

@endsection