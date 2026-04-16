@extends('layouts.admin')

@section('content')

<div class="container mt-5">

    <h2 class="mb-4">Pedidos Recibidos</h2>

    <a href="/admin" class="btn btn-secondary mb-3">← Volver</a>

    <table class="table table-hover shadow-sm align-middle text-center">

        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Total</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
        </thead>

        <tbody>

            @forelse($pedidos as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->nombre }}</td>
                <td>{{ $p->telefono }}</td>
                <td>{{ $p->direccion }}</td>

                <td class="fw-bold text-success">
                    L. {{ $p->total }}
                </td>

                <td>{{ $p->created_at->format('d/m/Y H:i') }}</td>

                <td>
                    @if($p->estado == 'pendiente')
                        <span class="badge bg-warning text-dark">Pendiente</span>
                    @else
                        <span class="badge bg-success">Procesado</span>
                    @endif
                </td>

                <td>
                    @if($p->estado == 'pendiente')
                        <form action="/admin/pedido/{{ $p->id }}/estado" method="POST">
                            @csrf
                            <button class="btn btn-success btn-sm">
                                Marcar como listo
                            </button>
                        </form>
                    @else
                        <span class="text-success fw-bold">✔ Listo</span>
                    @endif
                </td>

            </tr>
            @empty

            <tr>
                <td colspan="8">No hay pedidos</td>
            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection