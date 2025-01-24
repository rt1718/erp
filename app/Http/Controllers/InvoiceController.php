<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceRequest;
use App\Models\Invoice;
use App\Models\Product;

class InvoiceController extends Controller
{
    public function create()
    {
        $products = Product::query()
            ->where([
                ['quantity', '!=', 0],
                ['purchase_price', '!=', 0],
            ])
            ->get();

        return view('admin.invoice.create', [
            'products' => $products,
        ]);
    }

    public function store(StoreInvoiceRequest $request)
    {
        $validatedData = $request->validated();

//        dd($validatedData);

        foreach ($validatedData['products'] as $productId => $data) {
            if (empty($data['quantity']) && empty($data['purchase_price'])) {
                continue; // Пропускаем пустую строку
            }

            $product = Product::query()->find($productId);

            if ($product) {
                $product->update([
                    'quantity' => $product->quantity + ($data['quantity'] ?? 0),
                    'purchase_price' => $data['purchase_price'] ?? $product->purchase_price,
                ]);

                Invoice::query()->create([
                    'product_id' => $productId,
                    'title' => $data['product_title'],
                    'quantity' => $data['quantity'] ?? 0,
                    'purchase_price' => $data['purchase_price'] ?? 0,
                ]);
            }
        }

        return redirect()->route('invoice.create')->with('success', 'Добавлено!');
    }
}
