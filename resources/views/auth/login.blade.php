<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link rel="icon" href="{{ asset('img/logo.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    @php
    $config = \App\Models\Configuracion::pluck('valor', 'clave');
    @endphp

    <link rel="icon" href="{{ asset($config['logo'] ?? 'img/logo.jpg') }}">

    <style>
        /* FONDO */
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            height: 100vh;

            background: linear-gradient(
                rgba(0,0,0,0.3),
                rgba(0,0,0,0.4)
            ),
                url('/img/Fondo.jpg');

            background-size: cover;
            background-position: center;

            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* CARD */
        .login-card {
            width: 100%;
            max-width: 400px;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.25);
            animation: fadeIn 0.6s ease;
        }

        /* TÍTULO */
        .login-title {
            text-align: center;
            font-weight: 800;
            margin-bottom: 20px;
        }

        /* INPUTS */
        .form-control {
            border-radius: 12px;
            padding: 12px;
        }

        .form-control:focus {
            border-color: #16a34a;
            box-shadow: 0 0 0 3px rgba(22,163,74,0.2);
        }

        /* BOTÓN */
        .btn-login {
            width: 100%;
            padding: 12px;
            background: #16a34a;
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: #15803d;
            transform: translateY(-2px);
        }

        /* ERROR */
        .alert {
            border-radius: 12px;
            font-size: 14px;
        }

        /* ANIMACIÓN */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* MARCA */
        .brand {
            text-align: center;
            font-size: 14px;
            margin-bottom: 10px;
            color: #555;
        }

    </style>
</head>
<body>

<div class="login-card">

    <div class="brand">Despensa Espinoza</div>

    <h2 class="login-title">LOGIN</h2>

    @if(session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <input type="text" name="usuario" placeholder="Usuario" class="form-control mb-3" required>

        <input type="password" name="password" placeholder="Contraseña" class="form-control mb-3" required>

        <button class="btn-login">Ingresar</button>

    </form>

</div>

</body>
</html>