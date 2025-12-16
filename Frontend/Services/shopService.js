const ShopService = {
    initialized: false,
    grid: null,
    loading: null,
    products: [],

    tryInit() {
        if (this.initialized) return;
        this.grid = document.getElementById('shop-grid');
        this.loading = document.getElementById('shop-loading');
        if (!this.grid) return;
        this.initialized = true;
        this.init();
    },

    init() {
        this.renderLoading('Loading products...');
        if (typeof RestClient === 'undefined') {
            this.renderError('Cannot load products right now.');
            return;
        }
        RestClient.get('products', (data) => {
            this.products = Array.isArray(data) ? data : [];
            this.render();
        }, (err) => {
            console.error(err);
            this.renderError('Cannot load products right now.');
        });
    },

    render() {
        if (!this.grid) return;
        this.clearLoading();
        if (!this.products.length) {
            this.grid.innerHTML = '<p class="text-muted">No products available.</p>';
            return;
        }
        this.grid.innerHTML = this.products.map(p => {
            const name = p.name || 'Product';
            const price = p.price ?? 0;
            const stock = p.stock_quantity ?? 0;
            const placeholder = this.getPlaceholderForName(name);
            const imgSrc = (p.image_base64 && p.image_type)
                ? `data:${p.image_type};base64,${p.image_base64}`
                : (p.image_url && p.image_url.trim() !== '' ? p.image_url : placeholder);
            return `
                <div class="product" data-name="${name}" data-price="${price}">
                    <img src="${imgSrc}" alt="${name}" class="thumbnail" onerror="this.onerror=null;this.src='${placeholder}';">
                    <h3>${name}</h3>
                    <p class="price">€${Number(price).toFixed(2)}</p>
                    <button class="add-to-cart">Add to Cart</button>
                    <button class="toggle-description">Toggle Description</button>
                    <p class="description">Stock: ${stock}</p>
                    <a href="#" class="view-more" data-product="${name}">View More</a>
                </div>
            `;
        }).join('');

        this.attachCardEvents();
    },

    renderLoading(msg) {
        if (this.loading) this.loading.textContent = msg;
    },
    clearLoading() {
        if (this.loading) this.loading.textContent = '';
    },
    renderError(msg) {
        this.clearLoading();
        if (this.grid) this.grid.innerHTML = `<p class="text-danger">${msg}</p>`;
        if (window.toastr) toastr.error(msg);
    },

    getPlaceholderForName(name = '') {
        const n = name.toLowerCase();
        if (n.includes('glove')) return './Assets/pictures/rukavice.jfif';
        if (n.includes('sock')) return './Assets/pictures/stucne.jfif';
        if (n.includes('boot') || n.includes('cleat')) return './Assets/pictures/stucne.jfif';
        if (n.includes('dres') || n.includes('jersey') || n.includes('shirt')) return './Assets/pictures/dres.jfif';
        if (n.includes('balaclava') || n.includes('hood')) return './Assets/pictures/podkapa.jfif';
        return './Assets/pictures/podkapa.jfif';
    },

    attachCardEvents() {
      
        const modal = document.getElementById('modal');
        const modalImg = document.getElementById('modal-img');
        const captionText = document.getElementById('caption');
        const closeModal = document.getElementsByClassName('close')[0];

        this.grid.querySelectorAll('.thumbnail').forEach(thumbnail => {
            thumbnail.addEventListener('click', () => {
                if (modal && modalImg && captionText) {
                    modal.style.display = 'block';
                    modalImg.src = thumbnail.src;
                    captionText.innerHTML = thumbnail.alt;
                }
            });
        });

        if (closeModal && modal) {
            closeModal.onclick = function() { modal.style.display = 'none'; };
        }
        window.onclick = function(event) {
            if (modal && event.target == modal) modal.style.display = 'none';
        };

        this.grid.querySelectorAll('.view-more').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                alert('More details about ' + (this.dataset.product || 'this item') + ' will be available soon!');
            });
        });

        this.grid.querySelectorAll('.toggle-description').forEach(button => {
            button.addEventListener('click', function() {
                const description = this.nextElementSibling;
                if (!description) return;
                description.style.display = (description.style.display === 'none' || description.style.display === '') ? 'block' : 'none';
            });
        });

        this.grid.querySelectorAll('.add-to-cart').forEach(btn => {
            btn.addEventListener('click', () => {
                const card = btn.closest('.product');
                const name = card?.dataset.name || card?.querySelector('h3')?.textContent || 'Item';
                const price = parseFloat(card?.dataset.price || '0') || 0;
                this.addToCart({ name, price, qty: 1 });
            });
        });
    },

    addToCart(item) {
        const stored = localStorage.getItem('cart_items');
        let items = [];
        try {
            items = JSON.parse(stored || '[]');
            if (!Array.isArray(items)) items = [];
        } catch (e) {
            items = [];
        }
        
        const existing = items.find(i => i.name === item.name && i.price === item.price);
        if (existing) {
            existing.qty += item.qty;
        } else {
            items.push(item);
        }
        localStorage.setItem('cart_items', JSON.stringify(items));
        if (window.toastr) toastr.success(`${item.name} added to cart`);
        else alert('Added to cart');
    }
};

document.addEventListener('DOMContentLoaded', () => ShopService.tryInit());
window.addEventListener('hashchange', () => ShopService.tryInit());
const __shopObserver = new MutationObserver(() => ShopService.tryInit());
__shopObserver.observe(document.body, { childList: true, subtree: true });

