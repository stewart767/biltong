<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BiltongStorefrontTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        SiteSetting::create([
            'key' => 'hero_headline',
            'value' => 'REAL BEEF. REAL FLAVOUR.',
            'group' => 'general'
        ]);

        $category = Category::create([
            'name' => 'Traditional Biltong',
            'slug' => 'traditional-biltong',
            'is_active' => true,
        ]);

        Product::create([
            'category_id' => $category->id,
            'name' => 'Biltong Original',
            'slug' => 'biltong-original-100g',
            'sku' => 'INAS-BIL-ORIG-100',
            'pack_size' => '100g',
            'price' => 12000.00,
            'promo_price' => 10000.00,
            'short_description' => 'Signature slow-cured Tanzanian pasture beef.',
            'description' => 'Handcrafted biltong from Buguruni Malapa.',
            'stock' => 100,
            'is_featured' => true,
            'is_active' => true,
            'weight_options' => [
                ['weight' => '100g', 'price' => 10000, 'is_default' => true],
            ],
            'nutritional_info' => [
                'protein_per_100g' => '52.4g',
                'energy_kcal_per_100g' => '274 kcal',
            ],
        ]);
    }

    public function test_homepage_loads_successfully_with_hero_headline(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('REAL BEEF.');
        $response->assertSee('REAL FLAVOUR.');
        $response->assertSee('Buguruni Malapa');
        $response->assertSee('Biltong Original');
    }

    public function test_shop_catalogue_loads_and_displays_products(): void
    {
        $response = $this->get('/shop');

        $response->assertStatus(200);
        $response->assertSee('Biltong Original');
        $response->assertSee('Traditional Biltong');
    }

    public function test_product_detail_page_loads_with_nutritional_panel(): void
    {
        $response = $this->get('/product/biltong-original-100g');

        $response->assertStatus(200);
        $response->assertSee('Biltong Original');
        $response->assertSee('52.4g');
        $response->assertSee('WhatsApp');
    }

    public function test_narrative_pages_load_successfully(): void
    {
        $this->get('/about')->assertStatus(200)->assertSee('The Story Behind INAS');
        $this->get('/craft')->assertStatus(200)->assertSee('The Air-Curing Craft');
        $this->get('/contact')->assertStatus(200)->assertSee('Buguruni Malapa');
    }

    public function test_contact_form_submits_successfully(): void
    {
        $response = $this->post('/contact', [
            'name' => 'Baraka Juma',
            'phone' => '+255 754 112 233',
            'email' => 'baraka@gmail.com',
            'subject' => 'General Inquiry',
            'message' => 'Hello, I want to inquire about bulk ordering.',
        ]);

        $response->assertRedirect('/contact');
        $response->assertSessionHas('contact_success');
    }

    public function test_newsletter_subscribes(): void
    {
        $response = $this->post('/newsletter', [
            'email' => 'client@dar.tz',
        ]);

        $response->assertSessionHas('success');
    }

    public function test_language_switch_route_updates_session_and_cookie(): void
    {
        $response = $this->get('/locale/sw');

        $response->assertSessionHas('locale', 'sw');
        $response->assertCookie('inas_locale', 'sw');
    }

    public function test_first_visit_language_modal_and_switchers_render_in_layout(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Chagua Lugha Yako');
        $response->assertSee('Choose Your Language');
        $response->assertSee('Kiswahili');
        $response->assertSee('English');
    }

    public function test_homepage_renders_in_swahili_when_sw_session_active(): void
    {
        $response = $this->withSession(['locale' => 'sw'])->get('/');

        $response->assertStatus(200);
        $response->assertSee('NYAMA HALISI.');
        $response->assertSee('LADHA HALISI.');
        $response->assertSee('Duka la Biltong');
    }
}
