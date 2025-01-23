<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\NoReturn;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::query()->orderBy('created_at')->get();
        return view('admin.product.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()->pluck('title', 'id')->all();
        return view('admin.product.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $validatedData = $request->validated();

        Product::query()->create($validatedData);

        return redirect()->route('products.index')->with('success', 'Продукт добавлен!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $products = Product::query()->findOrFail($id);
        $categories = Category::query()->pluck('title', 'id')->all();
        return view('admin.product.edit', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    #[NoReturn] public function update(StoreProductRequest $request, string $id)
    {
        $products = Product::query()->findOrFail($id);

        $validatedData = $request->validated();
//        dd($validatedData);

        $products->update($validatedData);

        return redirect()->route('products.index')->with('success', 'Изменено!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $products = Product::query()->findOrFail($id);
        $products->delete();
        return redirect()->route('admin.products.index')->with('success', 'Удалено!');
    }
}
