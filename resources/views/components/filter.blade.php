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

    <div class="grid gap-3" data-price-filter>
        <span class="text-sm font-semibold text-slate-700">Rentang harga</span>
        <div class="grid gap-4">
            <label class="grid gap-1.5" for="min_price">
                <span class="text-xs font-medium text-slate-500">Minimum</span>
                <span class="relative">
                    <input type="text" id="min_price" inputmode="numeric" autocomplete="off" placeholder="0" value="{{ request()->filled('min_price') ? request('min_price') : '' }}" data-price-input="min" data-price-min="0" data-price-max="2000000" class="min-w-0 w-full rounded-xl border border-slate-200 bg-slate-50 p-3 pl-3 pr-12 text-sm outline-none focus:border-primary focus:ring-4 focus:ring-primary/15">
                    <input type="hidden" name="min_price" value="{{ request('min_price') }}" data-price-value="min">
                    <span class="absolute inset-y-0 right-1 grid w-7 grid-rows-2 py-1">
                        <button type="button" aria-label="Tambah harga minimum" data-price-step="min" data-price-direction="up" class="text-xs leading-none text-slate-500 hover:text-primary">▲</button>
                        <button type="button" aria-label="Kurangi harga minimum" data-price-step="min" data-price-direction="down" class="text-xs leading-none text-slate-500 hover:text-primary">▼</button>
                    </span>
                </span>
            </label>

            <label class="grid gap-1.5" for="max_price">
                <span class="text-xs font-medium text-slate-500">Maksimum</span>
                <span class="relative">
                    <input type="text" id="max_price" inputmode="numeric" autocomplete="off" placeholder="0" value="{{ request()->filled('max_price') ? request('max_price') : '' }}" data-price-input="max" data-price-min="0" data-price-max="2000000" class="min-w-0 w-full rounded-xl border border-slate-200 bg-slate-50 p-3 pl-3 pr-12 text-sm outline-none focus:border-primary focus:ring-4 focus:ring-primary/15">
                    <input type="hidden" name="max_price" value="{{ request('max_price') }}" data-price-value="max">
                    <span class="absolute inset-y-0 right-1 grid w-7 grid-rows-2 py-1">
                        <button type="button" aria-label="Tambah harga maksimum" data-price-step="max" data-price-direction="up" class="text-xs leading-none text-slate-500 hover:text-primary">▲</button>
                        <button type="button" aria-label="Kurangi harga maksimum" data-price-step="max" data-price-direction="down" class="text-xs leading-none text-slate-500 hover:text-primary">▼</button>
                    </span>
                </span>
            </label>

            <div class="grid gap-2">
                <span class="text-xs font-medium text-slate-500">Atur rentang harga</span>
                <div class="relative h-6" data-price-sliders>
                    <div class="absolute inset-x-0 top-1/2 h-1 -translate-y-1/2 rounded-full bg-slate-200"></div>
                    <div class="pointer-events-none absolute left-0 top-1/2 h-1 w-full -translate-y-1/2 rounded-full bg-primary" data-price-range-fill></div>
                    <input type="range" min="0" max="2000000" step="5000" value="{{ request('min_price', 0) }}" aria-label="Atur harga minimum" data-price-slider="min" class="absolute inset-0 z-10 m-0 h-6 w-full appearance-none pointer-events-none bg-transparent accent-primary [&::-webkit-slider-runnable-track]:bg-transparent [&::-moz-range-track]:bg-transparent [&::-webkit-slider-thumb]:pointer-events-auto [&::-moz-range-thumb]:pointer-events-auto">
                    <input type="range" min="0" max="2000000" step="5000" value="{{ request()->filled('max_price') ? request('max_price') : 2000000 }}" aria-label="Atur harga maksimum" data-price-slider="max" class="absolute inset-0 z-20 m-0 h-6 w-full appearance-none pointer-events-none bg-transparent accent-primary [&::-webkit-slider-runnable-track]:bg-transparent [&::-moz-range-track]:bg-transparent [&::-webkit-slider-thumb]:pointer-events-auto [&::-moz-range-thumb]:pointer-events-auto">
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="rounded-xl bg-primary px-4 py-3 text-sm font-semibold text-primary-foreground transition hover:bg-primary/90 focus:outline-none focus:ring-4 focus:ring-primary/30">
        Terapkan filter
    </button>
</form>