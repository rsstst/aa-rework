@extends('components.layout')

@section('content')
    <main class="bg-slate-50">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-12">
            <a href="{{ route('catalog') }}"
                class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 transition hover:text-primary">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m15 18-6-6 6-6" />
                </svg>
                Kembali ke katalog
            </a>

            <div
                class="mt-8 grid gap-8 rounded-2xl bg-white p-5 shadow-[0_10px_30px_rgba(15,23,42,0.08)] lg:grid-cols-2 lg:p-8">
                <div class="overflow-hidden rounded-xl">
                    <img class="aspect-[4/3] h-full w-full object-cover"
                        src="https://placehold.co/800x600">
                </div>
                <div class="flex flex-col justify-center">
                    <p class="text-xs font-semibold uppercase tracking-[0.14em] text-primary">
                        {{ filled($product->category) ? \Illuminate\Support\Str::headline($product->category) : 'Tanpa kategori' }}
                    </p>
                    <h1 class="mt-3 text-3xl font-bold tracking-tight text-slate-950 sm:text-4xl">{{ $product->name }}</h1>
                    <p class="mt-5 text-2xl font-bold text-slate-950">
                        {{ \Illuminate\Support\Number::currency($product->price, in: 'IDR', locale: 'id') }}
                    </p>
                    <p class="mt-5 max-w-prose text-base leading-7 text-slate-600">{{ $product->description }}</p>
                    <button type="button"
                        data-order-product-id="{{ $product->id }}"
                        class="mt-8 inline-flex w-fit rounded-xl bg-primary px-5 py-3 text-sm font-bold text-primary-foreground transition hover:bg-primary/90 focus:outline-none focus:ring-4 focus:ring-primary/30">
                        Tambah ke keranjang
                    </button>
                </div>
            </div>
        </div>
    </main>

    <div class="fixed inset-0 z-[60] hidden items-center justify-center bg-slate-950/45 px-4 backdrop-blur-sm"
        data-cart-added-modal aria-hidden="true">
        <div class="w-full max-w-sm rounded-2xl bg-white p-6 text-center shadow-[0_20px_60px_rgba(15,23,42,0.2)]"
            role="dialog" aria-modal="true" aria-labelledby="cart-added-title" data-cart-added-dialog>
            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                <i class="fa-solid fa-check text-xl" aria-hidden="true"></i>
            </div>
            <h2 id="cart-added-title" class="mt-4 text-xl font-bold text-slate-950">Ditambahkan ke keranjang</h2>
            <p class="mt-2 text-sm text-slate-500">Produk berhasil ditambahkan ke keranjang Anda.</p>
            <button type="button"
                class="mt-6 inline-flex w-full items-center justify-center rounded-xl bg-primary px-5 py-3 text-sm font-bold text-primary-foreground transition hover:bg-primary/90 focus:outline-none focus:ring-4 focus:ring-primary/30"
                data-cart-added-close>
                Tutup
            </button>
        </div>
    </div>
@endsection
