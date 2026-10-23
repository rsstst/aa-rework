@php
    $cartCount = collect(session('cart', []))->sum();
@endphp

<header
    class="sticky top-0 z-50 border-b border-primary/20 bg-white/60 shadow-[0_6px_24px_rgba(15,23,42,0.06)] backdrop-blur-md transition-[background-color,box-shadow,border-color,backdrop-filter] duration-300"
    data-site-header>

    <div class="mx-auto max-w-7xl px-4 lg:px-8">
        <div class="flex min-h-14 items-center gap-2.5 sm:gap-3">
            <a class="group flex h-9 w-28 shrink-0 items-center overflow-hidden rounded-lg sm:w-32" href="{{ route('home') }}" aria-label="Beranda">
                <img class="h-full w-full object-cover transition duration-300 group-hover:scale-105" src="https://placehold.co/800x600/red/white?text=Placeholder+Logo" alt="Logo toko material">
            </a>

            <a class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg text-slate-700 transition hover:bg-slate-100 hover:text-primary focus:outline-none focus:ring-4 focus:ring-primary/20"
                href="{{ route('catalog') }}" aria-label="Buka katalog" title="Katalog">
                <i class="fa-solid fa-store text-base" aria-hidden="true"></i>
            </a>
            <form class="relative min-w-0 ms-auto w-full max-w-xs sm:max-w-sm" action="{{ route('catalog') }}"
                method="GET" role="search">
                <label class="sr-only" for="site-search">Cari produk atau kebutuhan proyek</label>
                <svg class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <circle cx="11" cy="11" r="6.5" />
                    <path stroke-linecap="round" d="m16 16 4 4" />
                </svg>
                <input id="site-search"
                    class="h-9 w-full rounded-lg border border-slate-200 bg-white/70 pl-10 pr-10 text-xs text-slate-950 outline-none transition placeholder:text-slate-400 focus:border-primary focus:bg-white focus:ring-4 focus:ring-primary/15 sm:text-sm [&::-webkit-search-cancel-button]:appearance-none"
                    type="search" name="q" value="{{ request('q') }}" placeholder="Cari genteng, semen, besi..."
                    autocomplete="off">
                <button
                    class="invisible absolute right-2.5 top-1/2 flex h-6 w-6 -translate-y-1/2 items-center justify-center rounded-full text-slate-400 opacity-0 transition hover:bg-slate-200 hover:text-slate-700 data-[visible=true]:visible data-[visible=true]:opacity-100"
                    type="button" aria-label="Hapus pencarian" data-search-clear>
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        aria-hidden="true">
                        <path stroke-linecap="round" d="m6 6 12 12M18 6 6 18" />
                    </svg>
                </button>
            </form>
            <a class="hidden h-9 shrink-0 items-center gap-2 rounded-lg px-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 hover:text-primary focus:outline-none focus:ring-4 focus:ring-primary/20 sm:inline-flex"
                href="{{ route('order') }}" aria-label="Buka cart">
                <span class="relative">
                    <i class="fa-solid fa-cart-shopping text-base" aria-hidden="true"></i>
                    <span @class(['absolute -right-3 -top-3 min-w-4 rounded-full bg-red-600 px-1 text-center text-[10px] font-bold leading-4 text-white', 'hidden' => $cartCount === 0])
                        aria-hidden="true">{{ $cartCount }}</span>
                </span>
                <span>Cart</span>
            </a>

            <button
                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg text-slate-700 transition hover:bg-slate-100 lg:hidden"
                type="button" aria-label="Buka menu navigasi" aria-expanded="false" aria-controls="mobile-navigation"
                data-mobile-toggle>
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                    aria-hidden="true" data-menu-open>
                    <path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16" />
                </svg>
                <svg class="hidden h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                    aria-hidden="true" data-menu-close>
                    <path stroke-linecap="round" d="m6 6 12 12M18 6 6 18" />
                </svg>
            </button>
        </div>

        <div id="mobile-navigation" class="hidden border-t border-slate-100 py-4 lg:hidden" data-mobile-navigation>
            <div class="grid gap-2">
                <a class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-100"
                    href="{{ route('catalog') }}">
                    <i class="fa-solid fa-store w-5 text-center" aria-hidden="true"></i>
                    <span>Semua katalog</span>
                </a>
                <a class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-100"
                    href="{{ route('order') }}">
                    <span class="relative w-5 text-center">
                        <i class="fa-solid fa-cart-shopping" aria-hidden="true"></i>
                        <span @class(['absolute -right-1 -top-2 min-w-4 rounded-full bg-red-600 px-1 text-center text-[10px] font-bold leading-4 text-white', 'hidden' => $cartCount === 0])
                            aria-hidden="true">{{ $cartCount }}</span>
                    </span>
                    <span>Cart</span>
                </a>
            </div>
        </div>
    </div>
</header>
