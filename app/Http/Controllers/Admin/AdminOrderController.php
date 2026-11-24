<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminOrderController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->get('status');
        $query = Order::with('items')->latest();

        if ($status && $status !== 'all') {
            $query->where('order_status', $status);
        }

        $orders = $query->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order): View
    {
        $order->load('items');
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'order_status' => 'required|in:pending,confirmed,processing,dispatched,delivered,cancelled',
            'payment_status' => 'required|in:pending,paid,failed',
        ]);

        $order->update($validated);

        return back()->with('success', "Order #{$order->order_number} status updated to " . ucfirst($validated['order_status']) . ".");
    }
}
