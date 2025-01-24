<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WriteOffController extends Controller
{
    public function create()
    {
        $products = Product::query()->get();

        return view('writeOff.create', [
            'products' => $products,
        ]);
    }

    public function store()
    {
        
    }
}
