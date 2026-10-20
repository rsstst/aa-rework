const cartStorageKey = 'aa-rework-cart';

const currencyFormatter = new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    maximumFractionDigits: 0,
});

export function getCart() {
    try {
        const storedCart = JSON.parse(localStorage.getItem(cartStorageKey) || '[]');

        return Array.isArray(storedCart) ? storedCart : [];
    } catch (error) {
        console.error('Keranjang tidak dapat dibaca dari penyimpanan lokal.', error);

        return [];
    }
}

function saveCart(cart) {
    localStorage.setItem(cartStorageKey, JSON.stringify(cart));
}

export function addProduct(product) {
    const cart = getCart();
    const existingProduct = cart.find((item) => String(item.id) === String(product.id));

    if (existingProduct) {
        existingProduct.quantity += 1;
    } else {
        cart.push({ ...product, quantity: 1 });
    }

    saveCart(cart);
}

export function removeProduct(productId) {
    saveCart(getCart().filter((item) => String(item.id) !== String(productId)));
}

function updateProductQuantity(productId, change) {
    const cart = getCart();
    const product = cart.find((item) => String(item.id) === String(productId));

    if (!product) {
        return;
    }

    product.quantity += change;

    if (product.quantity <= 0) {
        removeProduct(productId);

        return;
    }

    saveCart(cart);
}

function escapeHtml(value) {
    return String(value)
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;')
        .replaceAll("'", '&#039;');
}

export function renderCart() {
    const orderCart = document.querySelector('[data-order-cart]');
    const orderEmpty = document.querySelector('[data-order-empty]');
    const orderSummary = document.querySelector('[data-order-summary]');
    const orderTotal = document.querySelector('[data-order-total]');

    if (!orderCart || !orderEmpty || !orderSummary || !orderTotal) {
        return;
    }

    const cart = getCart();
    const total = cart.reduce((sum, item) => sum + (Number(item.price) * Number(item.quantity)), 0);

    orderCart.innerHTML = cart.map((product) => `
        <article class="w-full max-w-3xl rounded-2xl bg-white p-6 shadow-[0_10px_30px_rgba(15,23,42,0.08)]">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="min-w-0">
                    <p class="text-xs font-semibold uppercase tracking-[0.14em] text-primary">
                        ${escapeHtml(product.category || 'Tanpa kategori')}
                    </p>
                    <h3 class="mt-1 truncate text-lg font-bold text-slate-950">${escapeHtml(product.name)}</h3>
                    <p class="mt-1 text-sm text-slate-500">
                        ${currencyFormatter.format(Number(product.price))} / produk
                    </p>
                </div>
                <div class="flex items-center justify-between gap-4 sm:justify-end">
                    <div class="flex items-center rounded-xl border border-slate-200">
                        <button type="button" data-cart-action="decrease" data-product-id="${escapeHtml(product.id)}"
                            class="flex h-10 w-10 items-center justify-center text-slate-600 transition hover:bg-slate-50"
                            aria-label="Kurangi jumlah ${escapeHtml(product.name)}">−</button>
                        <span class="min-w-10 text-center text-sm font-semibold text-slate-950">${product.quantity}</span>
                        <button type="button" data-cart-action="increase" data-product-id="${escapeHtml(product.id)}"
                            class="flex h-10 w-10 items-center justify-center text-slate-600 transition hover:bg-slate-50"
                            aria-label="Tambah jumlah ${escapeHtml(product.name)}">+</button>
                    </div>
                    <button type="button" data-cart-action="remove" data-product-id="${escapeHtml(product.id)}"
                        class="text-sm font-semibold text-red-600 transition hover:text-red-700">
                        Hapus
                    </button>
                </div>
            </div>
            <div class="mt-4 flex justify-between border-t border-slate-100 pt-4 text-sm">
                <span class="text-slate-500">${product.quantity} produk</span>
                <span class="font-bold text-slate-950">
                    ${currencyFormatter.format(Number(product.price) * Number(product.quantity))}
                </span>
            </div>
        </article>
    `).join('');
    orderEmpty.classList.toggle('hidden', cart.length > 0);
    orderSummary.classList.toggle('hidden', cart.length === 0);
    orderTotal.textContent = currencyFormatter.format(total);
}

const orderProductLink = document.querySelector('[data-order-product-id]');

if (orderProductLink) {
    orderProductLink.addEventListener('click', (event) => {
        event.preventDefault();

        addProduct({
            id: orderProductLink.dataset.orderProductId,
            name: orderProductLink.dataset.orderProductName,
            price: orderProductLink.dataset.orderProductPrice,
            slug: orderProductLink.dataset.orderProductSlug,
            category: orderProductLink.dataset.orderProductCategory,
        });

        window.location.href = orderProductLink.href;
    });
}

const orderCart = document.querySelector('[data-order-cart]');

if (orderCart) {
    orderCart.addEventListener('click', (event) => {
        const actionButton = event.target.closest('[data-cart-action]');

        if (!actionButton) {
            return;
        }

        const productId = actionButton.dataset.productId;
        const action = actionButton.dataset.cartAction;

        if (action === 'remove') {
            removeProduct(productId);
        } else {
            updateProductQuantity(productId, action === 'increase' ? 1 : -1);
        }

        renderCart();
    });

    renderCart();
}