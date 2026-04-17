@extends('layouts.app')

@section('content')

<div class="checkout-container">

    <div class="checkout-card">

        <h2 class="checkout-title">Finalizar Compra</h2>

        <form>

            <div class="form-group">
                <label>Nombre completo</label>
                <input type="text" id="nombre" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Teléfono</label>
                <input type="text" id="telefono" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Correo electrónico</label>
                <input type="email" id="email" class="form-control" required>
            </div>

            <!-- 🔥 TIPO ENTREGA -->
            <div class="form-group">
                <label>Tipo de entrega</label>
                <select id="tipo_entrega" class="form-control" onchange="toggleDireccion()">
                    <option value="domicilio">Entrega a domicilio</option>
                    <option value="tienda">Recoger en tienda</option>
                </select>
            </div>

            <!-- 🔥 DIRECCIÓN -->
            <div class="form-group" id="direccionContainer">
                <label>Dirección</label>
                <input type="text" id="direccion" class="form-control">
            </div>

            <!-- 🔥 OBSERVACIÓN -->
            <div class="form-group">
                <label>Observación</label>
                <textarea id="observacion" class="form-control"></textarea>
            </div>

            <div class="checkout-total">
                <h4>Total a pagar: <span id="checkout-total">L. 0</span></h4>
            </div>

            <button type="button" onclick="confirmarPedido()" class="btn-checkout">
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
    let telefono = document.getElementById('telefono').value;
    let email = document.getElementById('email').value;
    let tipo_entrega = document.getElementById('tipo_entrega').value;

    let direccionInput = document.getElementById('direccion');
    let direccion = direccionInput ? direccionInput.value : "";

    let observacion = document.getElementById('observacion').value;

    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    let detalle = cart.map(p => `${p.name} x${p.qty} - L. ${p.price}`).join('\n');

    let total = cart.reduce((sum, p) => sum + (p.price * p.qty), 0);

    // 🔥 VALIDACIONES
    if (!nombre || !telefono || !email) {
        alert("Completa todos los campos");
        return;
    }

    if (tipo_entrega === 'domicilio' && (!direccion || direccion.trim() === "")) {
        alert("Debes ingresar dirección");
        return;
    }

    fetch('/enviar-pedido', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            nombre,
            telefono,
            email,
            tipo_entrega,
            direccion: tipo_entrega === 'domicilio' ? direccion : null,
            observacion,
            detalle,
            total
        })
    })
    .then(async res => {

        let data = await res.json().catch(() => ({}));

        if (!res.ok) {
            console.error("ERROR BACKEND:", data);
            throw new Error("Error " + res.status);
        }

        return data;
    })
    .then(data => {
        alert("✅ Pedido enviado correctamente");
        localStorage.removeItem('cart');
        window.location.href = "/";
    })
    .catch(err => {
        console.error("ERROR:", err);
        alert("Error al enviar pedido");
    });

}

function toggleDireccion() {
    let tipo = document.getElementById('tipo_entrega').value;
    let cont = document.getElementById('direccionContainer');

    cont.style.display = tipo === 'domicilio' ? 'block' : 'none';
}

// 🔥 INICIAL
toggleDireccion();
</script>

@endsection