<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\NewsletterSubscriber;
use App\Models\Order;
use App\Models\Product;
use App\Models\WholesaleEnquiry;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total');
        $allOrdersCount = Order::count();
        $pendingOrdersCount = Order::where('order_status', 'pending')->count();
        $productsCount = Product::count();
        $categoriesCount = Category::count();
        $lowStockProducts = Product::where('stock', '<=', 10)->get();
        $wholesaleCount = WholesaleEnquiry::where('status', 'new')->count();
        $unreadMessagesCount = ContactMessage::where('status', 'unread')->count();
        $subscribersCount = NewsletterSubscriber::count();

        $recentOrders = Order::with('items')->latest()->take(6)->get();
        $recentWholesale = WholesaleEnquiry::latest()->take(5)->get();
        $recentMessages = ContactMessage::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'allOrdersCount',
            'pendingOrdersCount',
            'productsCount',
            'categoriesCount',
            'lowStockProducts',
            'wholesaleCount',
            'unreadMessagesCount',
            'subscribersCount',
            'recentOrders',
            'recentWholesale',
            'recentMessages'
        ));
    }
}
