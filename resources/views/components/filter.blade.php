<form class="grid gap-5 rounded-2xl bg-white p-5 shadow-[0_10px_30px_rgba(15,23,42,0.08)]" method="GET" action="{{ route('catalog') }}">
    <div>
        <h2 class="text-lg font-bold text-slate-950">Filter katalog</h2>
        <p class="mt-1 text-sm text-slate-500">Temukan produk sesuai kebutuhan Anda.</p>
    </div>

    <div class="grid gap-2">
        <label for="category" class="text-sm font-semibold text-slate-700">Kategori</label>
        <select name="category" id="category" class="rounded-xl border border-slate-200 bg-slate-50 p-3 text-sm text-slate-800 outline-none focus:border-primary focus:ring-4 focus:ring-primary/15">
            <option value="">Semua kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category }}" @selected(request('category') === $category)>
                    {{ \Illuminate\Support\Str::headline($category) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="grid gap-2">
        <span class="text-sm font-semibold text-slate-700">Rentang harga</span>
        <div class="grid grid-cols-2 gap-2">
            <input type="number" name="min_price" id="min_price" placeholder="Minimum" value="{{ request('min_price') }}" class="min-w-0 rounded-xl border border-slate-200 bg-slate-50 p-3 text-sm outline-none focus:border-primary focus:ring-4 focus:ring-primary/15">
            <input type="number" name="max_price" id="max_price" placeholder="Maksimum" value="{{ request('max_price') }}" class="min-w-0 rounded-xl border border-slate-200 bg-slate-50 p-3 text-sm outline-none focus:border-primary focus:ring-4 focus:ring-primary/15">
        </div>
    </div>

    <button type="submit" class="rounded-xl bg-primary px-4 py-3 text-sm font-semibold text-primary-foreground transition hover:bg-primary/90 focus:outline-none focus:ring-4 focus:ring-primary/30">
        Terapkan filter
    </button>
</form>
