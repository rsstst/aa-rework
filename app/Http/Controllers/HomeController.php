<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Contracts\View\View;

class HomeController
{
    public function index(): View
    {
        $categories = Products::query()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->limit(9)
            ->pluck('category');

        return view('index', compact('categories'));
    }
}
