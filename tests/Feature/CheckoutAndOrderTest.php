<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Services\CartService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutAndOrderTest extends TestCase
{
    use RefreshDatabase;

    protected Product $product;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::create([
            'name' => 'Said Mwita',
            'email' => 'said@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $category = Category::create([
            'name' => 'Original Beef Biltong',
            'slug' => 'original-beef-biltong',
            'is_active' => true,
        ]);

        $this->product = Product::create([
            'category_id' => $category->id,
            'name' => 'COY Original Beef Biltong',
            'slug' => 'coy-original-beef-biltong',
            'pack_size' => '100g',
            'price' => 12000.00,
            'promo_price' => 10000.00,
            'stock' => 100,
            'is_active' => true,
        ]);
    }

    public function test_cart_and_checkout_pages_render(): void
    {
        $this->actingAs($this->user);
        app(CartService::class)->addItem($this->product->id, null, '100g', 1);

        $this->get('/cart')->assertStatus(200)->assertSee('Shopping Bag');
        $this->get('/checkout')->assertStatus(200)->assertSee('Checkout');
    }

    public function test_order_can_be_placed_successfully(): void
    {
        $this->actingAs($this->user);
        app(CartService::class)->addItem($this->product->id, null, '100g', 2);

        $response = $this->post('/checkout', [
            'customer_name' => 'Said Mwita',
            'customer_phone' => '0754 990 011',
            'customer_email' => 'said@gmail.com',
            'delivery_address' => 'Plot 45, Oysterbay Peninsula',
            'delivery_city' => 'Dar es Salaam',
            'delivery_area' => 'Oysterbay',
            'delivery_method' => 'dar_express',
            'payment_method' => 'mpesa',
            'notes' => 'Please call on arrival.',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('orders', [
            'customer_name' => 'Said Mwita',
            'customer_phone' => '0754 990 011',
            'payment_method' => 'mpesa',
        ]);
    }
}
