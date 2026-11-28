<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Banner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BiltongStorefrontTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $category = Category::create([
            'name' => 'Original Beef Biltong',
            'slug' => 'original-beef-biltong',
            'is_active' => true,
        ]);

        Product::create([
            'category_id' => $category->id,
            'name' => 'COY Original Beef Biltong',
            'slug' => 'coy-original-beef-biltong',
            'sku' => 'COY-BIL-ORIG-100',
            'pack_size' => '100g',
            'price' => 12000.00,
            'promo_price' => 10000.00,
            'short_description' => 'Tender grass-fed beef slices seasoned with roasted coriander and coarse black pepper.',
            'description' => 'Slow air-dried according to heritage traditions.',
            'stock' => 100,
            'is_featured' => true,
            'is_active' => true,
            'weight_options' => [
                ['weight' => '100g', 'price' => 10000, 'is_default' => true],
            ],
            'nutritional_info' => [
                'protein_per_100g' => '54.2g',
                'energy_kcal_per_100g' => '270 kcal',
            ],
        ]);
    }

    public function test_homepage_loads_successfully_with_hero_headline(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Burger');
        $response->assertSee('House');
        $response->assertSee('Delicious Burgers');
    }

    public function test_shop_catalogue_loads_and_displays_products(): void
    {
        $response = $this->get('/shop');

        $response->assertStatus(200);
        $response->assertSee('COY Original Beef Biltong');
        $response->assertSee('Original Beef Biltong');
    }

    public function test_product_detail_page_loads_with_nutritional_panel(): void
    {
        $response = $this->get('/product/coy-original-beef-biltong');

        $response->assertStatus(200);
        $response->assertSee('COY Original Beef Biltong');
        $response->assertSee('54.2g');
        $response->assertSee('WhatsApp');
    }

    public function test_dedicated_navigation_pages_load_successfully(): void
    {
        $this->get('/menu')->assertStatus(200)->assertSee('Menu');
        $this->get('/about-us')->assertStatus(200)->assertSee('About');
        $this->get('/order')->assertStatus(200)->assertSee('Order');
    }

    public function test_narrative_pages_load_successfully(): void
    {
        $this->get('/about')->assertStatus(200)->assertSee('Our Story');
        $this->get('/craft')->assertStatus(200)->assertSee('Quality & Process');
        $this->get('/contact')->assertStatus(200)->assertSee('Contact Us');
    }

    public function test_contact_form_submits_successfully(): void
    {
        $response = $this->post('/contact', [
            'name' => 'Baraka Juma',
            'phone' => '+255 754 112 233',
            'email' => 'baraka@gmail.com',
            'subject' => 'General Inquiry',
            'message' => 'Hello, I want to inquire about bulk ordering COY biltong.',
        ]);

        $response->assertRedirect('/contact');
        $response->assertSessionHas('contact_success');
    }

    public function test_newsletter_subscribes(): void
    {
        $response = $this->post('/newsletter', [
            'email' => 'client@coybiltong.co.tz',
        ]);

        $response->assertSessionHas('success');
    }
}
