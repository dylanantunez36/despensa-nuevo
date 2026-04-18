<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Admin - Despensa</title>

    <link rel="icon" href="{{ asset('img/logo.jpg') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #f4f6f9;
        }

        .sidebar {
            width: 220px;
            height: 100vh;
            position: fixed;
            background: #111827;
            color: white;
            padding: 20px;
        }

        .sidebar h4 {
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            color: #cbd5e1;
            padding: 10px;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 10px;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background: #1f2937;
            color: white;
        }

        .content {
            margin-left: 240px;
            padding: 30px;
        }

        /* 🔥 NOTIFICACIÓN ANIMADA */
        .notif {
            position: fixed;
            top: 20px;
            right: -300px;
            background: #16a34a;
            color: white;
            padding: 14px 20px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            z-index: 9999;
            font-weight: 600;
            transition: 0.4s;
        }

        .notif.show {
            right: 20px;
        }
    </style>
</head>

<body>

<div class="sidebar">

    <h4>🛒 Admin</h4>

    <a href="/admin">📊 Dashboard</a>
    <a href="/admin/productos">📦 Productos</a>
    <a href="/admin/pedidos">🧾 Pedidos</a>
    <a href="/admin/seguridad">🔐 Seguridad</a>
    <a href="/admin/configuracion">⚙️ Configuración</a>
    <hr>
    <a href="/logout">🚪 Cerrar sesión</a>

</div>

<div class="content">
    @yield('content')
</div>

<!-- 🔔 SONIDO -->
<audio id="notifSound">
    <source src="https://www.soundjay.com/buttons/sounds/button-3.mp3" type="audio/mpeg">
</audio>

<script>
let ultimoPedidoId = null;

// 🔥 ACTIVAR AUDIO UNA VEZ (evita bloqueo navegador)
document.addEventListener('click', () => {
    document.getElementById('notifSound').play().catch(() => {});
}, { once: true });

function checkPedidos() {

    fetch('/admin/check-pedidos')
    .then(res => res.json())
    .then(data => {

        if (!data || data.length === 0) return;

        let pedido = data[0];

        if (ultimoPedidoId === null) {
            ultimoPedidoId = pedido.id;
            return;
        }

        if (pedido.id > ultimoPedidoId) {

            ultimoPedidoId = pedido.id;

            // 🔔 SONIDO
            document.getElementById('notifSound').play().catch(() => {});

            // 🔥 NOTIFICACIÓN
            mostrarNotificacion("🛎️ Nuevo pedido de " + pedido.nombre);

        }

    })
    .catch(() => {}); // evita errores en consola
}

// 🔥 NOTIFICACIÓN PRO
function mostrarNotificacion(mensaje) {

    let notif = document.createElement('div');
    notif.classList.add('notif');
    notif.innerText = mensaje;

    document.body.appendChild(notif);

    setTimeout(() => notif.classList.add('show'), 100);

    setTimeout(() => {
        notif.classList.remove('show');
        setTimeout(() => notif.remove(), 400);
    }, 4000);
}

// 🔁 LOOP
setInterval(checkPedidos, 5000);

</script>

</body>
</html>