let cart = 0;

document.addEventListener("DOMContentLoaded", () => {

    const buttons = document.querySelectorAll(".add-cart");
    const counter = document.getElementById("cart-count");

    buttons.forEach(btn => {
        btn.addEventListener("click", () => {

            cart++;
            counter.textContent = cart;

            btn.innerText = "✔ Agregado";
            btn.style.background = "#15803d";

            btn.style.transform = "scale(0.9)";

            setTimeout(() => {
                btn.innerText = "Agregar";
                btn.style.background = "#16a34a";
                btn.style.transform = "scale(1)";
            }, 800);
        });
    });

});