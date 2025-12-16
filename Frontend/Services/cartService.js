const CartService = {
    items: [],
    modal: null,
    initialized: false,

    tryInit() {
        if (this.initialized) return;
        if (!document.getElementById('cart-table')) return;
        this.initialized = true;
        this.init();
    },

    init() {
        const modalEl = document.getElementById('cartModal');
        if (window.bootstrap && modalEl) {
            this.modal = new bootstrap.Modal(modalEl);
        }

        this.render();

        document.getElementById('checkout')?.addEventListener('click', () => {
            this.checkout();
        });

    },

    render() {
        const tbody = document.getElementById('cart-items');
        if (!tbody) return;
        if (!this.items.length) {
            tbody.innerHTML = '<tr><td colspan="4" class="text-center text-muted">Your cart is empty</td></tr>';
        } else {
            tbody.innerHTML = this.items.map((item, idx) => `
                <tr>
                    <td>${item.name}</td>
                    <td class="text-end">€${item.price.toFixed(2)}</td>
                    <td class="text-center">${item.qty}</td>
                    <td class="text-end">€${(item.price * item.qty).toFixed(2)}</td>
                </tr>
            `).join('');
        }
        this.renderTotalsOnly();
    },

    renderTotalsOnly() {
        const total = this.items.reduce((sum, it) => sum + it.price * it.qty, 0);
        const totalEl = document.getElementById('total-amount');
        if (totalEl) totalEl.textContent = total.toFixed(2);
    },

    remove(idx) {
        this.items.splice(idx, 1);
        this.render();
        this.persist();
    },

    checkout() {
        
        if (this.modal) {
            this.modal.show();
        } else {
            alert('Thank you for your purchase!\nYour order has been received. We’ll send you a confirmation email shortly.');
        }
        
        this.items = [];
        this.render();
        this.persist();
    },

    persist() {
        localStorage.setItem('cart_items', JSON.stringify(this.items));
    },

    load() {
        try {
            const data = JSON.parse(localStorage.getItem('cart_items') || '[]');
            if (Array.isArray(data)) this.items = data;
        } catch (e) { /* ignore */ }
    }
};

document.addEventListener('DOMContentLoaded', () => {
    CartService.load();
    CartService.tryInit();
});
window.addEventListener('hashchange', () => CartService.tryInit());

