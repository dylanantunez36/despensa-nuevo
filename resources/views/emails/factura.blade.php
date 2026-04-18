<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: Arial; background:#f4f4f4; padding:20px;">

<div style="max-width:600px; margin:auto; background:white; padding:25px; border-radius:10px;">

    <!-- HEADER -->
    <div style="text-align:center; border-bottom:2px solid #16a34a; padding-bottom:15px;">

        <img src="https://i.imgur.com/4SqCNhk.jpeg" style="width:80px; margin-bottom:10px;">

        <h2 style="color:#16a34a; margin:0;">Despensa Espinoza</h2>

        <p style="margin:0;">Comprobante de pedido</p>

        <p style="margin-top:10px; font-size:14px;">
            Pedido #{{ $pedido_id }}
        </p>

    </div>

    <!-- CLIENTE -->
    <div style="margin-top:20px;">
        <p><strong>Cliente:</strong> {{ $nombre }}</p>

        <p><strong>Tipo de entrega:</strong> 
            {{ $tipo_entrega == 'domicilio' ? 'A domicilio' : 'Recoger en tienda' }}
        </p>

        @if(isset($tipo_entrega) && $tipo_entrega == 'domicilio')
            <p><strong>Dirección:</strong> {{ $direccion }}</p>
        @endif

        <p><strong>Teléfono:</strong> {{ $telefono }}</p>

        <p><strong>Observación:</strong> {{ $observacion }}</p>
    </div>

    <!-- PRODUCTOS -->
    <div style="margin-top:20px;">
        <h4 style="color:#16a34a;">Detalle del pedido</h4>

        <pre style="background:#f9f9f9; padding:15px; border-radius:8px;">
{{ $detalle }}
        </pre>
    </div>

    <!-- TOTAL -->
    <div style="margin-top:20px; text-align:right;">
        <h3 style="color:#16a34a;">Total: L. {{ $total }}</h3>
    </div>

    <!-- FOOTER -->
    <p style="color:#555; font-size:14px;">
        Su pedido ha sido recibido correctamente y está siendo procesado.
        Nos comunicaremos con usted cuando esté listo.
    </p>

</div>

</body>
</html>