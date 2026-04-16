<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: Arial; background:#f4f4f4; padding:20px;">

<div style="max-width:600px; margin:auto; background:white; padding:20px; border-radius:10px;">

    <div style="text-align:center;">
        <h2 style="color:#16a34a;">Despensa Espinoza</h2>
        <img src="https://i.imgur.com/4SqCNhk.jpeg" width="120">
    </div>

    <hr>

    <h3 style="color:#333;">¡Tu pedido está listo! 🎉</h3>

    <p>Hola <strong>{{ $nombre }}</strong>,</p>

    <p>
        Tu pedido ya fue preparado con éxito.
    </p>

    @if($tipo_entrega == 'domicilio')
        <p>🚚 En breve será enviado a tu dirección.</p>
    @else
        <p>🏪 Ya puedes pasar a recogerlo en tienda.</p>
    @endif

    <hr>

    <p style="font-size:13px; color:#777;">
        Gracias por confiar en Despensa Espinoza.
    </p>

</div>

</body>
</html>