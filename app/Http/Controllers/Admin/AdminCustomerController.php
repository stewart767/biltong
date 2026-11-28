<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminCustomerController extends Controller
{
    public function index(Request $request): View
    {
        $query = User::with(['profile', 'addresses'])
            ->withCount('orders')
            ->withSum('orders', 'total')
            ->where('is_admin', false);

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $customers = $query->latest()->paginate(15)->withQueryString();

        return view('admin.customers.index', compact('customers'));
    }

    public function show(User $customer): View
    {
        $customer->load(['profile', 'addresses', 'orders.items']);
        $totalSpent = $customer->orders->where('order_status', '!=', 'Cancelled')->sum('total');

        return view('admin.customers.show', compact('customer', 'totalSpent'));
    }
}
