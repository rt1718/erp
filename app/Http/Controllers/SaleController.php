<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaleRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $products = Product::query()->get();
        $categories = Category::query()->get();
        return view('admin.sale.index', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function store(StoreSaleRequest $request)
    {
        $validatedData = $request->validated();
//        dd($validatedData);

        foreach ($validatedData['products'] as $data) {

            $product = Product::findOrFail($data['product_id']);

            $saleQuantity = $data['quantity'];

            if ($product->quantity > 0) {

                if ($product->quantity - $saleQuantity < 0) {
                    return back()->withErrors([
                        'error' => "Недостаточно товара для: {$product->title}",
                    ]);
                }

                Product::query()
                    ->update([
                        'quantity' => $product->quantity - $saleQuantity,
                    ]);
            }

            Sale::query()
                ->create([
                    'product_id' => $product->id,
                    'title' => $product->title,
                    'quantity' => $saleQuantity,
                    'total_price' => $saleQuantity * $product->sale_price,
                    'sale_date' => now(),
                ]);
        }
        return redirect()->route('sale.index')
            ->with('success', 'Продажа успешно добавлена!');
    }
}
