<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Despensa Espinoza</title>

    @php
    $logo = \App\Models\Configuracion::where('clave','logo')->value('valor');
    @endphp

    <link rel="icon" href="{{ asset($logo ?? 'img/logo.jpg') }}">

    @php
    $config = \App\Models\Configuracion::pluck('valor', 'clave');
    @endphp

    <link rel="icon" href="{{ asset($config['logo'] ?? 'img/logo.jpg') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

@include('components.navbar')

<main>
    @yield('content')
</main>

<!-- 🛒 CARRITO MEJORADO -->
<div id="cart-panel" style="
    position: fixed;
    top: 0;
    right: -400px;
    width: 350px;
    height: 100%;
    background: #fff;
    box-shadow: -5px 0 20px rgba(0,0,0,0.2);
    transition: 0.3s;
    z-index: 9999;
    display: flex;
    flex-direction: column;
">

    <!-- HEADER -->
    <div style="
        background:#16a34a;
        color:white;
        padding:15px;
        display:flex;
        justify-content:space-between;
        align-items:center;
        font-weight:bold;
    ">
        🛒 Tu carrito
        <span id="cart-close" style="cursor:pointer; font-size:20px;">✖</span>
    </div>

    <!-- ITEMS -->
    <div id="cart-items" style="
        flex:1;
        overflow-y:auto;
        padding:15px;
    "></div>

    <!-- FOOTER -->
    <div style="
        border-top:1px solid #eee;
        padding:15px;
    ">
        <h5>Total:</h5>
        <h4 id="cart-total" style="color:#16a34a;">L. 0</h4>

        <button id="clear-cart" class="btn btn-outline-danger w-100 mb-2">
            Vaciar carrito
        </button>

        <button id="checkout-btn" class="btn btn-success w-100">
            Finalizar pedido
        </button>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    const cartPanel = document.getElementById('cart-panel');
    const cartToggle = document.getElementById('cart-toggle');
    const cartClose = document.getElementById('cart-close');
    const cartItems = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');
    const cartCount = document.getElementById('cart-count');
    const clearCart = document.getElementById('clear-cart');

    if(cartToggle){
        cartToggle.onclick = () => cartPanel.style.right = "0";
    }

    if(cartClose){
        cartClose.onclick = () => cartPanel.style.right = "-400px";
    }

    function saveCart() {
        localStorage.setItem('cart', JSON.stringify(cart));
    }

    function addToCart(name, price) {
        let existing = cart.find(p => p.name === name);

        if (existing) {
            existing.qty += 1;
        } else {
            cart.push({ name, price, qty: 1 });
        }

        saveCart();
        renderCart();
    }

    window.removeItem = function(index) {
        cart.splice(index, 1);
        saveCart();
        renderCart();
    }

    window.changeQty = function(index, amount) {
        cart[index].qty += amount;

        if (cart[index].qty <= 0) {
            cart.splice(index, 1);
        }

        saveCart();
        renderCart();
    }

    function renderCart() {
        if(!cartItems) return;

        cartItems.innerHTML = '';
        let total = 0;

        cart.forEach((item, index) => {
            let subtotal = item.price * item.qty;
            total += subtotal;

            cartItems.innerHTML += `
                <div style="
                    background:#f9f9f9;
                    padding:10px;
                    border-radius:10px;
                    margin-bottom:10px;
                ">

                    <div style="display:flex; justify-content:space-between;">
                        <strong>${item.name}</strong>
                        <button onclick="removeItem(${index})" style="
                            background:red;
                            color:white;
                            border:none;
                            border-radius:5px;
                            padding:3px 6px;
                        ">✖</button>
                    </div>

                    <div style="font-size:14px; color:#555;">
                        L. ${item.price} x ${item.qty}
                    </div>

                    <div style="font-weight:bold;">
                        Subtotal: L. ${subtotal}
                    </div>

                    <div style="display:flex; gap:5px; margin-top:5px;">
                        <button onclick="changeQty(${index}, -1)" class="btn btn-sm btn-outline-secondary">-</button>
                        <span>${item.qty}</span>
                        <button onclick="changeQty(${index}, 1)" class="btn btn-sm btn-outline-secondary">+</button>
                    </div>

                </div>
            `;
        });

        if(cartTotal) cartTotal.innerText = "L. " + total;
        if(cartCount) cartCount.innerText = cart.length;
    }

    if(clearCart){
        clearCart.onclick = () => {
            cart = [];
            saveCart();
            renderCart();
        };
    }

    const checkoutBtn = document.getElementById('checkout-btn');

    if(checkoutBtn){
        checkoutBtn.onclick = () => {
            if(cart.length === 0){
                alert("El carrito está vacío");
                return;
            }

            window.location.href = "/checkout";
        };
    }

    document.querySelectorAll('.add-cart').forEach(btn => {
        btn.addEventListener('click', function() {

            let name = this.dataset.name || this.closest('.product-card').querySelector('h5').innerText;

            let price = this.dataset.price 
                ? parseFloat(this.dataset.price)
                : parseFloat(this.closest('.product-card').querySelector('p').innerText.replace('L.', ''));

            // 🔥 Seguridad extra
            if (isNaN(price)) {
                let card = this.closest('.product-card');
                price = parseFloat(card.querySelector('p').innerText.replace('L.', ''));
            }

            addToCart(name, price);
        });
    });

    renderCart();

});
</script>

@if(!request()->is('admin*'))
    @include('components.footer')
@endif

</body>
</html>