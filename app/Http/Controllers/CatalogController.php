<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class CatalogController
{

    public function index(Request $request){

    $query = Products::query();

        if ($request->filled('category')){
            $query->where('category', $request->category);
        }
        if ($request->filled('min_price')){
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')){
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->get();
        
        return view('catalog', compact('products'));
    }
}
