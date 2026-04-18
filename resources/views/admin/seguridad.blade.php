@extends('layouts.admin')

@section('content')

<div class="container mt-5">

    <h2 class="mb-4">Seguridad</h2>

    <a href="/admin" class="btn btn-secondary mb-3">
        ← Volver
    </a>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow border-0 p-4">

        <form method="POST" action="/admin/seguridad">
            @csrf

            <div class="mb-3">
                <label>Contraseña actual</label>
                <input type="password" name="actual" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Nueva contraseña</label>
                <input type="password" name="nueva" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Confirmar contraseña</label>
                <input type="password" name="confirmar" class="form-control" required>
            </div>

            <button class="btn btn-primary">
                Cambiar contraseña
            </button>

        </form>

    </div>

</div>

@endsection