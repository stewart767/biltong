<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutAndOrderTest extends TestCase
{
    use RefreshDatabase;

    protected Product $product;

    protected function setUp(): void
    {
        parent::setUp();

        $category = Category::create([
            'name' => 'Traditional Biltong',
            'slug' => 'traditional-biltong',
            'is_active' => true,
        ]);

        $this->product = Product::create([
            'category_id' => $category->id,
            'name' => 'Biltong Original',
            'slug' => 'biltong-original-100g',
            'pack_size' => '100g',
            'price' => 12000.00,
            'promo_price' => 10000.00,
            'stock' => 100,
            'is_active' => true,
        ]);
    }

    public function test_cart_and_checkout_pages_render(): void
    {
        $this->get('/cart')->assertStatus(200)->assertSee('Your Gourmet Bag');
        $this->get('/checkout')->assertStatus(200)->assertSee('Checkout Your Order');
    }

    public function test_order_can_be_placed_successfully(): void
    {
        $cartData = json_encode([
            [
                'id' => $this->product->id,
                'name' => $this->product->name,
                'slug' => $this->product->slug,
                'pack_size' => '100g',
                'price' => 10000,
                'quantity' => 2,
            ]
        ]);

        $response = $this->post('/checkout', [
            'customer_name' => 'Said Mwita',
            'customer_phone' => '0754 990 011',
            'customer_email' => 'said.mwita@outlook.com',
            'delivery_city' => 'Dar es Salaam',
            'delivery_area' => 'Masaki / Peninsula',
            'delivery_address' => 'Plot 55, Chole Road',
            'delivery_method' => 'dar_express',
            'payment_method' => 'mpesa',
            'notes' => 'Please call on arrival',
            'cart_data' => $cartData,
        ]);

        $order = Order::first();

        $this->assertNotNull($order);
        $this->assertEquals('Said Mwita', $order->customer_name);
        $this->assertEquals(20000.00, (float)$order->subtotal);
        $this->assertEquals(5000.00, (float)$order->delivery_fee);
        $this->assertEquals(25000.00, (float)$order->total);
        $this->assertCount(1, $order->items);

        $response->assertRedirect(route('order.confirmation', $order->order_number));
    }

    public function test_free_delivery_is_applied_above_threshold(): void
    {
        // 60,000 TZS order -> free delivery
        $cartData = json_encode([
            [
                'id' => $this->product->id,
                'name' => $this->product->name,
                'pack_size' => '100g',
                'price' => 10000,
                'quantity' => 6,
            ]
        ]);

        $this->post('/checkout', [
            'customer_name' => 'Zahra Ali',
            'customer_phone' => '0784 123 456',
            'delivery_city' => 'Dar es Salaam',
            'delivery_area' => 'Mikocheni',
            'delivery_address' => 'House 12, Rose Garden',
            'delivery_method' => 'dar_express',
            'payment_method' => 'tigopesa',
            'cart_data' => $cartData,
        ]);

        $order = Order::latest()->first();
        $this->assertEquals(0.00, (float)$order->delivery_fee);
        $this->assertEquals(60000.00, (float)$order->total);
    }

    public function test_order_tracking_finds_order_by_number_or_phone(): void
    {
        $order = Order::create([
            'order_number' => 'INAS-202611-9988',
            'customer_name' => 'Kassim Majaliwa',
            'customer_phone' => '0682 111 222',
            'delivery_city' => 'Dar es Salaam',
            'delivery_area' => 'Upanga',
            'delivery_address' => 'Lugalo Street',
            'delivery_method' => 'pickup',
            'delivery_fee' => 0,
            'subtotal' => 10000,
            'total' => 10000,
            'payment_method' => 'cash_on_delivery',
            'order_status' => 'dispatched',
        ]);

        $response = $this->get('/track-order?query=INAS-202611-9988');
        $response->assertStatus(200);
        $response->assertSee('Kassim Majaliwa');
        $response->assertSee('Dispatched');

        $responseByPhone = $this->get('/track-order?query=0682 111 222');
        $responseByPhone->assertStatus(200);
        $responseByPhone->assertSee('INAS-202611-9988');
    }
}
