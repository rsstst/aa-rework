<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController
{
    public function index(): View
    {
        return view('order');
    }

    public function items(): JsonResponse
    {
        return response()->json($this->cartPayload());
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer', 'exists:product,id'],
        ]);

        $cart = session()->get('cart', []);
        $productId = (string) $validated['product_id'];
        $cart[$productId] = ($cart[$productId] ?? 0) + 1;

        session()->put('cart', $cart);

        return response()->json($this->cartPayload());
    }

    public function update(Request $request, Products $product): JsonResponse
    {
        $validated = $request->validate([
            'change' => ['required', 'integer', 'in:-1,1'],
        ]);

        $cart = session()->get('cart', []);
        $productId = (string) $product->getKey();
        $quantity = ($cart[$productId] ?? 0) + $validated['change'];

        if ($quantity <= 0) {
            unset($cart[$productId]);
        } else {
            $cart[$productId] = $quantity;
        }

        session()->put('cart', $cart);

        return response()->json($this->cartPayload());
    }

    public function destroy(Products $product): JsonResponse
    {
        $cart = session()->get('cart', []);
        unset($cart[(string) $product->getKey()]);

        session()->put('cart', $cart);

        return response()->json($this->cartPayload());
    }

    /**
     * @return array{cart: array<int, array{id: int, name: string, price: int|float, slug: string, category: string|null, quantity: int}>, total: int|float}
     */
    private function cartPayload(): array
    {
        $storedCart = session()->get('cart', []);
        $products = Products::query()
            ->whereIn('id', array_keys($storedCart))
            ->get()
            ->keyBy(fn (Products $product): string => (string) $product->getKey());

        $cart = [];

        foreach ($storedCart as $productId => $quantity) {
            $product = $products->get((string) $productId);

            if (! $product) {
                continue;
            }

            $cart[] = [
                'id' => $product->getKey(),
                'name' => $product->name,
                'price' => $product->price,
                'slug' => $product->slug,
                'category' => $product->category,
                'quantity' => (int) $quantity,
            ];
        }

        return [
            'cart' => $cart,
            'total' => collect($cart)->sum(
                fn (array $item): int|float => $item['price'] * $item['quantity']
            ),
        ];
    }
}
