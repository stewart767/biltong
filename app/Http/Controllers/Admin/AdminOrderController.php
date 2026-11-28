<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminOrderController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->get('status');
        $paymentStatus = $request->get('payment_status');
        $search = $request->get('search');

        $query = Order::with(['items', 'payments', 'delivery'])->latest();

        if ($status && $status !== 'all') {
            $query->where('order_status', $status);
        }

        if ($paymentStatus && $paymentStatus !== 'all') {
            $query->where('payment_status', $paymentStatus);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_phone', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%");
            });
        }

        $orders = $query->paginate(15)->withQueryString();
        $allStatuses = Order::getStatuses();

        return view('admin.orders.index', compact('orders', 'allStatuses', 'status', 'paymentStatus', 'search'));
    }

    public function show(Order $order): View
    {
        $order->load(['items.product', 'payments', 'delivery', 'user']);
        $allStatuses = Order::getStatuses();

        return view('admin.orders.show', compact('order', 'allStatuses'));
    }

    public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'order_status' => 'required|string',
            'payment_status' => 'required|in:pending,paid,failed,refunded',
            'payment_reference' => 'nullable|string|max:100',
        ]);

        $order->update([
            'order_status' => $validated['order_status'],
            'payment_status' => $validated['payment_status'],
            'payment_reference' => $validated['payment_reference'] ?? $order->payment_reference,
        ]);

        ActivityLog::log(
            'updated_order_status',
            "Order #{$order->order_number} status updated to {$validated['order_status']} ({$validated['payment_status']})",
            $order
        );

        return back()->with('success', "Order #{$order->order_number} status updated to {$validated['order_status']}.");
    }

    public function confirmPayment(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'transaction_reference' => 'required|string|max:100',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
        ]);

        $order->update([
            'payment_status' => 'paid',
            'payment_reference' => $validated['transaction_reference'],
            'order_status' => in_array($order->order_status, [Order::STATUS_PENDING, Order::STATUS_AWAITING_PAYMENT]) ? Order::STATUS_PAID : $order->order_status,
        ]);

        $payment = $order->payments()->first();
        if ($payment) {
            $payment->update([
                'transaction_reference' => $validated['transaction_reference'],
                'amount' => $validated['amount'],
                'status' => 'verified',
                'verified_at' => now(),
                'verified_by' => Auth::id(),
            ]);
        } else {
            Payment::create([
                'order_id' => $order->id,
                'transaction_reference' => $validated['transaction_reference'],
                'payment_method' => $validated['payment_method'],
                'amount' => $validated['amount'],
                'currency' => 'TZS',
                'status' => 'verified',
                'verified_at' => now(),
                'verified_by' => Auth::id(),
            ]);
        }

        ActivityLog::log('verified_payment', "Payment of TZS " . number_format($validated['amount'], 0) . " verified for Order #{$order->order_number}", $order);

        return back()->with('success', "Payment of TZS " . number_format($validated['amount'], 0) . " confirmed for Order #{$order->order_number}.");
    }

    public function updateDelivery(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'carrier' => 'nullable|string|max:100',
            'tracking_number' => 'nullable|string|max:100',
            'delivery_status' => 'required|string',
            'rider_name' => 'nullable|string|max:100',
            'rider_phone' => 'nullable|string|max:50',
            'delivery_notes' => 'nullable|string|max:500',
        ]);

        $delivery = $order->delivery;
        $data = [
            'carrier' => $validated['carrier'] ?? 'COY Express Dispatch',
            'tracking_number' => $validated['tracking_number'] ?? ($delivery?->tracking_number ?? 'TRK-' . strtoupper(substr(md5($order->id . time()), 0, 8))),
            'status' => $validated['delivery_status'],
            'rider_name' => $validated['rider_name'] ?? null,
            'rider_phone' => $validated['rider_phone'] ?? null,
            'notes' => $validated['delivery_notes'] ?? null,
        ];

        if ($validated['delivery_status'] === 'dispatched' && !$delivery?->dispatched_at) {
            $data['dispatched_at'] = now();
        } elseif ($validated['delivery_status'] === 'delivered') {
            $data['delivered_at'] = now();
            $order->update(['order_status' => Order::STATUS_DELIVERED]);
        }

        if ($delivery) {
            $delivery->update($data);
        } else {
            $order->delivery()->create($data);
        }

        return back()->with('success', 'Delivery tracking updated.');
    }

    public function invoice(Order $order): View
    {
        $order->load(['items.product', 'payments', 'delivery', 'user']);
        return view('admin.orders.invoice', compact('order'));
    }
}
