@extends('layouts.app')

@section('content')

<div class="checkout-container">

    <div class="checkout-card">

        <h2 class="checkout-title">Finalizar Compra</h2>

        <form onsubmit="event.preventDefault(); confirmarPedido();">

            <div class="form-group">
                <label>Tipo de entrega</label>
                <select id="tipo_entrega" class="form-control">
                    <option value="domicilio">Entrega a domicilio</option>
                    <option value="recoger">Recoger en tienda</option>
                </select>
            </div>

            <div class="form-group">
                <label>Nombre completo</label>
                <input type="text" id="nombre" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Dirección de entrega</label>
                <input type="text" id="direccion" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Teléfono</label>
                <input type="text" id="telefono" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Correo electrónico</label>
                <input type="email" id="email" class="form-control" required>
            </div>

            <div class="checkout-total">
                <h4>Total a pagar: <span id="checkout-total">L. 0</span></h4>
            </div>

            <button type="submit" class="btn-checkout">
                Confirmar Pedido
            </button>

        </form>

    </div>

</div>

<!-- 🔥 CALCULAR TOTAL -->
<script>
let cart = JSON.parse(localStorage.getItem('cart')) || [];

function calcularTotal() {
    let total = 0;

    cart.forEach(item => {
        total += item.price * item.qty;
    });

    document.getElementById('checkout-total').innerText = "L. " + total;
}

calcularTotal();
</script>

<!-- 🔥 CONFIRMAR PEDIDO -->
<script>
function confirmarPedido() {

    let nombre = document.getElementById('nombre').value;
    let direccion = document.getElementById('direccion').value;
    let telefono = document.getElementById('telefono').value;
    let email = document.getElementById('email').value;
    let tipo_entrega = document.getElementById('tipo_entrega').value;

    if (!nombre || !direccion || !telefono || !email) {
        alert("Completa todos los campos");
        return;
    }

    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    let detalle = cart.map(p => 
        `${p.name} x${p.qty} - L. ${p.price * p.qty}`
    ).join('\n');

    let total = cart.reduce((sum, p) => 
        sum + (p.price * p.qty), 0
    );

    fetch('/enviar-pedido', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            nombre,
            direccion,
            telefono,
            email,
            detalle,
            total,
            tipo_entrega
        })
    })
    .then(res => res.json())
    .then(data => {
        alert("✅ Pedido enviado correctamente");

        localStorage.removeItem('cart');

        window.location.href = "/";
    })
    .catch(error => {
        console.error(error);
        alert("❌ Error al enviar el pedido");
    });

}
</script>

@endsection