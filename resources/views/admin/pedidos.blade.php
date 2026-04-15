@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <h2 class="mb-4">Pedidos Recibidos</h2>

    <a href="/admin" class="btn btn-secondary mb-3">← Volver</a>

    <table class="table table-bordered">

        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Total</th>
                <th>Fecha</th>
            </tr>
        </thead>

        <tbody>

            @foreach($pedidos as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->nombre }}</td>
                <td>{{ $p->telefono }}</td>
                <td>{{ $p->direccion }}</td>
                <td>L. {{ $p->total }}</td>
                <td>{{ $p->created_at }}</td>
            </tr>
            @endforeach

        </tbody>

    </table>

</div>

@endsection