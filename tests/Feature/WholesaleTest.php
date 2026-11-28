<?php

namespace Tests\Feature;

use App\Models\WholesaleEnquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WholesaleTest extends TestCase
{
    use RefreshDatabase;

    public function test_wholesale_page_loads_and_displays_form(): void
    {
        $response = $this->get('/wholesale');

        $response->assertStatus(200);
        $response->assertSee('COY BILTONG');
        $response->assertSee('Supermarkets');
        $response->assertSee('Safari Lodges');
    }

    public function test_wholesale_enquiry_form_submits_and_creates_lead(): void
    {
        $response = $this->post('/wholesale', [
            'business_name' => 'Ngorongoro Crater Lodge',
            'contact_person' => 'Michael Kimaro',
            'phone' => '+255 754 889 900',
            'email' => 'purchasing@ngorongorolodge.tz',
            'business_type' => 'Safari Lodge / Tented Camp',
            'estimated_quantity' => '100kg - 250kg monthly',
            'delivery_location' => 'Arusha & Karatu Hubs',
            'message' => 'We need 100g original packs and chilli bites for 50 guest tents.',
        ]);

        $response->assertRedirect('/wholesale');
        $response->assertSessionHas('wholesale_success');

        $this->assertDatabaseHas('wholesale_enquiries', [
            'business_name' => 'Ngorongoro Crater Lodge',
            'contact_person' => 'Michael Kimaro',
            'status' => 'new',
        ]);
    }
}
