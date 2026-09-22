@vite(['resources/css/app.css', 'resources/js/app.js'])
@include('components.navbar')

<body>
    <div class="flex flex-row p-8">
        @include('components.filter')
        <div class="flex flex-row flex-wrap items-center gap-4 p-4">
            @foreach ($products as $p)
                <div class="flex flex-col w-96 border border-black rounded-lg p-4">
                    <img src="https://placehold.co/800x600?text=dummy product" alt="">
                    <h2 class="text-lg font-bold">{{ $p->name }}</h2>
                    <p class="text-gray-600">{{ Illuminate\Support\Number::currency($p->price, in:'IDR', locale:'id') }}</p>
                    <a class="self-end bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold w-fit h-fit p-2 rounded"
                        href="#">button</a>
                </div>
            @endforeach
        </div>
    </div>
</body>
