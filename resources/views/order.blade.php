@extends('components.layout')

@section('content')
    <main class="bg-slate-50">
        <div class="mx-auto max-w-5xl px-4 py-8 sm:px-6 lg:px-8 lg:py-12">
            <div class="mb-8">
                <h1 class="text-3xl font-bold tracking-tight text-slate-950">Pesanan Anda</h1>
                <p class="mt-2 text-sm text-slate-500">Produk yang Anda pilih tersimpan di perangkat ini.</p>
            </div>

            @if (session('success'))
                <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid gap-8 lg:grid-cols-[minmax(0,1fr)_320px]">
                <section aria-labelledby="order-items-heading">
                    <h2 id="order-items-heading" class="sr-only">Daftar produk yang dipesan</h2>
                    <div class="grid justify-items-center gap-5">
                        @foreach ($cart as $product)
                            <article class="w-full max-w-3xl rounded-2xl bg-white p-6 shadow-[0_10px_30px_rgba(15,23,42,0.08)]">
                                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                                    <div class="min-w-0">
                                        <p class="text-xs font-semibold uppercase tracking-[0.14em] text-primary">
                                            {{ filled($product['category']) ? \Illuminate\Support\Str::headline($product['category']) : 'Tanpa kategori' }}
                                        </p>
                                        <h3 class="mt-1 truncate text-lg font-bold text-slate-950">{{ $product['name'] }}</h3>
                                        <p class="mt-1 text-sm text-slate-500">
                                            {{ \Illuminate\Support\Number::currency($product['price'], in: 'IDR', locale: 'id') }} / produk
                                        </p>
                                    </div>
                                    <div class="flex items-center justify-between gap-4 sm:justify-end">
                                        <div class="flex items-center rounded-xl border border-slate-200">
                                            <form action="{{ route('cart.update', $product['id']) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="change" value="-1">
                                                <button type="submit" class="flex h-10 w-10 items-center justify-center text-slate-600 transition hover:bg-slate-50"
                                                    aria-label="Kurangi jumlah {{ $product['name'] }}">−</button>
                                            </form>
                                            <span class="min-w-10 text-center text-sm font-semibold text-slate-950">{{ $product['quantity'] }}</span>
                                            <form action="{{ route('cart.update', $product['id']) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="change" value="1">
                                                <button type="submit" class="flex h-10 w-10 items-center justify-center text-slate-600 transition hover:bg-slate-50"
                                                    aria-label="Tambah jumlah {{ $product['name'] }}">+</button>
                                            </form>
                                        </div>
                                        <form action="{{ route('cart.destroy', $product['id']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm font-semibold text-red-600 transition hover:text-red-700">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="mt-4 flex justify-between border-t border-slate-100 pt-4 text-sm">
                                    <span class="text-slate-500">{{ $product['quantity'] }} produk</span>
                                    <span class="font-bold text-slate-950">
                                        {{ \Illuminate\Support\Number::currency($product['price'] * $product['quantity'], in: 'IDR', locale: 'id') }}
                                    </span>
                                </div>
                            </article>
                        @endforeach
                    </div>
                    <div @class(['rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center', 'hidden' => count($cart) > 0])>
                        <i class="fa-solid fa-cart-shopping text-3xl text-slate-300" aria-hidden="true"></i>
                        <h2 class="mt-4 font-bold text-slate-950">Keranjang masih kosong</h2>
                        <p class="mt-2 text-sm text-slate-500">Pilih produk dari katalog untuk menambahkannya ke pesanan.</p>
                        <a href="{{ route('catalog') }}"
                            class="mt-5 inline-flex rounded-xl bg-primary px-4 py-3 text-sm font-semibold text-primary-foreground transition hover:bg-primary/90">
                            Lihat katalog
                        </a>
                    </div>
                </section>

                <aside @class(['h-fit rounded-2xl bg-white p-5 shadow-[0_10px_30px_rgba(15,23,42,0.08)]', 'hidden' => count($cart) === 0])>
                    <h2 class="text-lg font-bold text-slate-950">Ringkasan pesanan</h2>
                    <div class="mt-5 flex items-center justify-between border-t border-slate-100 pt-4">
                        <span class="text-sm text-slate-500">Total</span>
                        <span class="text-lg font-bold text-slate-950">
                            {{ \Illuminate\Support\Number::currency($total, in: 'IDR', locale: 'id') }}
                        </span>
                    </div>
                </aside>
            </div>
        </div>
    </main>
@endsection
