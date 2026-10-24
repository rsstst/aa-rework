@extends('components.layout')

@section('content')
    <main class="bg-slate-50">
        <div class="mx-auto max-w-5xl px-4 py-8 sm:px-6 lg:px-8 lg:py-12">
            <div class="mb-8">
                <h1 class="text-3xl font-bold tracking-tight text-slate-950">Pesanan Anda</h1>
                <p class="mt-2 text-sm text-slate-500">Produk yang Anda pilih tersimpan di perangkat ini.</p>
            </div>

            <div class="grid gap-8 lg:grid-cols-[minmax(0,1fr)_320px]">
                <section aria-labelledby="order-items-heading">
                    <h2 id="order-items-heading" class="sr-only">Daftar produk yang dipesan</h2>
                    <div data-order-cart class="grid justify-items-center gap-5"></div>
                    <div data-order-empty
                        class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center">
                        <i class="fa-solid fa-cart-shopping text-3xl text-slate-300" aria-hidden="true"></i>
                        <h2 class="mt-4 font-bold text-slate-950">Keranjang masih kosong</h2>
                        <p class="mt-2 text-sm text-slate-500">Pilih produk dari katalog untuk menambahkannya ke pesanan.</p>
                        <a href="{{ route('catalog') }}"
                            class="mt-5 inline-flex rounded-xl bg-primary px-4 py-3 text-sm font-semibold text-primary-foreground transition hover:bg-primary/90">
                            Lihat katalog
                        </a>
                    </div>
                </section>

                <aside data-order-summary
                    class="h-fit rounded-2xl bg-white p-5 shadow-[0_10px_30px_rgba(15,23,42,0.08)]">
                    <h2 class="text-lg font-bold text-slate-950">Ringkasan pesanan</h2>
                    <div class="mt-5 flex items-center justify-between border-t border-slate-100 pt-4">
                        <span class="text-sm text-slate-500">Total</span>
                        <span data-order-total class="text-lg font-bold text-slate-950">Rp0</span>
                    </div>
                    <button type="button" data-whatsapp-order data-whatsapp-number="6281200000000"
                        disabled
                        class="mt-5 inline-flex rounded-xl bg-primary px-4 py-3 text-sm font-semibold text-primary-foreground transition hover:bg-primary/90 disabled:cursor-not-allowed disabled:opacity-50">
                        Order Sekarang
                    </button>
                </aside>
            </div>
        </div>
    </main>
@endsection
