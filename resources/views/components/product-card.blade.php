@props(['product'])

<article class="group overflow-hidden rounded-2xl bg-white shadow-[0_10px_30px_rgba(15,23,42,0.08)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_18px_40px_rgba(15,23,42,0.14)]">
    <a href="{{ route('product.show', $product) }}" class="block focus:outline-none focus:ring-4 focus:ring-inset focus:ring-primary/30">
        <div class="aspect-[4/3] overflow-hidden">
            <img class="h-full w-full object-cover transition duration-500 group-hover:scale-105" src="https://placehold.co/800x600?text={{ urlencode($product->name) }}" alt="{{ $product->name }}">
        </div>
    </a>

    <div class="grid gap-3 p-5">
        <div class="flex items-start justify-between gap-3">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.14em] text-primary">
                    {{ filled($product->category) ? \Illuminate\Support\Str::headline($product->category) : 'Tanpa kategori' }}
                </p>
                <h2 class="mt-1 text-lg font-bold text-slate-950">{{ $product->name }}</h2>
            </div>
            <span class="shrink-0 text-sm font-bold text-slate-950">
                {{ \Illuminate\Support\Number::currency($product->price, in: 'IDR', locale: 'id') }}
            </span>
        </div>

        <p class="line-clamp-2 text-sm leading-6 text-slate-500">{{ $product->description }}</p>

        <a href="{{ route('product.show', $product) }}" class="inline-flex items-center justify-center rounded-xl bg-primary px-4 py-3 text-sm font-semibold text-primary-foreground transition hover:bg-primary/90 focus:outline-none focus:ring-4 focus:ring-primary/30">
            Lihat produk
        </a>
    </div>
</article>
