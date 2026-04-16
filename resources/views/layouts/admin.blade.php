<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Admin - Despensa</title>

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
        }

        .sidebar a:hover {
            background: #1f2937;
            color: white;
        }

        .content {
            margin-left: 240px;
            padding: 30px;
        }
    </style>
</head>

<body>

<div class="sidebar">

    <h4>🛒 Admin</h4>

    <a href="/admin">Dashboard</a>
    <a href="/admin/productos">Productos</a>
    <a href="/admin/pedidos">Pedidos</a>
    <hr>
    <a href="/logout" class="text-danger">Cerrar sesión</a>

</div>

<div class="content">
    @yield('content')
</div>

</body>
</html>