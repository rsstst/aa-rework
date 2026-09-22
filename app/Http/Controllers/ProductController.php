<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductController
{
    public function indexProducts(){
        $products = Products::all();
        return view('catalog', ['products' => $products]);
    }
}
