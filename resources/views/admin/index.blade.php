@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="mb-4">
        <h2 class="fw-bold">Dashboard Administrativo</h2>
        <p class="text-muted">Resumen general del sistema</p>
    </div>

    <!-- 🔥 CARDS -->
    <div class="row g-4 mb-4">

    <!-- PRODUCTOS -->
    <div class="col-md-3">
        <div class="card shadow border-0 p-3 hover-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted">Productos</h6>
                    <h3 class="fw-bold">{{ $totalProductos }}</h3>
                </div>
                <div style="font-size:32px;">📦</div>
            </div>
        </div>
    </div>

    <!-- PEDIDOS -->
    <div class="col-md-3">
        <div class="card shadow border-0 p-3 hover-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted">Pedidos</h6>
                    <h3 class="fw-bold">{{ $totalPedidos }}</h3>
                </div>
                <div style="font-size:32px;">🧾</div>
            </div>
        </div>
    </div>

    <!-- PENDIENTES -->
    <div class="col-md-3">
        <div class="card shadow border-0 p-3 hover-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted">Pendientes</h6>
                    <h3 class="fw-bold text-warning">{{ $pendientes }}</h3>
                </div>
                <div style="font-size:32px;">🟡</div>
            </div>
        </div>
    </div>

    <!-- PROCESADOS -->
    <div class="col-md-3">
        <div class="card shadow border-0 p-3 hover-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted">Procesados</h6>
                    <h3 class="fw-bold text-success">{{ $procesados }}</h3>
                </div>
                <div style="font-size:32px;">🟢</div>
            </div>
        </div>
    </div>

</div>

    <!-- 📊 GRÁFICA CENTRADA -->
    <div class="row justify-content-center mb-4">

        <div class="col-md-4">
            <div class="card shadow border-0 p-3 text-center">

                <h6 class="text-muted mb-3">Estado de pedidos</h6>

                <div style="width: 180px; margin:auto;">
                    <canvas id="graficaPedidos"></canvas>
                </div>

            </div>
        </div>

    </div>

    <!-- 🔥 ÚLTIMOS PRODUCTOS -->
    <div class="card shadow border-0 mt-4">

        <div class="card-header bg-dark text-white">
            Últimos productos agregados
        </div>

        <div class="p-3">

            @foreach($productos->take(3) as $p)
                <div class="d-flex align-items-center mb-3">

                    <img src="{{ asset('img/Productos/' . $p->imagen) }}" 
                         width="45" 
                         style="border-radius:8px;">

                    <div class="ms-3">
                        <strong>{{ $p->nombre }}</strong><br>
                        <small class="text-muted">L. {{ $p->precio }}</small>
                    </div>

                </div>
            @endforeach

        </div>

    </div>

    <!-- 🔥 ÚLTIMOS PEDIDOS -->
    <div class="card shadow border-0 mt-4">

        <div class="card-header bg-dark text-white">
            Últimos pedidos
        </div>

        <div class="p-3">

            @foreach(\App\Models\Pedido::latest()->take(3)->get() as $pedido)

                <div class="mb-3">
                    <strong>#{{ $pedido->id }} - {{ $pedido->nombre }}</strong><br>
                    <small class="text-muted">
                        Total: L. {{ $pedido->total }}
                    </small>
                </div>

            @endforeach

        </div>

    </div>

</div>

<!-- 📊 SCRIPT GRÁFICA -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('graficaPedidos');

new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Pendientes', 'Procesados'],
        datasets: [{
            data: [{{ $pendientes }}, {{ $procesados }}],
            backgroundColor: [
                '#facc15',
                '#22c55e'
            ],
            borderWidth: 0
        }]
    },
    options: {
        plugins: {
            legend: {
                position: 'bottom'
            }
        },
        cutout: '70%'
    }
});
</script>

<style>
.hover-card:hover {
    transform: translateY(-5px);
    transition: 0.3s;
}
</style>

@endsection