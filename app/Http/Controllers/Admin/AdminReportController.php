<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminReportController extends Controller
{
    public function index(Request $request): View
    {
        $period = $request->get('period', '30days');
        
        $startDate = match ($period) {
            '7days' => Carbon::now()->subDays(7),
            '90days' => Carbon::now()->subDays(90),
            'this_year' => Carbon::now()->startOfYear(),
            default => Carbon::now()->subDays(30),
        };

        $totalSales = Order::where('created_at', '>=', $startDate)
            ->where('order_status', '!=', Order::STATUS_CANCELLED)
            ->sum('total');

        $totalOrdersCount = Order::where('created_at', '>=', $startDate)->count();

        $completedOrdersCount = Order::where('created_at', '>=', $startDate)
            ->whereIn('order_status', [Order::STATUS_PAID, Order::STATUS_DELIVERED])
            ->count();

        $avgOrderValue = $totalOrdersCount > 0 ? ($totalSales / $totalOrdersCount) : 0;

        // Top selling products
        $topProducts = OrderItem::selectRaw('product_name, SUM(quantity) as total_qty, SUM(subtotal) as total_revenue')
            ->where('created_at', '>=', $startDate)
            ->groupBy('product_name')
            ->orderByDesc('total_revenue')
            ->take(8)
            ->get();

        // Revenue by category
        $categoriesReport = Category::withCount(['products' => fn ($q) => $q->where('is_active', true)])->get();

        // Low stock products
        $lowStockProducts = Product::where('stock', '<=', 15)->orderBy('stock')->get();

        // Customer acquisition
        $newCustomersCount = User::where('is_admin', false)->where('created_at', '>=', $startDate)->count();

        return view('admin.reports.index', compact(
            'period',
            'startDate',
            'totalSales',
            'totalOrdersCount',
            'completedOrdersCount',
            'avgOrderValue',
            'topProducts',
            'categoriesReport',
            'lowStockProducts',
            'newCustomersCount'
        ));
    }
}
