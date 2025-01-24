<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query()
            ->when($request
                ->get('search'), function ($query, $search) {
                $query
                    ->where('title', 'like', '%' . $search . '%');
            })
            ->orderBy('title', 'desc')
            ->paginate(10);
        return view('admin.inventory.index', [
            'products' => $products,
        ]);
    }
}
