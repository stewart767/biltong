<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SiteSetting;
use App\Models\User;
use App\Models\WholesaleEnquiry;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin User
        User::updateOrCreate(
            ['email' => 'admin@inas.co.tz'],
            [
                'name' => 'INAS Administrator',
                'password' => Hash::make('password'),
                'is_admin' => true,
                'phone' => '+255 682 869 629',
                'email_verified_at' => now(),
            ]
        );

        // 2. Site Settings
        $settings = [
            'site_name' => 'INAS Premium Beef Biltong',
            'site_tagline' => 'REAL BEEF. REAL FLAVOUR.',
            'company_name' => 'INAS Company Limited',
            'company_location' => 'Buguruni Malapa, Dar es Salaam, Tanzania',
            'company_phone' => '+255 682 869 629',
            'company_whatsapp' => '255682869629',
            'company_email' => 'sales@inasbiltong.co.tz',
            'announcement_bar' => '🚚 Free Dar es Salaam delivery on orders over TZS 50,000 | Direct WhatsApp Ordering Available',
            'hero_headline' => 'REAL BEEF. REAL FLAVOUR.',
            'hero_subheadline' => 'Handcrafted in Buguruni Malapa from 100% pasture-grazed Tanzanian beef, toasted coriander, cracked black pepper and artisanal natural air drying.',
            'operating_hours' => 'Monday - Saturday: 8:00 AM - 6:30 PM (EAT)',
            'instagram_handle' => '@inas_biltong_tz',
            'currency_code' => 'TZS',
            'dar_delivery_fee' => '5000',
            'upcountry_delivery_fee' => '12000',
            'free_delivery_threshold' => '50000',
        ];

        foreach ($settings as $key => $val) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $val, 'group' => 'general']);
        }

        // 3. Categories
        $catTraditional = Category::updateOrCreate(
            ['slug' => 'traditional-biltong'],
            [
                'name' => 'Traditional Biltong',
                'description' => 'Classic air-dried prime Tanzanian beef cured with roasted coriander, coarse sea salt and cracked pepper.',
                'image' => 'images/biltong-original-1.jpg',
                'sort_order' => 1,
                'is_active' => true,
            ]
        );

        $catSpiced = Category::updateOrCreate(
            ['slug' => 'spiced-and-chilli'],
            [
                'name' => 'Spiced & Chilli Biltong',
                'description' => 'For heat lovers. Infused with sun-dried bird’s eye chillies, cayenne and toasted spices.',
                'image' => 'images/chilli-biltong.jpg',
                'sort_order' => 2,
                'is_active' => true,
            ]
        );

        $catDroewors = Category::updateOrCreate(
            ['slug' => 'droewors-sausage'],
            [
                'name' => 'Droëwors Dried Sausage',
                'description' => 'Authentic spiced dried beef sausage made from prime minced beef, coriander, and cloves.',
                'image' => 'images/droewors.jpg',
                'sort_order' => 3,
                'is_active' => true,
            ]
        );

        $catWholesale = Category::updateOrCreate(
            ['slug' => 'wholesale-and-bulk'],
            [
                'name' => 'Wholesale & Bundles',
                'description' => 'Distribution packs for retail shelves, corporate pantries, safari camps, and fitness centers.',
                'image' => 'images/wholesale-box.jpg',
                'sort_order' => 4,
                'is_active' => true,
            ]
        );

        // 4. Products

        // Product 1: Biltong Original 100g (Main Primary Product)
        $p1 = Product::updateOrCreate(
            ['slug' => 'biltong-original-100g'],
            [
                'category_id' => $catTraditional->id,
                'name' => 'Biltong Original',
                'sku' => 'INAS-BIL-ORIG-100',
                'pack_size' => '100g',
                'price' => 12000.00,
                'promo_price' => 10000.00,
                'short_description' => 'Signature slow-cured Tanzanian pasture beef cured with roasted coriander, sea salt and black peppercorns.',
                'description' => "Our flagship creation. INAS Biltong Original is crafted in Buguruni Malapa, Dar es Salaam, using only the finest grass-fed Tanzanian pasture beef silverside and topside cuts.\n\nEvery batch is trimmed by hand, seasoned with freshly cracked coriander seeds, coarse sea salt, black tellicherry pepper, and traditional cider vinegar marinade, before slow air-curing in our temperature-controlled drying room.\n\nNo artificial preservatives, no liquid smoke, and zero MSG. Just pure, nutrient-dense beef protein packed with authentic, deep savory richness.",
                'weight_options' => [
                    ['weight' => '100g', 'price' => 10000, 'label' => 'Standard Pack (100g)', 'is_default' => true],
                    ['weight' => '250g', 'price' => 24000, 'label' => 'Snack Master Pack (250g)', 'is_default' => false],
                    ['weight' => '500g', 'price' => 46000, 'label' => 'Family & Sharing (500g)', 'is_default' => false],
                    ['weight' => '1kg', 'price' => 88000, 'label' => 'Butcher Bulk (1kg)', 'is_default' => false],
                ],
                'stock' => 150,
                'is_featured' => true,
                'is_active' => true,
                'ingredients' => 'Selected Tanzanian Pasture Beef (220g raw beef per 100g finished biltong), Cider Vinegar, Coarse Sea Salt, Toasted Whole Coriander, Cracked Black Pepper, Brown Cane Sugar, Natural Spices.',
                'nutritional_info' => [
                    'serving_size' => '50g (Half Pack)',
                    'servings_per_container' => '2',
                    'protein_per_100g' => '52.4g',
                    'energy_kcal_per_100g' => '274 kcal',
                    'total_fat_per_100g' => '6.8g',
                    'saturated_fat_per_100g' => '2.9g',
                    'carbohydrates_per_100g' => '1.8g',
                    'sugars_per_100g' => '1.2g',
                    'salt_sodium_per_100g' => '4.2g',
                    'iron' => 'High Natural Bioavailable Iron',
                ],
                'storage_instructions' => 'Store in a cool, dry place away from direct sunlight. Once opened, consume within 4 days or keep in an airtight container or refrigerated.',
                'certifications' => ['100% Halal Certified', '100% Tanzanian Grass-Fed Beef', 'Zero Artificial Nitrites', 'Gluten Free'],
                'badges' => ['Bestseller', 'Signature Blend', '52g Protein / 100g'],
            ]
        );

        ProductImage::updateOrCreate(
            ['product_id' => $p1->id, 'image_path' => 'images/biltong-original-1.jpg'],
            ['is_primary' => true, 'sort_order' => 1, 'alt_text' => 'INAS Biltong Original 100g - Sliced Beef Strips']
        );
        ProductImage::updateOrCreate(
            ['product_id' => $p1->id, 'image_path' => 'images/biltong-original-2.jpg'],
            ['is_primary' => false, 'sort_order' => 2, 'alt_text' => 'INAS Biltong Original - Cured Grain Detail']
        );
        ProductImage::updateOrCreate(
            ['product_id' => $p1->id, 'image_path' => 'images/hero-biltong.jpg'],
            ['is_primary' => false, 'sort_order' => 3, 'alt_text' => 'INAS Biltong Editorial Serving']
        );

        // Product 2: Chilli Biltong Bites
        $p2 = Product::updateOrCreate(
            ['slug' => 'chilli-biltong-bites-100g'],
            [
                'category_id' => $catSpiced->id,
                'name' => 'Chilli Biltong Bites',
                'sku' => 'INAS-BIL-CHIL-100',
                'pack_size' => '100g',
                'price' => 13000.00,
                'promo_price' => 11000.00,
                'short_description' => 'Sun-dried bird’s eye chili flakes and toasted cumin blended with our tender cured Tanzanian beef.',
                'description' => "For those who like a warm, lingering kick. Our Chilli Biltong Bites combine prime cured Tanzanian beef slices with crushed African bird's eye chilies, cayenne, and whole roasted coriander seeds. It begins with the rich savory beef sweetness followed by an intoxicating, warm spiced warmth that keeps you reaching for the bag.",
                'weight_options' => [
                    ['weight' => '100g', 'price' => 11000, 'label' => 'Standard Pack (100g)', 'is_default' => true],
                    ['weight' => '250g', 'price' => 26000, 'label' => 'Snack Master (250g)', 'is_default' => false],
                    ['weight' => '500g', 'price' => 49000, 'label' => 'Bulk Fire Pack (500g)', 'is_default' => false],
                ],
                'stock' => 95,
                'is_featured' => true,
                'is_active' => true,
                'ingredients' => 'Tanzanian Beef, Cider Vinegar, Sea Salt, Crushed African Birds Eye Chili, Cayenne Pepper, Coriander, Black Pepper, Brown Sugar.',
                'nutritional_info' => [
                    'serving_size' => '50g',
                    'protein_per_100g' => '51.8g',
                    'energy_kcal_per_100g' => '278 kcal',
                    'total_fat_per_100g' => '7.1g',
                    'saturated_fat_per_100g' => '3.0g',
                    'carbohydrates_per_100g' => '2.1g',
                    'salt_sodium_per_100g' => '4.3g',
                ],
                'storage_instructions' => 'Keep in a cool dry place. Seal tightly after opening.',
                'certifications' => ['100% Halal', 'Grass-Fed Pasture Beef', 'No Nitrates'],
                'badges' => ['Spicy Kick', 'High Protein'],
            ]
        );

        ProductImage::updateOrCreate(
            ['product_id' => $p2->id, 'image_path' => 'images/chilli-biltong.jpg'],
            ['is_primary' => true, 'sort_order' => 1, 'alt_text' => 'Chilli Biltong Bites 100g']
        );

        // Product 3: Traditional Droëwors
        $p3 = Product::updateOrCreate(
            ['slug' => 'traditional-droewors-100g'],
            [
                'category_id' => $catDroewors->id,
                'name' => 'Traditional Droëwors',
                'sku' => 'INAS-DRO-TRAD-100',
                'pack_size' => '100g',
                'price' => 14000.00,
                'promo_price' => 12500.00,
                'short_description' => 'Authentic spiced dried beef sausage crafted in natural lamb casing with hints of coriander, nutmeg and cloves.',
                'description' => "Our Droëwors is prepared following time-honored butcher traditions. Prime cuts of Tanzanian beef are coarsely ground, seasoned with whole toasted coriander, aromatic nutmeg, and ground clove, stuffed into thin natural casings, and gently dried to snap-perfection.",
                'weight_options' => [
                    ['weight' => '100g', 'price' => 12500, 'label' => 'Standard Pack (100g)', 'is_default' => true],
                    ['weight' => '250g', 'price' => 29000, 'label' => 'Snap Pack (250g)', 'is_default' => false],
                    ['weight' => '500g', 'price' => 55000, 'label' => 'Butcher Bundle (500g)', 'is_default' => false],
                ],
                'stock' => 70,
                'is_featured' => true,
                'is_active' => true,
                'ingredients' => 'Prime Ground Beef (85%), Natural Spices (Coriander, Cloves, Nutmeg), Sea Salt, Vinegar, Natural Casing.',
                'nutritional_info' => [
                    'protein_per_100g' => '44.0g',
                    'energy_kcal_per_100g' => '360 kcal',
                    'total_fat_per_100g' => '20.2g',
                    'carbohydrates_per_100g' => '1.0g',
                    'salt_sodium_per_100g' => '3.8g',
                ],
                'storage_instructions' => 'Cool, dry location. Reseal after opening.',
                'certifications' => ['100% Halal', 'Natural Casing', 'Zero Fillers'],
                'badges' => ['Butcher Favorite', 'Authentic Snap'],
            ]
        );

        ProductImage::updateOrCreate(
            ['product_id' => $p3->id, 'image_path' => 'images/droewors.jpg'],
            ['is_primary' => true, 'sort_order' => 1, 'alt_text' => 'Traditional Droëwors Dried Beef Sausage']
        );

        // Product 4: Carver’s Biltong Whole Slab
        $p4 = Product::updateOrCreate(
            ['slug' => 'carvers-biltong-whole-slab-250g'],
            [
                'category_id' => $catTraditional->id,
                'name' => 'Carver’s Biltong Whole Slab',
                'sku' => 'INAS-BIL-SLAB-250',
                'pack_size' => '250g',
                'price' => 28000.00,
                'promo_price' => 25000.00,
                'short_description' => 'Whole uncut biltong slab. Slice it at home to your preferred thickness with your kitchen knife.',
                'description' => "For the true connoisseur. An intact uncut biltong slab allowing you to slice thick chunks or razor-thin ribbons with fresh aromatics released on each cut.",
                'weight_options' => [
                    ['weight' => '250g', 'price' => 25000, 'label' => 'Quarter Kilo Slab', 'is_default' => true],
                    ['weight' => '500g', 'price' => 48000, 'label' => 'Half Kilo Slab', 'is_default' => false],
                    ['weight' => '1kg', 'price' => 90000, 'label' => 'Master Carver 1kg Slab', 'is_default' => false],
                ],
                'stock' => 40,
                'is_featured' => false,
                'is_active' => true,
                'ingredients' => 'Tanzanian Beef Silverside, Cider Vinegar, Sea Salt, Roasted Coriander, Coarse Black Pepper, Brown Sugar.',
                'nutritional_info' => [
                    'protein_per_100g' => '53.0g',
                    'energy_kcal_per_100g' => '270 kcal',
                    'total_fat_per_100g' => '6.5g',
                    'carbohydrates_per_100g' => '1.5g',
                ],
                'storage_instructions' => 'Keep in a cool dry space. Slice fresh as needed.',
                'certifications' => ['100% Halal', 'Uncut Artisan'],
                'badges' => ['Chef’s Selection'],
            ]
        );

        ProductImage::updateOrCreate(
            ['product_id' => $p4->id, 'image_path' => 'images/carvers-slab.jpg'],
            ['is_primary' => true, 'sort_order' => 1, 'alt_text' => 'Carver’s Biltong Whole Slab']
        );

        // Product 5: Wholesale Starter Carton (10x 100g)
        $p5 = Product::updateOrCreate(
            ['slug' => 'wholesale-starter-carton-10x-100g'],
            [
                'category_id' => $catWholesale->id,
                'name' => 'Wholesale Starter Carton (10x 100g Packs)',
                'sku' => 'INAS-WHOLE-10PK',
                'pack_size' => '1kg (10 x 100g)',
                'price' => 95000.00,
                'promo_price' => 85000.00,
                'short_description' => 'Retail-ready display case containing 10x 100g sealed pouches. Ideal for shops, cafes, lodges and gyms.',
                'description' => "Our wholesale tasting box for retailers, luxury safari lodges, hotel minibars, and fitness hubs. Delivered in branded shelf-ready presentation sleeves.",
                'weight_options' => [
                    ['weight' => '10x 100g', 'price' => 85000, 'label' => '10 Packs (Original)', 'is_default' => true],
                    ['weight' => '20x 100g', 'price' => 160000, 'label' => '20 Packs Mixed Carton', 'is_default' => false],
                ],
                'stock' => 50,
                'is_featured' => true,
                'is_active' => true,
                'ingredients' => 'See individual product listings for Biltong Original 100g.',
                'nutritional_info' => [
                    'note' => 'Retail packaged with barcode, nutritional panel and expiry information.',
                ],
                'storage_instructions' => 'Store shelf displays in temperature-controlled retail environments away from direct sunlight.',
                'certifications' => ['TBS Standards Compliant', 'Halal Certified', 'Retail Barcoded'],
                'badges' => ['Wholesale', 'Best Margin'],
            ]
        );

        ProductImage::updateOrCreate(
            ['product_id' => $p5->id, 'image_path' => 'images/wholesale-box.jpg'],
            ['is_primary' => true, 'sort_order' => 1, 'alt_text' => 'Wholesale Starter Carton 10x 100g']
        );

        // 5. Realistic Sample Orders
        $order1 = Order::updateOrCreate(
            ['order_number' => 'INAS-202611-01'],
            [
                'customer_name' => 'Juma Rashidi',
                'customer_email' => 'juma.rashidi@gmail.com',
                'customer_phone' => '+255 754 112 233',
                'delivery_city' => 'Dar es Salaam',
                'delivery_area' => 'Masaki (Peninsula)',
                'delivery_address' => 'Plot 412, Chole Road, Masaki',
                'delivery_method' => 'Dar es Salaam Express',
                'delivery_fee' => 5000.00,
                'subtotal' => 30000.00,
                'total' => 35000.00,
                'payment_method' => 'mpesa',
                'payment_status' => 'paid',
                'payment_reference' => 'QW7899120',
                'order_status' => 'dispatched',
                'notes' => 'Please deliver before 5 PM at reception.',
                'ordered_via_whatsapp' => false,
            ]
        );

        OrderItem::updateOrCreate(
            ['order_id' => $order1->id, 'product_id' => $p1->id],
            [
                'product_name' => 'Biltong Original',
                'pack_size' => '100g',
                'unit_price' => 10000.00,
                'quantity' => 2,
                'subtotal' => 20000.00,
            ]
        );
        OrderItem::updateOrCreate(
            ['order_id' => $order1->id, 'product_id' => $p2->id],
            [
                'product_name' => 'Chilli Biltong Bites',
                'pack_size' => '100g',
                'unit_price' => 11000.00,
                'quantity' => 1,
                'subtotal' => 10000.00,
            ]
        );

        $order2 = Order::updateOrCreate(
            ['order_number' => 'INAS-202611-02'],
            [
                'customer_name' => 'Sarah Mwangi',
                'customer_email' => 'sarah.mwangi@outlook.com',
                'customer_phone' => '+255 684 990 011',
                'delivery_city' => 'Dar es Salaam',
                'delivery_area' => 'Mikocheni B',
                'delivery_address' => 'House 14, Old Bagamoyo Road',
                'delivery_method' => 'Dar es Salaam Express',
                'delivery_fee' => 0.00, // free over 50,000
                'subtotal' => 85000.00,
                'total' => 85000.00,
                'payment_method' => 'tigopesa',
                'payment_status' => 'paid',
                'payment_reference' => 'TP4412093',
                'order_status' => 'confirmed',
                'notes' => 'WhatsApp confirmation sent.',
                'ordered_via_whatsapp' => true,
            ]
        );

        OrderItem::updateOrCreate(
            ['order_id' => $order2->id, 'product_id' => $p5->id],
            [
                'product_name' => 'Wholesale Starter Carton (10x 100g Packs)',
                'pack_size' => '10x 100g',
                'unit_price' => 85000.00,
                'quantity' => 1,
                'subtotal' => 85000.00,
            ]
        );

        // 6. Sample Wholesale Inquiries
        WholesaleEnquiry::updateOrCreate(
            ['email' => 'purchasing@serengeti-safaris.co.tz'],
            [
                'business_name' => 'Serengeti Safari Lodges & Camps',
                'contact_person' => 'David Mollel',
                'phone' => '+255 788 440 221',
                'business_type' => 'Hotel & Lodge',
                'estimated_quantity' => '100kg - 250kg monthly',
                'delivery_location' => 'Arusha & Dar es Salaam dispatch hubs',
                'message' => 'We operate 4 luxury tented camps in Serengeti and Tarangire. Looking for high quality 100g biltong packs for guest game drives and minibar setups. Please share wholesale tier pricing and sample delivery timeline.',
                'status' => 'negotiating',
                'admin_notes' => 'Tasting samples sent via courier to Arusha office on Nov 20.',
            ]
        );

        WholesaleEnquiry::updateOrCreate(
            ['email' => 'management@fitzone-gym.tz'],
            [
                'business_name' => 'FitZone Gym & Fitness Centre',
                'contact_person' => 'Amina Hassan',
                'phone' => '+255 655 778 899',
                'business_type' => 'Gym & Sports Club',
                'estimated_quantity' => '50kg monthly',
                'delivery_location' => 'Oysterbay Branch, Dar es Salaam',
                'message' => 'We want to stock high-protein beef biltong at our fitness smoothie bar. 52g protein claim is perfect for our members.',
                'status' => 'contacted',
                'admin_notes' => 'Discussed initial trial carton of 20 packs.',
            ]
        );
    }
}
