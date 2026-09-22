@vite('resources/css/app.css')

<div class="flex flex-col w-1/4 gap-4 p-4 bg-red-300">
    <h1 class="text-2xl font-bold">Filter</h1>
    <div class="flex flex-col gap-2">
        <label for="category" class="font-semibold">Category</label>
        <select name="category" id="category" class="border border-gray-300 rounded p-2">
            <option value="">All</option>
            <option value="cat1">Category 1</option>
            <option value="cat2">Category 2</option>
            <option value="cat3">Category 3</option>
        </select>
    </div>
    <div class="flex flex-col gap-2">
        <label for="price" class="font-semibold">Price Range</label>
        <input type="number" name="min_price" id="min_price" placeholder="Min Price"
            class=" border border-gray-300 rounded p-2">
        <input type="number" name="max_price" id="max_price" placeholder="Max Price"
            class="border border-gray-300 rounded p-2">
    </div>
</div>
