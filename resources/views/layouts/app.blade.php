<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Despensa Espinoza</title>

    @php
    $logo = \App\Models\Configuracion::where('clave','logo')->value('valor');
    @endphp

    <link rel="icon" href="{{ asset('storage/' . ($config['logo'] ?? 'img/logo.jpg')) }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

@include('components.navbar')

<main>
    @yield('content')
</main>

<!-- PANEL CARRITO -->
<div id="cart-panel">

    <div class="cart-header">
        <h3>Tu carrito</h3>
        <span id="cart-close" class="cart-close">✖</span>
    </div>

    <div id="cart-items"></div>

    <div class="cart-total">
        Total: <span id="cart-total">L. 0</span>
    </div>

    <button id="clear-cart">Vaciar carrito</button>

    <button id="checkout-btn" style="
        margin-top:10px;
        background:#16a34a;
        color:white;
        border:none;
        padding:10px;
        border-radius:10px;
    ">
        Finalizar pedido
    </button>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ========================
       CARRITO (NO TOCAR)
    ======================== */

    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    const cartPanel = document.getElementById('cart-panel');
    const cartToggle = document.getElementById('cart-toggle');
    const cartClose = document.getElementById('cart-close');
    const cartItems = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');
    const cartCount = document.getElementById('cart-count');
    const clearCart = document.getElementById('clear-cart');

    if(cartToggle){
        cartToggle.onclick = () => cartPanel.classList.add('active');
    }

    if(cartClose){
        cartClose.onclick = () => cartPanel.classList.remove('active');
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
                <div class="cart-item">

                    <div class="cart-row">
                        <strong>${item.name}</strong>
                        <button onclick="removeItem(${index})">❌</button>
                    </div>

                    <div class="cart-row">
                        <span>L. ${item.price}</span>
                        <span>Subtotal: L. ${subtotal}</span>
                    </div>

                    <div class="cart-controls">
                        <button onclick="changeQty(${index}, -1)">-</button>
                        <span>${item.qty}</span>
                        <button onclick="changeQty(${index}, 1)">+</button>
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
            let card = this.closest('.product-card');
            let name = card.querySelector('h5').innerText;
            let price = parseFloat(card.querySelector('p').innerText.replace('L.', ''));

            addToCart(name, price);
        });
    });

    renderCart();

    /* ========================
       CARRUSEL (FIX REAL FINAL)
    ======================== */

    const container = document.getElementById("carouselCategorias");

    if (!container) return;

    let speed = 0.5;

    function autoScroll() {
        container.scrollLeft += speed;

        if (container.scrollLeft >= (container.scrollWidth - container.clientWidth)) {
            container.scrollLeft = 0;
        }

        requestAnimationFrame(autoScroll);
    }

    window.scrollCategorias = function(direction) {
        container.scrollLeft += direction * 200;
    };

    autoScroll();

});
</script>

@if(!request()->is('admin*'))
    @include('components.footer')
@endif

</body>
</html>