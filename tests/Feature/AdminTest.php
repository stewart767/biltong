<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\NewsletterSubscriber;
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
            'name' => 'COY Administrator',
            'email' => 'admin@coybiltong.co.tz',
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
            'email' => 'admin@coybiltong.co.tz',
            'password' => 'password',
        ]);

        $response->assertRedirect('/admin');
        $this->assertAuthenticatedAs($this->adminUser);
    }

    public function test_admin_dashboard_shows_kpis(): void
    {
        $response = $this->actingAs($this->adminUser)->get('/admin');

        $response->assertStatus(200);
        $response->assertSee('COY BILTONG Operations');
        $response->assertSee('Total Sales');
        $response->assertSee('Total Orders');
    }

    public function test_admin_can_view_orders_and_update_status(): void
    {
        $order = Order::create([
            'order_number' => 'COY-998877',
            'customer_name' => 'John Doe',
            'customer_phone' => '0712345678',
            'customer_email' => 'john@test.com',
            'delivery_address' => 'Masaki, Dar',
            'delivery_area' => 'Dar Urban',
            'payment_method' => 'mpesa',
            'status' => 'pending',
            'subtotal' => 25000,
            'delivery_fee' => 3000,
            'total' => 28000,
        ]);

        $response = $this->actingAs($this->adminUser)->get('/admin/orders');
        $response->assertStatus(200);
        $response->assertSee('COY-998877');

        $updateResponse = $this->actingAs($this->adminUser)->post("/admin/orders/{$order->id}/status", [
            'order_status' => 'processing',
            'payment_status' => 'paid',
        ]);

        $updateResponse->assertRedirect();
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'order_status' => 'processing',
        ]);
    }
}
