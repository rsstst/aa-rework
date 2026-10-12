@extends('components.layout')

@section('content')
    <main class="bg-slate-50">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-12">
            <div class="mb-8 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight text-slate-950">Katalog produk</h1>
                    <p class="mt-2 text-sm text-slate-500">Pilih material yang sesuai untuk kebutuhan proyek Anda.</p>
                </div>
                <span class="text-sm text-slate-500">{{ $products->total() }} produk tersedia</span>
            </div>

            <div class="grid gap-8 lg:grid-cols-[240px_minmax(0,1fr)]">
                <aside>
                    @include('components.filter', ['categories' => $categories])
                </aside>

                <section aria-label="Daftar produk">
                    @if ($products->isNotEmpty())
                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach ($products as $product)
                                <x-product-card :product="$product" />
                            @endforeach
                        </div>

                        <div class="mt-8">
                            {{ $products->links() }}
                        </div>
                    @else
                        <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center">
                            <h2 class="font-bold text-slate-950">Produk tidak ditemukan</h2>
                            <p class="mt-2 text-sm text-slate-500">Coba ubah kategori atau rentang harga.</p>
                            <a href="{{ route('catalog') }}" class="mt-5 inline-flex rounded-xl bg-primary px-4 py-3 text-sm font-semibold text-primary-foreground hover:bg-primary/90">Reset filter</a>
                        </div>
                    @endif
                </section>
            </div>
        </div>
    </main>
@endsection
