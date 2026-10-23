<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartController
{
    public function index(): View
    {
        $cart = $this->cartItems();

        return view('order', [
            'cart' => $cart,
            'total' => collect($cart)->sum(
                fn (array $item): int|float => $item['price'] * $item['quantity']
            ),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer', 'exists:product,id'],
        ]);

        $cart = session('cart', []);
        $productId = (string) $validated['product_id'];
        $cart[$productId] = ($cart[$productId] ?? 0) + 1;

        session(['cart' => $cart]);

        return redirect()
            ->route('order')
            ->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request, Products $product): RedirectResponse
    {
        $validated = $request->validate([
            'change' => ['required', 'integer', 'in:-1,1'],
        ]);

        $cart = session('cart', []);
        $productId = (string) $product->getKey();
        $quantity = ($cart[$productId] ?? 0) + $validated['change'];

        if ($quantity <= 0) {
            unset($cart[$productId]);
        } else {
            $cart[$productId] = $quantity;
        }

        session(['cart' => $cart]);

        return redirect()->route('order');
    }

    public function destroy(Products $product): RedirectResponse
    {
        $cart = session('cart', []);
        unset($cart[(string) $product->getKey()]);

        session(['cart' => $cart]);

        return redirect()->route('order');
    }

    /**
     * @return array<int, array{id: int, name: string, price: int|float, slug: string, category: string|null, quantity: int}>
     */
    private function cartItems(): array
    {
        $storedCart = session('cart', []);

        if ($storedCart === []) {
            return [];
        }

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

        return $cart;
    }
}
