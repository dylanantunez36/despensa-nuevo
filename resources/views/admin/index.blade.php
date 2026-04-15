@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="mb-0">Panel Administrador</h2>
            <small class="text-muted">Gestión de productos</small>
        </div>

        <a href="/logout" class="btn btn-danger">
            Cerrar sesión
        </a>

    </div>

    <!-- INFO -->
    <div class="mb-3">
        <p>Total de productos: <strong>{{ count($productos) }}</strong></p>
    </div>

    <!-- BOTONES SUPERIORES -->
    <div class="mb-3 d-flex gap-2">
        <a href="/admin/create" class="btn btn-success">
            + Agregar Producto
        </a>

        <a href="/admin/pedidos" class="btn btn-primary">
            Ver Pedidos
        </a>

    </div>

    <!-- TABLA -->
    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">

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

                @forelse($productos as $p)
                <tr>

                    <td>
                        <img src="{{ asset('img/Productos/' . $p->imagen) }}" 
                             width="60" 
                             style="border-radius:8px;">
                    </td>

                    <td>{{ $p->nombre }}</td>

                    <td style="color:#16a34a; font-weight:bold;">
                        L. {{ $p->precio }}
                    </td>

                    <td>{{ ucfirst($p->categoria) }}</td>

                    <td>

                        <!-- EDITAR -->
                        <a href="/admin/edit/{{ $p->id }}" class="btn btn-warning btn-sm">
                            Editar
                        </a>

                        <!-- ELIMINAR -->
                        <a href="/admin/delete/{{ $p->id }}" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('¿Eliminar producto?')">
                            Eliminar
                        </a>

                        <!-- OFERTA -->
                        <form action="/admin/oferta/{{ $p->id }}" 
                              method="POST" 
                              style="display:inline;">
                            @csrf
                            <button class="btn btn-info btn-sm">
                                {{ $p->oferta ? 'Quitar Oferta' : 'Poner Oferta' }}
                            </button>
                        </form>

                    </td>

                </tr>
                @empty

                <tr>
                    <td colspan="5">No hay productos</td>
                </tr>

                @endforelse

            </tbody>

        </table>
    </div>

</div>

@endsection