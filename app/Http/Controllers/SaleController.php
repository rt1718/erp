<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaleRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use Carbon\Carbon;


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

        foreach ($validatedData['products'] as $data) {
            $product = Product::query()->findOrFail($data['product_id']);

            $saleQuantity = $data['quantity'];
            $totalPrice = $data['total_price'];

            // Рассчитываем итоговую сумму с учётом закупочной цены
            $totalPriceToStore = !empty($product->purchase_price)
                ? $totalPrice - ($saleQuantity * $product->purchase_price)
                : $totalPrice;

            // Если остаток NULL, пропускаем обновление количества
            if ($product->quantity === null) {
                Sale::query()->create([
                    'product_id' => $product->id,
                    'quantity' => $saleQuantity,
                    'total_price' => $totalPriceToStore,
                    'sale_date' => now(),
                ]);
                continue;
            }

            // Проверяем, достаточно ли остатков для товара с ненулевым количеством
            if ($product->quantity < $saleQuantity) {
                return back()->withErrors([
                    'error' => "Недостаточно товара для: {$product->title}",
                ]);
            }

            // Обновляем остаток
            $product->update([
                'quantity' => $product->quantity - $saleQuantity,
            ]);

            // Записываем продажу
            Sale::query()->create([
                'product_id' => $product->id,
                'quantity' => $saleQuantity,
                'total_price' => $totalPriceToStore,
                'sale_date' => now(),
            ]);
        }

        return redirect()
            ->route('sales.index')
            ->with('success', 'Продажа успешно добавлена!');
    }

}
