<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index(): View
    {
        return view('pages.checkout');
    }

    public function process(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:150',
            'customer_phone' => 'required|string|max:40',
            'customer_email' => 'nullable|email|max:150',
            'delivery_city' => 'required|string|max:100',
            'delivery_area' => 'required|string|max:100',
            'delivery_address' => 'required|string|max:500',
            'delivery_method' => 'required|string',
            'payment_method' => 'required|string',
            'notes' => 'nullable|string|max:500',
            'cart_data' => 'required|string',
        ]);

        $cartItems = json_decode($validated['cart_data'], true);

        if (empty($cartItems) || !is_array($cartItems)) {
            return redirect()->route('shop')->with('error', 'Your bag is empty.');
        }

        // Calculate subtotal from valid product items
        $subtotal = 0;
        $orderItemsData = [];

        foreach ($cartItems as $item) {
            $qty = max(1, (int) ($item['quantity'] ?? 1));
            $price = (float) ($item['price'] ?? 10000);
            $lineSubtotal = $price * $qty;
            $subtotal += $lineSubtotal;

            $orderItemsData[] = [
                'product_id' => $item['id'] ?? null,
                'product_name' => $item['name'] ?? 'Biltong Pack',
                'pack_size' => $item['pack_size'] ?? '100g',
                'unit_price' => $price,
                'quantity' => $qty,
                'subtotal' => $lineSubtotal,
            ];
        }

        // Delivery fee calculation
        $deliveryFee = 5000.00;
        if ($validated['delivery_method'] === 'pickup') {
            $deliveryFee = 0.00;
        } elseif ($validated['delivery_method'] === 'upcountry') {
            $deliveryFee = 12000.00;
        } else {
            // Dar express
            if ($subtotal >= 50000) {
                $deliveryFee = 0.00;
            }
        }

        $total = $subtotal + $deliveryFee;

        // Generate distinctive Order Number e.g. INAS-202611-4821
        $orderNumber = 'INAS-' . date('Ym') . '-' . strtoupper(Str::random(4));

        $order = Order::create([
            'order_number' => $orderNumber,
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'],
            'customer_email' => $validated['customer_email'] ?? null,
            'delivery_city' => $validated['delivery_city'],
            'delivery_area' => $validated['delivery_area'],
            'delivery_address' => $validated['delivery_address'],
            'delivery_method' => $validated['delivery_method'],
            'delivery_fee' => $deliveryFee,
            'subtotal' => $subtotal,
            'total' => $total,
            'payment_method' => $validated['payment_method'],
            'payment_status' => 'pending',
            'order_status' => 'pending',
            'notes' => $validated['notes'] ?? null,
            'ordered_via_whatsapp' => false,
        ]);

        foreach ($orderItemsData as $orderItem) {
            $order->items()->create($orderItem);
        }

        return redirect()->route('order.confirmation', $order->order_number);
    }

    public function confirmation(string $orderNumber): View
    {
        $order = Order::with('items')->where('order_number', $orderNumber)->firstOrFail();
        return view('pages.order-confirmation', compact('order'));
    }
}
