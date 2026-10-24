<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CatalogController
{
    public function index(Request $request): View
    {
        $query = Products::query();

        if ($request->filled('q')) {
            $search = trim($request->q);

            $query->where(function ($searchQuery) use ($search) {
                $searchQuery->whereRaw('LOWER(name) LIKE ?', ['%'.mb_strtolower($search).'%'])
                    ->orWhereRaw('LOWER(category) LIKE ?', ['%'.mb_strtolower($search).'%']);
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->latest()->paginate(15)->withQueryString();
        $categories = Products::query()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('catalog', compact('products', 'categories'));
    }

    public function show(Products $product): View
    {
        return view('product', compact('product'));
    }
}
