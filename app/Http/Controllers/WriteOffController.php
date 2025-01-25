<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWriteOffRequest;
use App\Models\Product;
use App\Models\WriteOff;

class WriteOffController extends Controller
{
    public function create()
    {
        $products = Product::query()->where([
            ['quantity', '!=', 0],
            ['purchase_price', '!=', 0],
        ])
            ->get();

        return view('admin.writeOff.create', [
            'products' => $products,
        ]);
    }

    public function store(StoreWriteOffRequest $request)
    {
        $validatedData = $request->validated();

        foreach ($validatedData['products'] as $productId => $data) {
            $product = Product::query()->findOrFail($productId);

            if ($product) {
                // Вычитаем количество из products
                $newQuantity = $product->quantity - ($data['quantity'] ?? 0);

                if ($newQuantity < 0) {
                    return redirect()->back()->withErrors([
                        'quantity' => "Недостаточно товара на складе для списания.",
                    ])->withInput();
                }

                $product->update([
                    'quantity' => $newQuantity,
                ]);

                // Создаём запись в таблице WriteOff
                WriteOff::query()->create([
                    'title' => $data['product_title'],
                    'product_id' => $productId,
                    'quantity' => $data['quantity'] ?? 0, // Количество, которое списали
                ]);
            }
        }

        return redirect()->route('write-off.create')->with('success', 'Добавлено!');
    }
}
