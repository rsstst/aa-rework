@vite(['resources/css/app.css', 'resources/js/app.js'])

<body class="overflow-hidden">
    <div>
        @include('components.navbar')
    </div>

    <div class="w-full h-screen flex flex-col items-center mt-32 gap-4">
        <div class="flex flex-row gap-4">
            <img class="w-32 rounded-xl" src="https://placehold.co/800x600/red/white?text=lorem" alt="">
            <img class="w-32 rounded-xl" src="https://placehold.co/800x600/red/white?text=ipsum" alt="">
        </div>
        <h1 class="text-5xl font-bold text-center">Belanja Atap Online</h1>
        <p>This is some kind of catchphrase. lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        <div class="flex flex-row gap-4 items-center text-center justify-center">
            <a class="transition duration-300 text-white bg-blue-500 hover:bg-blue-700 w-32 py-2.5 flex items-center justify-center text-xl rounded-xl" href={{ route('catalog') }}>Katalog</a>
            <a class="transition duration-300 text-white bg-blue-500 hover:bg-blue-700 w-32 py-2.5 flex items-center justify-center text-xl rounded-xl" href={{ route('order') }}>Order</a>
        </div>
        <span class="border-b-2 border-blue-500 w-2xl"></span>
        <div class="flex flex-row gap-12 text-gray-500">
            <p class="w-1/3">Maybe some kind of benefit?</p>
            <p class="w-1/3">Gratis ongkir(daerah tertentu)</p>
            <p class="w-1/3">garansi 2 jam</p>
        </div>
    </div>
</body>
