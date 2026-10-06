<div class="sticky top-0 z-10 w-full flex flex-row gap-4 p-4 bg-[#2b3035] justify-between">
    <div class="flex flex-row gap-4 ">
        <img class="h-12" src="https://placehold.co/800x600" alt="">
        <img class="h-12" src="https://placehold.co/800x600" alt="">
    </div>
    <div class="flex flex-row gap-4 items-center text-gray-400">
        <a class="hover:text-white {{ request()->routeIs('home') ? 'text-white' : '' }}" href={{ route('home') }}>Home</a>
        <a class="hover:text-white {{ request()->routeIs('catalog') ? 'text-white' : '' }}" href={{ route('catalog') }}>Katalog</a>
        <a class="hover:text-white {{ request()->routeIs('order') ? 'text-white' : '' }}" href={{ route('order') }}>Order</a>
    </div>
</div>