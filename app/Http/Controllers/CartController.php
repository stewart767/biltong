<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CartController extends Controller
{
    public function __construct(
        protected CartService $cartService
    ) {}

    /**
     * Show shopping cart page.
     */
    public function index(): View
    {
        $deliveryMethod = request('delivery_method', 'dar_express');
        $summary = $this->cartService->getSummary($deliveryMethod);

        return view('pages.cart', [
            'cart' => $summary['cart'],
            'items' => $summary['cart']->items,
            'summary' => $summary,
        ]);
    }

    /**
     * Add item to cart.
     */
    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'variant_id' => 'nullable|exists:product_variants,id',
            'weight' => 'nullable|string',
            'quantity' => 'nullable|integer|min:1|max:100',
        ]);

        $item = $this->cartService->addItem(
            (int) $validated['product_id'],
            isset($validated['variant_id']) ? (int) $validated['variant_id'] : null,
            $validated['weight'] ?? null,
            (int) ($validated['quantity'] ?? 1)
        );

        $summary = $this->cartService->getSummary();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Added to your cart!',
                'items_count' => $summary['items_count'],
                'subtotal' => $summary['subtotal'],
                'formatted_subtotal' => 'TZS ' . number_format($summary['subtotal'], 0),
            ]);
        }

        return redirect()->back()->with('success', 'Item successfully added to your cart.');
    }

    /**
     * Update quantity of an item.
     */
    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:0|max:100',
        ]);

        $this->cartService->updateQuantity($id, (int) $validated['quantity']);
        $summary = $this->cartService->getSummary($request->input('delivery_method', 'dar_express'));

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'items_count' => $summary['items_count'],
                'subtotal' => $summary['subtotal'],
                'delivery_fee' => $summary['delivery_fee'],
                'total' => $summary['total'],
                'formatted_total' => 'TZS ' . number_format($summary['total'], 0),
            ]);
        }

        return redirect()->route('cart')->with('success', 'Cart updated successfully.');
    }

    /**
     * Remove item from cart.
     */
    public function remove(Request $request, int $id)
    {
        $this->cartService->removeItem($id);
        $summary = $this->cartService->getSummary($request->input('delivery_method', 'dar_express'));

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Item removed.',
                'items_count' => $summary['items_count'],
                'total' => $summary['total'],
            ]);
        }

        return redirect()->route('cart')->with('success', 'Item removed from your cart.');
    }

    /**
     * Clear active cart.
     */
    public function clear(): RedirectResponse
    {
        $this->cartService->clear();
        return redirect()->route('cart')->with('info', 'Your cart is now empty.');
    }

    /**
     * Apply discount coupon.
     */
    public function applyCoupon(Request $request)
    {
        $request->validate(['code' => 'required|string']);
        $code = strtoupper(trim($request->input('code')));

        $coupon = Coupon::where('code', $code)->first();
        $summary = $this->cartService->getSummary();

        if (!$coupon || !$coupon->isValidForAmount($summary['subtotal'])) {
            $msg = !$coupon ? 'Invalid discount code.' : 'Order amount does not meet coupon requirements (Min: TZS ' . number_format($coupon->min_order_amount, 0) . ').';
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['success' => false, 'message' => $msg], 422);
            }
            return redirect()->back()->with('error', $msg);
        }

        Session::put('applied_coupon', $code);

        if ($request->wantsJson() || $request->ajax()) {
            $newSummary = $this->cartService->getSummary();
            return response()->json([
                'success' => true,
                'message' => "Coupon {$code} applied successfully!",
                'discount' => $newSummary['discount'],
                'total' => $newSummary['total'],
            ]);
        }

        return redirect()->back()->with('success', "Coupon {$code} applied successfully!");
    }

    /**
     * Remove applied coupon.
     */
    public function removeCoupon(): RedirectResponse
    {
        Session::forget('applied_coupon');
        return redirect()->back()->with('info', 'Coupon removed.');
    }

    /**
     * Fetch count for live badge.
     */
    public function count(): JsonResponse
    {
        $summary = $this->cartService->getSummary();
        return response()->json(['count' => $summary['items_count']]);
    }
}
