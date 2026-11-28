<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Address;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function __construct(
        protected CartService $cartService
    ) {}

    /**
     * Show Checkout Page.
     */
    public function index(): View|RedirectResponse
    {
        $summary = $this->cartService->getSummary();

        if ($summary['items_count'] === 0) {
            return redirect()->route('shop')->with('info', 'Your shopping cart is empty. Explore our premium beef biltong cuts!');
        }

        $user = Auth::user();
        $savedAddresses = $user ? $user->addresses : collect();
        $defaultAddress = $user ? $user->defaultAddress : null;

        return view('pages.checkout', [
            'cart' => $summary['cart'],
            'items' => $summary['cart']->items,
            'summary' => $summary,
            'user' => $user,
            'savedAddresses' => $savedAddresses,
            'defaultAddress' => $defaultAddress,
        ]);
    }

    /**
     * Show Dedicated Order Page.
     */
    public function orderPage(): View
    {
        $summary = $this->cartService->getSummary();
        $user = Auth::user();
        $savedAddresses = $user ? $user->addresses : collect();
        $defaultAddress = $user ? $user->defaultAddress : null;
        $products = \App\Models\Product::with(['category', 'images'])
            ->where('is_active', true)
            ->orderBy('is_featured', 'desc')
            ->get();

        return view('pages.order', [
            'cart' => $summary['cart'],
            'items' => $summary['cart']->items,
            'summary' => $summary,
            'user' => $user,
            'savedAddresses' => $savedAddresses,
            'defaultAddress' => $defaultAddress,
            'products' => $products,
        ]);
    }

    /**
     * Process Order Submission.
     */
    public function process(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:150',
            'customer_phone' => 'required|string|max:40',
            'customer_email' => 'nullable|email|max:150',
            'delivery_city' => 'required|string|max:100',
            'delivery_area' => 'required|string|max:100',
            'delivery_address' => 'required|string|max:500',
            'delivery_method' => 'nullable|string|in:dar_express,upcountry,pickup',
            'payment_method' => 'required|string|in:mpesa,airtel_money,tigo_pesa,halopesa,bank,cod',
            'notes' => 'nullable|string|max:500',
            'save_address' => 'nullable|boolean',
            'order_type' => 'nullable|string', // standard, whatsapp
            'items' => 'nullable|array',
        ]);

        $deliveryMethod = $validated['delivery_method'] ?? 'dar_express';

        // If direct booking page (/order) submitted items, sync them to cart
        if ($request->has('items') && is_array($request->input('items'))) {
            $hasItems = false;
            foreach ($request->input('items') as $qty) {
                if ((int)$qty > 0) {
                    $hasItems = true;
                    break;
                }
            }

            if ($hasItems) {
                $this->cartService->clear();
                foreach ($request->input('items') as $productId => $qty) {
                    $qty = (int) $qty;
                    if ($qty > 0) {
                        $this->cartService->addItem((int) $productId, $qty);
                    }
                }
            }
        }

        $summary = $this->cartService->getSummary($deliveryMethod);

        if ($summary['items_count'] === 0) {
            return redirect()->route('order')->with('error', 'Tafadhali chagua angalau chakula kimoja kuweka oda.');
        }

        $user = Auth::user();

        // Optionally save address to customer profile if requested
        if ($user && !empty($validated['save_address'])) {
            Address::create([
                'user_id' => $user->id,
                'label' => 'Delivery Address',
                'recipient_name' => $validated['customer_name'],
                'phone' => $validated['customer_phone'],
                'city' => $validated['delivery_city'],
                'area' => $validated['delivery_area'],
                'address_line' => $validated['delivery_address'],
                'is_default' => $user->addresses()->count() === 0,
            ]);
        }

        $isWhatsapp = ($request->input('order_type') === 'whatsapp') || $request->has('whatsapp_checkout');

        // Burger House Order Number e.g. BH-202611-7391
        $orderNumber = 'BH-' . date('Ym') . '-' . strtoupper(Str::random(4));

        $order = Order::create([
            'order_number' => $orderNumber,
            'user_id' => $user?->id,
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'],
            'customer_email' => $validated['customer_email'] ?? $user?->email,
            'delivery_city' => $validated['delivery_city'],
            'delivery_area' => $validated['delivery_area'],
            'delivery_address' => $validated['delivery_address'],
            'delivery_method' => match ($deliveryMethod) {
                'pickup' => 'Self Collection / Pickup',
                'upcountry' => 'Upcountry Delivery',
                default => 'Dar es Salaam Express Delivery',
            },
            'delivery_fee' => $summary['delivery_fee'],
            'subtotal' => $summary['subtotal'],
            'coupon_code' => $summary['coupon_code'],
            'discount_amount' => $summary['discount'],
            'total' => $summary['total'],
            'payment_method' => $validated['payment_method'],
            'payment_status' => 'pending',
            'order_status' => Order::STATUS_PENDING,
            'notes' => $validated['notes'] ?? null,
            'ordered_via_whatsapp' => true,
        ]);

        // Create Order Items with historical pricing
        foreach ($summary['cart']->items as $cartItem) {
            $order->items()->create([
                'product_id' => $cartItem->product_id,
                'product_name' => $cartItem->product->name,
                'pack_size' => $cartItem->weight ?? 'Regular',
                'unit_price' => $cartItem->price,
                'quantity' => $cartItem->quantity,
                'subtotal' => $cartItem->price * $cartItem->quantity,
            ]);

            // Decrement stock if tracked
            if ($cartItem->product && $cartItem->product->stock >= $cartItem->quantity) {
                $cartItem->product->decrement('stock', $cartItem->quantity);
            }
        }

        // Initialize payment record
        Payment::create([
            'order_id' => $order->id,
            'transaction_reference' => null,
            'payment_method' => $validated['payment_method'],
            'amount' => $order->total,
            'currency' => 'Tshs',
            'status' => 'pending',
            'sender_phone' => $validated['customer_phone'],
            'sender_name' => $validated['customer_name'],
        ]);

        // Initialize delivery tracking record
        Delivery::create([
            'order_id' => $order->id,
            'carrier' => 'Burger House Express Dispatch',
            'tracking_number' => 'TRK-' . strtoupper(Str::random(6)),
            'status' => 'pending',
            'notes' => 'Awaiting confirmation from Burger House kitchen.',
        ]);

        // If coupon was used, increment usage
        if ($summary['coupon']) {
            $summary['coupon']->increment('times_used');
        }

        // Activity log
        ActivityLog::create([
            'user_id' => $user?->id,
            'action' => 'placed_order',
            'subject_type' => Order::class,
            'subject_id' => $order->id,
            'description' => "Order #{$order->order_number} placed for Tshs " . number_format($order->total, 0),
            'ip_address' => $request->ip(),
        ]);

        // Clear shopping cart
        $this->cartService->clear();

        // Build comprehensive WhatsApp order dispatch message (Business line: 06621990)
        $whatsappNumber = \App\Models\SiteSetting::get('company_whatsapp', '2556621990');
        
        $msg = "🍔 *ODA MPYA YA BURGER HOUSE*\n";
        $msg .= "━━━━━━━━━━━━━━━━━━━━\n";
        $msg .= "📋 *Namba ya Oda:* #" . $order->order_number . "\n";
        $msg .= "👤 *Jina la Mteja:* " . $order->customer_name . "\n";
        $msg .= "📞 *Namba ya Simu:* " . $order->customer_phone . "\n";
        if ($order->customer_email) {
            $msg .= "📧 *Barua Pepe:* " . $order->customer_email . "\n";
        }
        $msg .= "📍 *Eneo / Location:* " . $order->delivery_area . ", " . $order->delivery_city . "\n";
        $msg .= "🏠 *Anwani Kamili:* " . $order->delivery_address . "\n";
        if ($order->notes) {
            $msg .= "📝 *Maelezo ya Ziada:* " . $order->notes . "\n";
        }
        $msg .= "━━━━━━━━━━━━━━━━━━━━\n";
        $msg .= "🛒 *Vyakula Vilivyoagizwa:*\n";
        foreach ($order->items as $i) {
            $msg .= "• {$i->product_name} x{$i->quantity} — Tshs " . number_format($i->subtotal, 0) . "\n";
        }
        $msg .= "━━━━━━━━━━━━━━━━━━━━\n";
        $msg .= "🛵 *Usafirishaji:* " . ($order->delivery_fee > 0 ? 'Tshs ' . number_format($order->delivery_fee, 0) : 'BURE (FREE)') . "\n";
        if ($order->discount_amount > 0) {
            $msg .= "🏷️ *Punguzo:* -Tshs " . number_format($order->discount_amount, 0) . "\n";
        }
        $msg .= "💰 *JUMLA KUU:* Tshs " . number_format($order->total, 0) . "\n";
        $msg .= "💳 *Njia ya Malipo:* " . strtoupper($order->payment_method) . "\n";
        $msg .= "━━━━━━━━━━━━━━━━━━━━\n";
        $msg .= "Habari Burger House! Nimetuma oda yangu hapa, naomba uthibitisho na kuanza kuandaliwa.";

        $whatsappUrl = 'https://wa.me/' . $whatsappNumber . '?text=' . urlencode($msg);

        return redirect()->route('order.confirmation', ['orderNumber' => $order->order_number])
            ->with('whatsapp_url', $whatsappUrl)
            ->with('success', 'Oda yako imepokelewa kikamilifu! Bonyeza kitufe hapa chini kutuma WhatsApp kwa uthibitisho wa haraka.');

        return redirect()->route('order.confirmation', ['orderNumber' => $order->order_number])
            ->with('success', 'Thank you! Your COY BILTONG order has been received.');
    }

    /**
     * Show Order Confirmation Page.
     */
    public function confirmation(string $orderNumber): View
    {
        $order = Order::with(['items.product', 'payments', 'delivery'])
            ->where('order_number', $orderNumber)
            ->firstOrFail();

        return view('pages.order-confirmation', [
            'order' => $order,
        ]);
    }
}
