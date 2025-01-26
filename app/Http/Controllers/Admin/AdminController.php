<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Общий доход
        $totalIncome = Sale::query()
            ->sum('total_price');

        // Доход за текущий год
        $yearIncome = Sale::query()
            ->whereYear('sale_date', now()
                ->year)
            ->sum('total_price');

        // Доход за каждый месяц текущего года
        $monthlyIncomes = Sale::query()
            ->whereYear('sale_date', now()->year)
            ->selectRaw('DATE_FORMAT(sale_date, "%M") as month, SUM(total_price) as income')
            ->groupByRaw('DATE_FORMAT(sale_date, "%M"), MONTH(sale_date)')
            ->orderByRaw('MONTH(sale_date)')
            ->pluck('income', 'month');

        // Топ продаваемые товары
        $topProducts = Sale::query()
            ->selectRaw('products.title, SUM(sales.quantity) as total_quantity')
            ->join('products', 'sales.product_id', '=', 'products.id')
            ->groupBy('products.title')
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get();

        return view('admin.index', [
            'totalIncome' => $totalIncome,
            'yearIncome' => $yearIncome,
            'monthlyIncomes' => $monthlyIncomes,
            'topProducts' => $topProducts,
        ]);
    }
}
