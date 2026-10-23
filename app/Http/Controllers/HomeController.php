<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Contracts\View\View;

class HomeController
{
    public function index(): View
    {
        $products = Products::query()
            ->latest()
            ->limit(9)
            ->get();

        return view('index', compact('products'));
    }
}
