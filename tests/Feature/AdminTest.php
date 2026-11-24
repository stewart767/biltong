<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\WholesaleEnquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    protected User $adminUser;
    protected User $regularUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->adminUser = User::create([
            'name' => 'INAS Administrator',
            'email' => 'admin@inas.co.tz',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        $this->regularUser = User::create([
            'name' => 'Customer User',
            'email' => 'customer@example.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);
    }

    public function test_guest_cannot_access_admin_dashboard(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/admin/login');
    }

    public function test_regular_user_cannot_access_admin_dashboard(): void
    {
        $response = $this->actingAs($this->regularUser)->get('/admin');
        $response->assertRedirect('/admin/login');
    }

    public function test_admin_can_login_via_auth_form(): void
    {
        $response = $this->post('/admin/login', [
            'email' => 'admin@inas.co.tz',
            'password' => 'password',
        ]);

        $response->assertRedirect();
        $this->assertAuthenticatedAs($this->adminUser);
    }

    public function test_admin_can_view_dashboard_metrics(): void
    {
        $response = $this->actingAs($this->adminUser)->get('/admin');

        $response->assertStatus(200);
        $response->assertSee('Operations Dashboard');
        $response->assertSee('Catalogue Cuts');
        $response->assertSee('Recent Storefront Orders');
    }

    public function test_admin_can_manage_products(): void
    {
        $category = Category::create([
            'name' => 'Droëwors',
            'slug' => 'droewors',
            'is_active' => true,
        ]);

        $response = $this->actingAs($this->adminUser)->post('/admin/products', [
            'category_id' => $category->id,
            'name' => 'Spiced Droëwors Snaps',
            'pack_size' => '100g',
            'price' => 14000,
            'stock' => 80,
            'short_description' => 'Snap-tender beef sausage.',
            'protein' => '44g',
            'is_active' => 1,
        ]);

        $response->assertRedirect(route('admin.products.index'));
        $this->assertDatabaseHas('products', [
            'name' => 'Spiced Droëwors Snaps',
            'pack_size' => '100g',
        ]);
    }

    public function test_admin_can_update_order_status(): void
    {
        $order = Order::create([
            'order_number' => 'INAS-TEST-001',
            'customer_name' => 'Ally Juma',
            'customer_phone' => '0711 000 111',
            'delivery_city' => 'Dar es Salaam',
            'delivery_area' => 'Sinza',
            'delivery_address' => 'Mori',
            'delivery_method' => 'dar_express',
            'delivery_fee' => 5000,
            'subtotal' => 10000,
            'total' => 15000,
            'payment_method' => 'mpesa',
            'payment_status' => 'pending',
            'order_status' => 'pending',
        ]);

        $response = $this->actingAs($this->adminUser)->post("/admin/orders/{$order->id}/status", [
            'order_status' => 'delivered',
            'payment_status' => 'paid',
        ]);

        $response->assertSessionHas('success');
        $order->refresh();
        $this->assertEquals('delivered', $order->order_status);
        $this->assertEquals('paid', $order->payment_status);
    }

    public function test_admin_can_update_settings(): void
    {
        $response = $this->actingAs($this->adminUser)->post('/admin/settings', [
            'hero_headline' => 'REAL BEEF. REAL FLAVOUR. REAL TANZANIA.',
            'company_phone' => '+255 682 869 629',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('site_settings', [
            'key' => 'hero_headline',
            'value' => 'REAL BEEF. REAL FLAVOUR. REAL TANZANIA.',
        ]);
    }
}
