const currencyFormatter = new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    maximumFractionDigits: 0,
});

async function cartRequest(url, options = {}) {
    const response = await fetch(url, {
        credentials: 'same-origin',
        headers: {
            Accept: 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
            ...options.headers,
        },
        ...options,
    });

    if (!response.ok) {
        throw new Error(`Cart request failed with status ${response.status}.`);
    }

    return response.json();
}

export async function getCart() {
    try {
        const response = await cartRequest('/cart/items');

        return Array.isArray(response.cart) ? response.cart : [];
    } catch (error) {
        console.error('Keranjang tidak dapat dibaca dari server.', error);

        return [];
    }
}

function updateCartCount(cart) {
    const count = cart.reduce((total, item) => total + Number(item.quantity), 0);

    document.querySelectorAll('[data-cart-count]').forEach((badge) => {
        badge.textContent = count;
        badge.classList.toggle('hidden', count === 0);
    });
}

function formatWhatsAppCurrency(value) {
    return `Rp. ${new Intl.NumberFormat('id-ID', {
        maximumFractionDigits: 0,
    }).format(value)}`;
}

function createWhatsAppUrl(cart, phoneNumber) {
    const lines = [
        'Halo, kak. Saya mau pesan produk dibawah ini;',
        ...cart.map((item) => {
            const subtotal = Number(item.price) * Number(item.quantity);

            return `- ${item.name}${item.quantity > 1 ? ` x${item.quantity}` : ''} ( ${formatWhatsAppCurrency(subtotal)} )`;
        }),
        `-- Total ${formatWhatsAppCurrency(cart.reduce((total, item) => total + (Number(item.price) * Number(item.quantity)), 0))}`,
    ];

    return `https://wa.me/${phoneNumber}?text=${encodeURIComponent(lines.join('\n'))}`;
}

export async function addProduct(productId) {
    await cartRequest('/cart', {
        method: 'POST',
        body: JSON.stringify({ product_id: productId }),
    });
}

export async function removeProduct(productId) {
    await cartRequest(`/cart/${encodeURIComponent(productId)}`, {
        method: 'DELETE',
    });
}

async function updateProductQuantity(productId, change) {
    await cartRequest(`/cart/${encodeURIComponent(productId)}`, {
        method: 'PATCH',
        body: JSON.stringify({ change }),
    });
}

function escapeHtml(value) {
    return String(value)
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;')
        .replaceAll("'", '&#039;');
}

export async function renderCart() {
    const cart = await getCart();
    updateCartCount(cart);

    const orderCart = document.querySelector('[data-order-cart]');
    const orderEmpty = document.querySelector('[data-order-empty]');
    const orderSummary = document.querySelector('[data-order-summary]');
    const orderTotal = document.querySelector('[data-order-total]');
    const whatsappOrder = document.querySelector('[data-whatsapp-order]');

    if (!orderCart || !orderEmpty || !orderSummary || !orderTotal) {
        return;
    }

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
    whatsappOrder?.toggleAttribute('disabled', cart.length === 0);
}

const orderProductLink = document.querySelector('[data-order-product-id]');
const cartAddedModal = document.querySelector('[data-cart-added-modal]');
const cartAddedClose = document.querySelector('[data-cart-added-close]');

function closeCartAddedModal() {
    if (!cartAddedModal) {
        return;
    }

    cartAddedModal.classList.add('hidden');
    cartAddedModal.classList.remove('flex');
    cartAddedModal.setAttribute('aria-hidden', 'true');
}

function openCartAddedModal() {
    if (!cartAddedModal) {
        return;
    }

    cartAddedModal.classList.remove('hidden');
    cartAddedModal.classList.add('flex');
    cartAddedModal.setAttribute('aria-hidden', 'false');
    cartAddedClose?.focus();
}

if (orderProductLink) {
    orderProductLink.addEventListener('click', async (event) => {
        event.preventDefault();

        await addProduct(orderProductLink.dataset.orderProductId);
        await renderCart();
        openCartAddedModal();
    });
}

cartAddedClose?.addEventListener('click', closeCartAddedModal);

cartAddedModal?.addEventListener('click', (event) => {
    if (event.target === cartAddedModal) {
        closeCartAddedModal();
    }
});

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        closeCartAddedModal();
    }
});

const orderCart = document.querySelector('[data-order-cart]');
const whatsappOrder = document.querySelector('[data-whatsapp-order]');

whatsappOrder?.addEventListener('click', async () => {
    const cart = await getCart();
    const phoneNumber = whatsappOrder.dataset.whatsappNumber;

    if (cart.length === 0 || !phoneNumber) {
        return;
    }

    window.open(createWhatsAppUrl(cart, phoneNumber), '_blank', 'noopener,noreferrer');
});

if (orderCart) {
    orderCart.addEventListener('click', async (event) => {
        const actionButton = event.target.closest('[data-cart-action]');

        if (!actionButton) {
            return;
        }

        const productId = actionButton.dataset.productId;
        const action = actionButton.dataset.cartAction;

        if (action === 'remove') {
            await removeProduct(productId);
        } else {
            await updateProductQuantity(productId, action === 'increase' ? 1 : -1);
        }

        await renderCart();
    });

}

renderCart();