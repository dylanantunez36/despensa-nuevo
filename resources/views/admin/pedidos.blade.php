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
                <th>Entrega</th>
                <th>Dirección</th>
                <th>Observación</th>
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

                <!-- 🔥 ENTREGA BONITA -->
                <td>
                    @if($p->tipo_entrega == 'domicilio')
                        <span class="badge bg-primary">Domicilio</span>
                    @else
                        <span class="badge bg-secondary">Tienda</span>
                    @endif
                </td>

                <!-- 🔥 DIRECCIÓN CONDICIONAL -->
                <td>
                    @if($p->tipo_entrega == 'domicilio')
                        {{ $p->direccion }}
                    @else
                        <span class="text-muted">---</span>
                    @endif
                </td>

                <!-- 🔥 OBSERVACIÓN -->
                <td>
                    {{ $p->observacion ?? '---' }}
                </td>

                <!-- 🔥 TOTAL -->
                <td class="fw-bold text-success">
                    L. {{ $p->total }}
                </td>

                <!-- 🔥 FECHA -->
                <td>
                    {{ $p->created_at->format('d/m/Y H:i') }}
                </td>

                <!-- 🔥 ESTADO -->
                <td>
                    @if($p->estado == 'pendiente')
                        <span class="badge bg-warning text-dark">Pendiente</span>
                    @else
                        <span class="badge bg-success">Procesado</span>
                    @endif
                </td>

                <!-- 🔥 ACCIÓN -->
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
                <td colspan="10">No hay pedidos</td>
            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection