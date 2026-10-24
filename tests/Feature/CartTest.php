<?php

use App\Models\Products;

it('adds a product and returns the cart state', function () {
    $product = Products::factory()->create([
        'price' => 12500,
        'name' => 'Bata Ringan',
    ]);

    $response = $this->postJson(route('cart.store'), [
        'product_id' => $product->id,
    ]);

    $response
        ->assertOk()
        ->assertJsonPath('cart.0.id', $product->id)
        ->assertJsonPath('cart.0.quantity', 1)
        ->assertJsonPath('total', 12500);
});

it('changes quantity and removes a product when quantity reaches zero', function () {
    $product = Products::factory()->create(['price' => 10000]);

    $this->postJson(route('cart.store'), ['product_id' => $product->id]);

    $this->patchJson(route('cart.update', $product), ['change' => 1])
        ->assertJsonPath('cart.0.quantity', 2)
        ->assertJsonPath('total', 20000);

    $this->patchJson(route('cart.update', $product), ['change' => -1])
        ->assertJsonPath('cart.0.quantity', 1);

    $this->patchJson(route('cart.update', $product), ['change' => -1])
        ->assertOk()
        ->assertJsonPath('cart', [])
        ->assertJsonPath('total', 0);
});

it('rejects products that do not exist', function () {
    $this->postJson(route('cart.store'), ['product_id' => 999999])
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['product_id']);
});
