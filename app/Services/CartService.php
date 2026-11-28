<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartService
{
    /**
     * Get or create the active cart.
     */
    public function getCart(): Cart
    {
        $userId = Auth::id();
        $sessionId = Session::getId();

        if ($userId) {
            $cart = Cart::with(['items.product.images', 'items.variant'])
                ->firstOrCreate(
                    ['user_id' => $userId, 'status' => 'active'],
                    ['session_id' => $sessionId]
                );
        } else {
            $cart = Cart::with(['items.product.images', 'items.variant'])
                ->firstOrCreate(
                    ['session_id' => $sessionId, 'status' => 'active'],
                    ['user_id' => null]
                );
        }

        return $cart;
    }

    /**
     * Add product to cart.
     */
    public function addItem(int $productId, ?int $variantId = null, ?string $weight = null, int $quantity = 1): CartItem
    {
        $cart = $this->getCart();
        $product = Product::findOrFail($productId);

        $price = $product->effective_price;
        $resolvedWeight = $weight ?? $product->pack_size ?? '100g';

        if ($variantId) {
            $variant = ProductVariant::where('product_id', $productId)->find($variantId);
            if ($variant) {
                $price = $variant->effective_price;
                $resolvedWeight = $variant->weight;
            }
        } elseif ($weight) {
            $variant = ProductVariant::where('product_id', $productId)->where('weight', $weight)->first();
            if ($variant) {
                $variantId = $variant->id;
                $price = $variant->effective_price;
            }
        }

        $existing = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->where(function ($q) use ($variantId, $resolvedWeight) {
                if ($variantId) {
                    $q->where('variant_id', $variantId);
                } else {
                    $q->where('weight', $resolvedWeight);
                }
            })
            ->first();

        if ($existing) {
            $existing->quantity += $quantity;
            $existing->save();
            return $existing;
        }

        return CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $productId,
            'variant_id' => $variantId,
            'weight' => $resolvedWeight,
            'quantity' => max(1, $quantity),
            'price' => $price,
        ]);
    }

    /**
     * Update cart item quantity.
     */
    public function updateQuantity(int $cartItemId, int $quantity): bool
    {
        $cart = $this->getCart();
        $item = CartItem::where('cart_id', $cart->id)->where('id', $cartItemId)->first();

        if (!$item) {
            return false;
        }

        if ($quantity <= 0) {
            $item->delete();
            return true;
        }

        $item->quantity = $quantity;
        return $item->save();
    }

    /**
     * Remove item from cart.
     */
    public function removeItem(int $cartItemId): bool
    {
        $cart = $this->getCart();
        return (bool) CartItem::where('cart_id', $cart->id)->where('id', $cartItemId)->delete();
    }

    /**
     * Clear all items in active cart.
     */
    public function clear(): void
    {
        $cart = $this->getCart();
        $cart->items()->delete();
        Session::forget('applied_coupon');
    }

    /**
     * Get summary figures.
     */
    public function getSummary(string $deliveryMethod = 'dar_express'): array
    {
        $cart = $this->getCart();
        $subtotal = 0;

        foreach ($cart->items as $item) {
            $subtotal += ($item->price * $item->quantity);
        }

        $couponCode = Session::get('applied_coupon');
        $discount = 0;
        $coupon = null;

        if ($couponCode) {
            $coupon = Coupon::where('code', $couponCode)->first();
            if ($coupon && $coupon->isValidForAmount($subtotal)) {
                $discount = $coupon->calculateDiscount($subtotal);
            } else {
                Session::forget('applied_coupon');
                $couponCode = null;
            }
        }

        $deliveryFee = 5000.0;
        if ($deliveryMethod === 'pickup') {
            $deliveryFee = 0.0;
        } elseif ($deliveryMethod === 'upcountry') {
            $deliveryFee = 12000.0;
        } else {
            // Dar es Salaam Express: Free over TZS 50,000
            if ($subtotal >= 50000) {
                $deliveryFee = 0.0;
            }
        }

        $total = max(0, $subtotal - $discount + $deliveryFee);

        return [
            'cart' => $cart,
            'items_count' => (int) $cart->items->sum('quantity'),
            'subtotal' => $subtotal,
            'discount' => $discount,
            'coupon_code' => $couponCode,
            'coupon' => $coupon,
            'delivery_fee' => $deliveryFee,
            'delivery_method' => $deliveryMethod,
            'total' => $total,
        ];
    }

    /**
     * Transfer guest session cart to authenticated user upon login.
     */
    public function migrateSessionCartToUser(int $userId): void
    {
        $sessionId = Session::getId();
        $guestCart = Cart::where('session_id', $sessionId)
            ->whereNull('user_id')
            ->where('status', 'active')
            ->first();

        if (!$guestCart) {
            return;
        }

        $userCart = Cart::firstOrCreate(
            ['user_id' => $userId, 'status' => 'active'],
            ['session_id' => $sessionId]
        );

        foreach ($guestCart->items as $item) {
            $existing = CartItem::where('cart_id', $userCart->id)
                ->where('product_id', $item->product_id)
                ->where('variant_id', $item->variant_id)
                ->first();

            if ($existing) {
                $existing->quantity += $item->quantity;
                $existing->save();
            } else {
                $item->cart_id = $userCart->id;
                $item->save();
            }
        }

        $guestCart->delete();
    }
}
