function js_cart() {
    const cartItems = [
        { product: 'Gloves', price: 79.99, quantity: 1 },
        { product: 'T-Shirt', price: 59.99, quantity: 1 },
        { product: 'Football socks', price: 19.99, quantity: 2 },
        { product: 'Boots', price: 99.99, quantity: 1 },
        { product: 'Podkapa', price: 19.99, quantity: 1 }
    ];

    function loadCartItems() {
        const cartTableBody = document.getElementById('cart-items');
        if (!cartTableBody) {
            console.error('Cart table body not found');
            return;
        }
        cartTableBody.innerHTML = '';

        let totalAmount = 0;

        cartItems.forEach((item, index) => {
            const itemTotal = item.price * item.quantity;
            totalAmount += itemTotal;
            console.log ("test")
            const row = document.createElement('tr');

            row.innerHTML = `
                <td>${item.product}</td>
                <td>€${item.price.toFixed(2)}</td>
                <td><input type="number" value="${item.quantity}" min="1" data-index="${index}" class="quantity-input"></td>
                <td>€${itemTotal.toFixed(2)}</td>
                <td>
                    <button class="btn btn-warning btn-edit" data-index="${index}">Edit</button>
                    <button class="btn btn-danger btn-delete" data-index="${index}">Delete</button>
                </td>
            `;
        const totalAmountElement = document.getElementById('total-amount');
        if (totalAmountElement) {
            totalAmountElement.textContent = totalAmount.toFixed(2);
        } else {
            console.error('Total amount element not found');
        }
            cartTableBody.appendChild(row);
        });

        document.getElementById('total-amount').textContent = totalAmount.toFixed(2);
    }

    function updateCartItem(index, quantity) {
        cartItems[index].quantity = quantity;
        toastr.success('Cart updated successfully!');
        loadCartItems();
    }

    function deleteCartItem(index) {
        cartItems.splice(index, 1);
        toastr.error('Item removed from cart!');
        loadCartItems();
    }

    document.getElementById('cart-items').addEventListener('change', function(event) {
        if (event.target.classList.contains('quantity-input')) {
            const index = event.target.getAttribute('data-index');
            const quantity = parseInt(event.target.value);
            if (quantity > 0) {
                updateCartItem(index, quantity);
            } else {
                toastr.error('Quantity must be at least 1.');
            }
        }
    });

    document.getElementById('cart-items').addEventListener('click', function(event) {
        if (event.target.classList.contains('btn-delete')) {
            const index = event.target.getAttribute('data-index');
            deleteCartItem(index);
        }
    });

    loadCartItems();
}