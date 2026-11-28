<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderTrackingController extends Controller
{
    public function index(Request $request): View
    {
        $query = $request->get('query') ?? $request->get('order_number');
        $order = null;

        if ($query) {
            $cleaned = trim($query);
            $order = Order::with(['items.product', 'payments', 'delivery'])
                ->where('order_number', $cleaned)
                ->orWhere('customer_phone', 'like', "%{$cleaned}%")
                ->latest()
                ->first();
        }

        return view('pages.track-order', compact('order'));
    }
}
