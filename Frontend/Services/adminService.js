const AdminServiceProducts = {
    products: [],
    addModal: null,
    editModal: null,
    initialized: false,

    tryInit() {
        if (this.initialized) return;
        if (!document.getElementById('admin-products-table')) return;
        this.initialized = true;
        this.init();
    },

    init: function () {
       
        const addModalEl = document.getElementById('addModal');
        const editModalEl = document.getElementById('editModal');
        if (window.bootstrap) {
            this.addModal = addModalEl ? new bootstrap.Modal(addModalEl) : null;
            this.editModal = editModalEl ? new bootstrap.Modal(editModalEl) : null;
        }

       
        document.getElementById('btn-open-add-product')?.addEventListener('click', this.openAddModal.bind(this));
        document.getElementById('btn-add-product')?.addEventListener('click', this.submitAddProduct.bind(this));
        document.getElementById('btn-save-product')?.addEventListener('click', this.submitSaveProduct.bind(this));

        
        document.getElementById('product-list')?.addEventListener('click', (e) => {
            const btn = e.target;
            const id = btn.getAttribute('data-id');
            if (!id) return;
            if (btn.classList.contains('btn-edit-product')) {
                this.openEditModal(parseInt(id, 10));
            } else if (btn.classList.contains('btn-delete-product')) {
                this.deleteProduct(parseInt(id, 10));
            }
        });

       
        this.fetchProducts();
    },

    setStatus(msg, type = 'info') {
        if (window.toastr) {
            if (type === 'error') toastr.error(msg);
            else if (type === 'success') toastr.success(msg);
            else toastr.info(msg);
        } else {
            console.log(msg);
        }
    },

    getUserId() {
        const token = localStorage.getItem('user_token');
        const decoded = Utils.parseJwt(token);
        return decoded?.user?.id || 1;
    },

    fetchProducts() {
        this.setStatus('Loading products...');
        RestClient.get('products', (data) => {
            this.products = Array.isArray(data) ? data : [];
            this.renderProducts(this.products);
            this.setStatus('Products loaded', 'success');
        }, (err) => {
            this.setStatus('Error loading products', 'error');
            console.error(err);
        });
    },

    renderProducts(list) {
        const tbody = document.getElementById('product-list');
        if (!tbody) return;
        if (!Array.isArray(list) || list.length === 0) {
            tbody.innerHTML = '<tr><td colspan="5" class="text-center">No products found</td></tr>';
            return;
        }
        tbody.innerHTML = list.map(p => `
            <tr>
                <td>${p.id ?? ''}</td>
                <td>${p.name ?? ''}</td>
                <td>${p.price ?? ''}</td>
                <td>${p.stock_quantity ?? ''}</td>
                <td>
                    <button class="btn btn-warning btn-sm btn-edit-product" data-id="${p.id}">Edit</button>
                    <button class="btn btn-danger btn-sm btn-delete-product" data-id="${p.id}">Delete</button>
                </td>
            </tr>
        `).join('');
    },

    openAddModal() {
        document.getElementById('add-product-form')?.reset();
        if (this.addModal) this.addModal.show();
    },

    submitAddProduct() {
        const name = document.getElementById('add-name')?.value?.trim();
        const price = parseFloat(document.getElementById('add-price')?.value);
        const qty = parseInt(document.getElementById('add-quantity')?.value, 10);

        if (!name || isNaN(price) || isNaN(qty)) {
            this.setStatus('Name, price and quantity are required', 'error');
            return;
        }

        const payload = {
            user_id: this.getUserId(),
            category_id: 1, 
            name: name,
            description: '',
            image_type: '',
            image_base64: '',
            price: price,
            stock_quantity: qty
        };

        this.setStatus('Adding product...');
        RestClient.post('products', payload, () => {
            this.setStatus('Product added', 'success');
            if (this.addModal) this.addModal.hide();
            this.fetchProducts();
        }, (err) => {
            this.setStatus('Error adding product', 'error');
            console.error(err);
        });
    },

    openEditModal(id) {
        const product = this.products.find(p => p.id === id);
        if (!product) return;
        document.getElementById('edit-id').value = product.id;
        document.getElementById('edit-name').value = product.name ?? '';
        document.getElementById('edit-price').value = product.price ?? '';
        document.getElementById('edit-quantity').value = product.stock_quantity ?? '';
        if (this.editModal) this.editModal.show();
    },

    submitSaveProduct() {
        const id = parseInt(document.getElementById('edit-id')?.value, 10);
        const name = document.getElementById('edit-name')?.value?.trim();
        const price = parseFloat(document.getElementById('edit-price')?.value);
        const qty = parseInt(document.getElementById('edit-quantity')?.value, 10);

        if (!id || !name || isNaN(price) || isNaN(qty)) {
            this.setStatus('All fields are required', 'error');
            return;
        }

        const payload = {
            name: name,
            price: price,
            stock_quantity: qty
        };

        this.setStatus('Updating product...');
        RestClient.patch(`products/${id}`, payload, () => {
            this.setStatus('Product updated', 'success');
            if (this.editModal) this.editModal.hide();
            this.fetchProducts();
        }, (err) => {
            this.setStatus('Error updating product', 'error');
            console.error(err);
        });
    },

    deleteProduct(id) {
        if (!id) return;
        if (!confirm(`Delete product ${id}?`)) return;
        this.setStatus('Deleting product...');
        RestClient.delete(`products/${id}`, {}, () => {
            this.setStatus('Product deleted', 'success');
            this.fetchProducts();
        }, (err) => {
            this.setStatus('Error deleting product', 'error');
            console.error(err);
        });
    }
};

document.addEventListener('DOMContentLoaded', () => AdminServiceProducts.tryInit());
window.addEventListener('hashchange', () => AdminServiceProducts.tryInit());
const __adminMutationObserver = new MutationObserver(() => AdminServiceProducts.tryInit());
__adminMutationObserver.observe(document.body, { childList: true, subtree: true });

