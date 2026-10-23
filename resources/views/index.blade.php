@extends('components.layout')

@section('content')
    <main class="bg-slate-50">
        <section aria-label="Promosi utama" class="w-full">
            <img
                class="h-auto max-h-100 min-h-55 w-full object-cover shadow-sm"
                src="https://placehold.co/1200x400/blue/white?text=Hero+Toko+Material"
                alt="Banner promosi toko material"
            >
        </section>
        <div class="mx-auto flex max-w-7xl flex-col gap-14 px-4 py-8 sm:px-6 lg:px-8 lg:py-12">
            <section aria-labelledby="product-heading">
                <div class="mb-6 flex items-end justify-between gap-4">
                    <div>
                        <h1 id="product-heading" class="text-2xl font-bold tracking-tight text-slate-950 sm:text-3xl">
                            Produk pilihan
                        </h1>
                        <p class="mt-2 text-sm text-slate-500">Temukan produk material untuk kebutuhan proyek Anda.</p>
                    </div>
                    <a
                        class="shrink-0 text-sm font-semibold text-amber-700 underline decoration-amber-300 underline-offset-4 transition hover:text-amber-800"
                        href="{{ route('catalog') }}"
                    >
                        Lihat semua
                    </a>
                </div>

                @if ($products->isNotEmpty())
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($products as $product)
                            <x-product-card :product="$product" />
                        @endforeach
                    </div>
                @else
                    <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-12 text-center">
                        <p class="font-semibold text-slate-900">Produk belum tersedia.</p>
                        <p class="mt-2 text-sm text-slate-500">Silakan kembali lagi setelah produk ditambahkan.</p>
                    </div>
                @endif
            </section>
        </div>
    </main>
@endsection