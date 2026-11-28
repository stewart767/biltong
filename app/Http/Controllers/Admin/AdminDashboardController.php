<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\NewsletterSubscriber;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use App\Models\WholesaleEnquiry;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        // Overview metrics required by Section 7
        $totalSales = Order::where('order_status', '!=', Order::STATUS_CANCELLED)->sum('total');
        $totalOrders = Order::count();
        $pendingOrders = Order::whereIn('order_status', [Order::STATUS_PENDING, Order::STATUS_AWAITING_PAYMENT, 'pending'])->count();
        $completedOrders = Order::whereIn('order_status', [Order::STATUS_PAID, Order::STATUS_DELIVERED, 'delivered'])->count();
        $totalCustomers = User::where('is_admin', false)->count();
        $lowStockProducts = Product::where('stock', '<=', 15)->orderBy('stock')->get();
        $recentTransactions = Payment::with('order')->latest()->take(6)->get();

        $productsCount = Product::count();
        $categoriesCount = Category::count();
        $unreadMessagesCount = ContactMessage::where('status', 'unread')->count();
        $subscribersCount = NewsletterSubscriber::count();

        $recentOrders = Order::with('items')->latest()->take(7)->get();

        return view('admin.dashboard', compact(
            'totalSales',
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'totalCustomers',
            'lowStockProducts',
            'recentTransactions',
            'productsCount',
            'categoriesCount',
            'unreadMessagesCount',
            'subscribersCount',
            'recentOrders'
        ));
    }
}
