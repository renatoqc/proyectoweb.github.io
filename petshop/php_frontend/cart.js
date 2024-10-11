document.addEventListener('DOMContentLoaded', function () {
    const cartItems = {};
    const cartItemsContainer = document.getElementById('cart-items');
    const cartTotalElement = document.getElementById('cart-total');
    const cartCountElement = document.querySelector('.cart-count');
    const addToCartButtons = document.querySelectorAll('.add-to-cart');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', function () {
            const productCard = button.closest('.product-card');
            const productId = productCard.getAttribute('data-id');
            const productName = productCard.getAttribute('data-name');
            const productPrice = parseFloat(productCard.getAttribute('data-price'));

            if (cartItems[productId]) {
                cartItems[productId].quantity += 1;
            } else {
                cartItems[productId] = {
                    name: productName,
                    price: productPrice,
                    quantity: 1
                };
            }

            updateCart();
        });
    });

    function updateCart() {
        cartItemsContainer.innerHTML = '';
        let total = 0;
        let itemCount = 0;

        for (const [id, item] of Object.entries(cartItems)) {
            const itemTotal = item.price * item.quantity;
            total += itemTotal;
            itemCount += item.quantity;

            const itemElement = document.createElement('div');
            itemElement.classList.add('cart-item');
            itemElement.innerHTML = `
                <p>${item.name} - ${item.quantity} x S/ ${item.price.toFixed(2)} = S/ ${itemTotal.toFixed(2)}</p>
            `;
            cartItemsContainer.appendChild(itemElement);
        }

        cartTotalElement.textContent = total.toFixed(2);
        cartCountElement.textContent = itemCount;

        if (itemCount === 0) {
            cartItemsContainer.innerHTML = '<p>No hay productos en el carrito.</p>';
        }
    }

    document.getElementById('checkout').addEventListener('click', function () {
        if (Object.keys(cartItems).length > 0) {
            alert('Pedido realizado correctamente. ¡Gracias por tu compra!');
            Object.keys(cartItems).forEach(id => delete cartItems[id]);
            updateCart();
        } else {
            alert('No hay productos en el carrito.');
        }
    });
});
