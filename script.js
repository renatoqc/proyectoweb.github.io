// Esperar a que se cargue el contenido HTML antes de ejecutar el código
document.addEventListener("DOMContentLoaded", function() {
    // Selección de elementos del DOM relacionados con el carrito de compras y el panel de usuario
    const cartIconContainer = document.querySelector('.fa-basket-shopping');
    const cartIcon = document.querySelector('.content-shopping-cart .number');
    const cartPanel = document.querySelector('.cart-panel');
    const cartPanelItems = document.querySelector('.cart-items');
    const totalQuantityDisplay = document.querySelector('.total-quantity');
    const totalPriceDisplay = document.querySelector('.total-price');
    const closeCartButton = document.querySelector('.close-cart-btn');
    const userIcon = document.querySelector('.fa-user');
    const userPanel = document.querySelector('.user-panel');
    const closeButton = document.querySelector('.close-user-btn');

    // Variables para almacenar la cantidad total de productos y el precio total en el carrito
    let totalQuantity = 0;
    let totalPrice = 0;

    // Función para mostrar u ocultar el panel de usuario al hacer clic en el icono de usuario
    userIcon.addEventListener('click', function() {
        userPanel.style.display = userPanel.style.display === 'block' ? 'none' : 'block';
    });

    // Función para cerrar el panel de usuario al hacer clic en el botón de cierre
    closeButton.addEventListener('click', function() {
        userPanel.style.display = 'none';
    });

    // Función para abrir el panel de carrito 
    cartIconContainer.addEventListener('click', function() {
        cartPanel.classList.toggle('open');
    });

    // Función para cerrar el panel de carrito 
    closeCartButton.addEventListener('click', function() {
        cartPanel.classList.remove('open');
    });

    // Iterar sobre todos los botones de "Agregar al carrito" y añadir un evento de clic a cada uno
    document.querySelectorAll('.add-cart').forEach(button => {
        button.addEventListener('click', function() {
            // Obtener la tarjeta del producto más cercana al botón clickeado
            const productCard = button.closest('.card-product');
            // Obtener el nombre del producto
            const productName = productCard.querySelector('h3').textContent.trim();
            // Obtener el elemento que contiene el precio
            const priceElement = productCard.querySelector('.price');
            let productPriceText;

            // Verificar si el precio contiene un elemento tachado (indicando un descuento)
            if (priceElement.querySelector('span')) {
                // Obtener el primer nodo de texto, que debería ser el precio actual
                productPriceText = priceElement.childNodes[0].textContent.trim();
            } else {
                // Si no hay un elemento tachado, el precio es el texto completo del elemento '.price'
                productPriceText = priceElement.textContent.trim();
            }

            // Convertir el precio a un número flotante
            const productPrice = parseFloat(productPriceText.replace(/[^\d.]/g, ''));
            // Obtener la URL de la imagen del producto
            const productImageSrc = productCard.querySelector('.container-img img').src;

            // Llamar a la función addToCart para agregar el producto al carrito
            addToCart(productName, productPrice, productImageSrc);
        });
    });

    // Función para agregar un producto al carrito
    function addToCart(name, price, imageSrc) {
        // Crear un nuevo elemento HTML para representar el producto en el carrito
        const cartItem = document.createElement('div');
        cartItem.classList.add('cart-item');
        cartItem.innerHTML = `
            <img src="${imageSrc}" alt="${name}" class="cart-item-image">
            <div class="cart-item-info">
                <p class="cart-item-name">${name}</p>
                <p class="cart-item-price">S/ ${price.toFixed(2)}</p>
            </div>
            <button class="remove-item-btn">&times;</button>
        `;
        //  eliminar el producto del carrito
        const removeBtn = cartItem.querySelector('.remove-item-btn');
        removeBtn.addEventListener('click', function() {
            removeItemFromCart(cartItem, price);
        });

        // Agregar el nuevo elemento al panel del carrito
        cartPanelItems.appendChild(cartItem);

        // Actualizar la cantidad total de productos y el precio total en el carrito
        totalQuantity++;
        totalPrice += price;
        updateCartSummary();
    }

    // Función para eliminar un producto del carrito
    function removeItemFromCart(cartItem, price) {
        // Eliminar el elemento del carrito del DOM
        cartPanelItems.removeChild(cartItem);
        // Restar la cantidad y el precio del producto eliminado de los totales
        totalQuantity--;
        totalPrice -= price;
        // Actualizar la cantidad total y el precio total en el carrito
        updateCartSummary();
    }

    // Función para actualizar la cantidad total y el precio total en el carrito
    function updateCartSummary() {
        totalQuantityDisplay.textContent = totalQuantity;
        totalPriceDisplay.textContent = totalPrice.toFixed(2);
        cartIcon.textContent = `(${totalQuantity})`;
    }
});


