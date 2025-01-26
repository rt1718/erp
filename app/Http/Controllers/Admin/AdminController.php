<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Sale;
use http\Env\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalSales = Sale::query()->sum('total_price'); // Общий доход
        $totalExpenses = Invoice::query()->sum('purchase_price'); // Общий расход
        $profit = $totalSales - $totalExpenses; // Прибыль
        $totalProducts = Product::query()->sum('quantity'); // Остатки на складе

        $incomeExpenseLabels = Sale::query()->selectRaw('DATE(sale_date) as date')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('date');
        $incomeData = Sale::query()->selectRaw('SUM(total_price) as income')
            ->groupBy('sale_date')
            ->orderBy('sale_date')
            ->pluck('income');
        $expenseData = Invoice::query()->selectRaw('SUM(purchase_price) as expense')
            ->groupBy('created_at')
            ->orderBy('created_at')
            ->pluck('expense');

        // Топ продаваемых товаров
        $topProducts = Sale::query()->select('product_id', DB::raw('SUM(quantity) as total'))
            ->groupBy('product_id')
            ->orderByDesc('total')
            ->take(10)
            ->with('product')
            ->get();
        $topProductsLabels = $topProducts->pluck('product.title');
        $topProductsData = $topProducts->pluck('total');

        return view('admin.index', compact(
            'totalSales',
            'totalExpenses',
            'profit',
            'totalProducts',
            'incomeExpenseLabels',
            'incomeData',
            'expenseData',
            'topProductsLabels',
            'topProductsData'
        ));
    }
}
