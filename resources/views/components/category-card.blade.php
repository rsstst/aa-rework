@props(['category'])

<a
    {{ $attributes->merge(['class' => 'group overflow-hidden rounded-2xl bg-white shadow-[0_10px_30px_rgba(15,23,42,0.08)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_18px_40px_rgba(15,23,42,0.14)] focus:outline-none focus:ring-4 focus:ring-primary/30']) }}
    href="{{ route('catalog', ['category' => $category]) }}"
>
    <div class="aspect-[4/3] overflow-hidden">
        <img
            class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
            src="https://placehold.co/800x600}"
            alt="Kategori {{ \Illuminate\Support\Str::headline($category) }}"
        >
    </div>
    <div class="flex items-center justify-between gap-3 px-5 py-4">
        <h2 class="font-semibold text-slate-900">{{ \Illuminate\Support\Str::headline($category) }}</h2>
        <svg class="h-5 w-5 text-primary transition-transform group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h13m-5-5 5 5-5 5" />
        </svg>
    </div>
</a>
