<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\CustomerProfile;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use App\Models\User;
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
        // 1. Admin Users & Demo Customers
        $admin = User::updateOrCreate(
            ['email' => 'admin@burgerhouse.com'],
            [
                'name' => 'Burger House Administrator',
                'password' => Hash::make('password'),
                'is_admin' => true,
                'phone' => '+255 768 123 456',
                'email_verified_at' => now(),
            ]
        );

        $adminCoy = User::updateOrCreate(
            ['email' => 'admin@coybiltong.co.tz'],
            [
                'name' => 'Burger House Admin (Legacy)',
                'password' => Hash::make('password'),
                'is_admin' => true,
                'phone' => '+255 768 123 456',
                'email_verified_at' => now(),
            ]
        );

        $customer = User::updateOrCreate(
            ['email' => 'customer@coybiltong.co.tz'],
            [
                'name' => 'Neema Mushi',
                'password' => Hash::make('password'),
                'is_admin' => false,
                'phone' => '+255 754 987 654',
                'email_verified_at' => now(),
            ]
        );

        CustomerProfile::updateOrCreate(
            ['user_id' => $customer->id],
            [
                'phone' => '+255 754 987 654',
                'company' => 'Oysterbay Tech Ventures',
                'preferred_payment_method' => 'mpesa',
                'notes' => 'Prefers vacuum-sealed 250g packs for weekly office snacking.',
            ]
        );

        Address::updateOrCreate(
            ['user_id' => $customer->id, 'label' => 'Office'],
            [
                'recipient_name' => 'Neema Mushi',
                'phone' => '+255 754 987 654',
                'city' => 'Dar es Salaam',
                'area' => 'Masaki / Oysterbay',
                'address_line' => 'Plot 42 Chole Road, Floor 3',
                'delivery_instructions' => 'Drop at reception with Neema Mushi.',
                'is_default' => true,
            ]
        );

        // 2. Site Settings
        $settings = [
            'site_name' => 'COY BILTONG',
            'site_tagline' => 'REAL MEAT. REAL TASTE.',
            'company_name' => 'COY BILTONG LIMITED',
            'company_location' => 'Dar es Salaam, Tanzania',
            'company_phone' => '+255 768 123 456',
            'company_whatsapp' => '255768123456',
            'company_email' => 'info@coybiltong.co.tz',
            'announcement_bar' => '🥩 FREE Dar es Salaam delivery on orders over TZS 50,000 | Direct WhatsApp Ordering Available',
            'hero_headline' => 'REAL MEAT. REAL TASTE.',
            'hero_subheadline' => 'Discover the rich taste of premium beef biltong. Carefully prepared for those who appreciate quality, flavour and convenience.',
            'operating_hours' => 'Monday - Saturday: 8:00 AM - 7:00 PM (EAT)',
            'instagram_url' => 'https://instagram.com/coybiltong',
            'facebook_url' => 'https://facebook.com/coybiltong',
            'currency_code' => 'TZS',
            'dar_delivery_fee' => '5000',
            'upcountry_delivery_fee' => '12000',
            'free_delivery_threshold' => '50000',
            'mpesa_till_number' => '5821940',
            'airtel_pay_number' => '7192301',
            'bank_account_name' => 'COY BILTONG LTD',
            'bank_name' => 'CRDB Bank Tanzania',
            'bank_account_number' => '0150493821000',
        ];

        foreach ($settings as $key => $val) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $val, 'group' => 'general']);
        }

        // 3. Product Categories
        $categoriesData = [
            [
                'name' => 'Gourmet Burgers',
                'slug' => 'gourmet-burgers',
                'description' => 'Fresh prime beef gourmet burgers crafted daily with melted cheese, crisp greens, and toasted brioche buns.',
                'image' => 'images/burger-house/special-burger.jpg',
                'sort_order' => 1,
            ],
            [
                'name' => 'Hot Deals & Combos',
                'slug' => 'hot-deals-combos',
                'description' => 'Value combo packs featuring burgers, crispy fries, and ice-cold soft drinks.',
                'image' => 'images/burger-house/hot-deals-combo.jpg',
                'sort_order' => 2,
            ],
            [
                'name' => 'Crispy Chicken',
                'slug' => 'crispy-chicken',
                'description' => 'Golden crunchy fried chicken patties with fresh avocado and artisan chipotle sauces.',
                'image' => 'images/burger-house/chicken-avocado.jpg',
                'sort_order' => 3,
            ],
            [
                'name' => 'Sides & Fries',
                'slug' => 'sides-fries',
                'description' => 'Double-fried golden russet fries, crunchy sides, and refreshing cold drinks.',
                'image' => 'images/burger-house/hero-burger.jpg',
                'sort_order' => 4,
            ],
            [
                'name' => 'Original Beef Biltong',
                'slug' => 'original-beef-biltong',
                'description' => 'The timeless classic. Pure pasture-fed beef cured with roasted coriander seed, cracked black pepper and artisanal sea salt.',
                'image' => 'images/biltong-original-1.jpg',
                'sort_order' => 5,
            ],
            [
                'name' => 'Chilli Beef Biltong',
                'slug' => 'chilli-beef-biltong',
                'description' => 'A fiery kick for heat lovers. Infused with sun-ripened African bird’s eye chillies and crushed cayenne.',
                'image' => 'images/chilli-biltong.jpg',
                'sort_order' => 2,
            ],
            [
                'name' => 'Spicy Beef Biltong',
                'slug' => 'spicy-beef-biltong',
                'description' => 'Warm, aromatic spices blended with clove, pimento and smoked paprika for deep, complex savouriness.',
                'image' => 'images/craft-spices.jpg',
                'sort_order' => 3,
            ],
            [
                'name' => 'Premium Beef Biltong',
                'slug' => 'premium-beef-biltong',
                'description' => 'Hand-trimmed prime sirloin cut for exceptional tenderness, rich marbling and melt-in-the-mouth texture.',
                'image' => 'images/carvers-slab.jpg',
                'sort_order' => 4,
            ],
            [
                'name' => 'Family Packs',
                'slug' => 'family-packs',
                'description' => 'Generous pantry bundles and multi-portion packs ideal for family sharing, weekend braais and gatherings.',
                'image' => 'images/wholesale-box.jpg',
                'sort_order' => 5,
            ],
            [
                'name' => 'Mixed Packs',
                'slug' => 'mixed-packs',
                'description' => 'Curated tasting selections combining Original, Chilli and Spicy cuts in convenient grab-and-go sizes.',
                'image' => 'images/hero-biltong.jpg',
                'sort_order' => 6,
            ],
        ];

        $categories = [];
        foreach ($categoriesData as $cData) {
            $categories[$cData['slug']] = Category::updateOrCreate(
                ['slug' => $cData['slug']],
                array_merge($cData, ['is_active' => true])
            );
        }

        // 4. Products with Variants and Images
        $productsData = [
            [
                'category_slug' => 'gourmet-burgers',
                'name' => 'Burger House Special',
                'slug' => 'burger-house-special',
                'sku' => 'BH-SPEC-001',
                'pack_size' => 'Single Patty',
                'price' => 22000,
                'promo_price' => 20000,
                'short_description' => 'Beef patty, American cheese, lettuce, tomato, onion, pickles, mustard, mayo, ketchup.',
                'description' => "Our flagship handcrafted gourmet burger made with prime seasoned beef, melted American cheese, crisp lettuce, ripe tomatoes, sliced pickles, and signature house sauce on a toasted brioche bun.\n\nServed fresh with love from the Burger House kitchen.",
                'weight_options' => ['Single', 'Double Patty (+Tshs 5,000)'],
                'stock' => 150,
                'is_featured' => true,
                'is_active' => true,
                'ingredients' => '100% Prime Beef Patty, Brioche Bun, American Cheese, Fresh Lettuce, Tomato, Red Onion, Dill Pickles, House Burger Sauce.',
                'nutritional_info' => [
                    'serving_size' => '1 Burger',
                    'protein' => '34g',
                    'fat' => '22g',
                    'carbs' => '42g',
                    'calories' => '540 kcal',
                ],
                'storage_instructions' => 'Enjoy hot and freshly prepared immediately upon delivery.',
                'certifications' => ['100% Fresh Halal Beef', 'Handcrafted Daily'],
                'badges' => ['Most Popular'],
                'images' => [
                    'images/burger-house/special-burger.jpg',
                    'images/burger-house/hero-burger.jpg',
                ],
                'variants' => [
                    ['weight' => 'Single Patty', 'price' => 22000, 'promo_price' => 20000, 'stock' => 100, 'is_default' => true],
                    ['weight' => 'Double Patty', 'price' => 27000, 'promo_price' => 25000, 'stock' => 50, 'is_default' => false],
                ],
            ],
            [
                'category_slug' => 'gourmet-burgers',
                'name' => 'Double Cheese Burger',
                'slug' => 'double-cheese-burger',
                'sku' => 'BH-DBL-002',
                'pack_size' => 'Double Patty',
                'price' => 26000,
                'promo_price' => 24000,
                'short_description' => 'Angus beef, American cheese, bacon, grilled onions, special sauce.',
                'description' => "Two succulent Angus beef patties smashed to perfection, stacked with double American cheese, smoky bacon strips, and caramelized grilled onions.\n\nA heavy-hitting flavor sensation for true cheese lovers.",
                'weight_options' => ['Double', 'Triple Patty (+Tshs 6,000)'],
                'stock' => 120,
                'is_featured' => true,
                'is_active' => true,
                'ingredients' => 'Double Angus Beef Patties, Brioche Bun, Double American Cheese, Crisp Bacon, Caramelized Onions, House Secret Sauce.',
                'nutritional_info' => [
                    'serving_size' => '1 Burger',
                    'protein' => '48g',
                    'fat' => '32g',
                    'carbs' => '44g',
                    'calories' => '680 kcal',
                ],
                'storage_instructions' => 'Enjoy hot and freshly prepared immediately.',
                'certifications' => ['100% Halal Beef', 'Chef Recommendation'],
                'badges' => ['Hot Deals'],
                'images' => [
                    'images/burger-house/double-cheese.jpg',
                ],
                'variants' => [
                    ['weight' => 'Double Patty', 'price' => 26000, 'promo_price' => 24000, 'stock' => 80, 'is_default' => true],
                    ['weight' => 'Triple Patty', 'price' => 32000, 'promo_price' => 30000, 'stock' => 40, 'is_default' => false],
                ],
            ],
            [
                'category_slug' => 'gourmet-burgers',
                'name' => 'BBQ Bacon Burger',
                'slug' => 'bbq-bacon-burger',
                'sku' => 'BH-BBQ-003',
                'pack_size' => 'Special Cut',
                'price' => 26000,
                'promo_price' => 24000,
                'short_description' => 'Angus beef, bacon, American cheese, barbecue sauce, grilled onions.',
                'description' => "Juicy prime Angus beef smothered in rich smoky honey-hickory barbecue sauce, crisp smoked beef bacon, and molten cheddar on a buttered toasted bun.",
                'weight_options' => ['Regular', 'With Extra Bacon (+Tshs 3,000)'],
                'stock' => 100,
                'is_featured' => true,
                'is_active' => true,
                'ingredients' => 'Angus Beef Patty, Crispy Beef Bacon, Sharp Cheddar, Hickory BBQ Glaze, Grilled Sweet Onions, Brioche.',
                'nutritional_info' => [
                    'serving_size' => '1 Burger',
                    'protein' => '40g',
                    'fat' => '26g',
                    'carbs' => '46g',
                    'calories' => '610 kcal',
                ],
                'storage_instructions' => 'Enjoy warm upon arrival.',
                'certifications' => ['100% Halal Beef', 'Smoky Hickory Recipe'],
                'badges' => ['Hot Deals'],
                'images' => [
                    'images/burger-house/bbq-bacon.jpg',
                ],
                'variants' => [
                    ['weight' => 'Regular Cut', 'price' => 26000, 'promo_price' => 24000, 'stock' => 70, 'is_default' => true],
                    ['weight' => 'Extra Bacon Cut', 'price' => 29000, 'promo_price' => 27000, 'stock' => 30, 'is_default' => false],
                ],
            ],
            [
                'category_slug' => 'crispy-chicken',
                'name' => 'Chicken Avocado Burger',
                'slug' => 'chicken-avocado-burger',
                'sku' => 'BH-CHK-004',
                'pack_size' => 'Crispy Cutlet',
                'price' => 24000,
                'promo_price' => 22000,
                'short_description' => 'Crispy chicken, fresh avocado, lettuce, tomato, chipotle mayo.',
                'description' => "Buttermilk-marinated crispy chicken breast fried to golden perfection, crowned with fresh Hass avocado slices, crisp romaine lettuce, and house-made smoky chipotle aioli.",
                'weight_options' => ['Crispy Breast', 'Spicy Nashville Style'],
                'stock' => 90,
                'is_featured' => true,
                'is_active' => true,
                'ingredients' => 'Tender Chicken Breast, Seasoned Panko Crust, Fresh Avocado, Romaine Lettuce, Sliced Tomatoes, Chipotle Aioli.',
                'nutritional_info' => [
                    'serving_size' => '1 Burger',
                    'protein' => '38g',
                    'fat' => '20g',
                    'carbs' => '48g',
                    'calories' => '520 kcal',
                ],
                'storage_instructions' => 'Enjoy fresh and crispy immediately.',
                'certifications' => ['100% Halal Chicken', 'Fresh Local Avocado'],
                'badges' => ['New'],
                'images' => [
                    'images/burger-house/chicken-avocado.jpg',
                ],
                'variants' => [
                    ['weight' => 'Original Crispy', 'price' => 24000, 'promo_price' => 22000, 'stock' => 60, 'is_default' => true],
                    ['weight' => 'Spicy Nashville', 'price' => 25000, 'promo_price' => 23000, 'stock' => 30, 'is_default' => false],
                ],
            ],
            [
                'category_slug' => 'hot-deals-combos',
                'name' => 'Super Burger & Fries Combo Pack',
                'slug' => 'super-burger-fries-combo-pack',
                'sku' => 'BH-CMB-005',
                'pack_size' => 'Combo Feast',
                'price' => 35000,
                'promo_price' => 30000,
                'short_description' => 'Includes Double Gourmet Beef Burger, large carton of golden crispy fries, and refreshing cold soda.',
                'description' => "Our best-value combo feast. Complete with a Double Gourmet Beef Burger, large carton of double-fried golden fries, and a chilled soft drink of your choice.\n\nFree delivery included within Dar es Salaam!",
                'weight_options' => ['Full Meal Combo'],
                'stock' => 80,
                'is_featured' => true,
                'is_active' => true,
                'ingredients' => 'Double Cheese Burger, Golden Fries, Chilled Beverage.',
                'nutritional_info' => [
                    'serving_size' => 'Full Combo Meal',
                    'protein' => '52g',
                    'fat' => '38g',
                    'carbs' => '85g',
                    'calories' => '920 kcal',
                ],
                'storage_instructions' => 'Served fresh and piping hot.',
                'certifications' => ['Free Delivery Included', 'Best Value Combo'],
                'badges' => ['Combo Pack', 'Free Delivery'],
                'images' => [
                    'images/burger-house/hot-deals-combo.jpg',
                ],
                'variants' => [
                    ['weight' => 'Full Combo Pack', 'price' => 35000, 'promo_price' => 30000, 'stock' => 80, 'is_default' => true],
                ],
            ],
            [
                'category_slug' => 'sides-fries',
                'name' => 'Golden Crispy French Fries',
                'slug' => 'golden-crispy-french-fries',
                'sku' => 'BH-FRIES-006',
                'pack_size' => 'Large Carton',
                'price' => 8000,
                'promo_price' => null,
                'short_description' => 'Double-fried golden crispy potatoes seasoned with house sea salt and paprika.',
                'description' => "Hot, crispy on the outside and fluffy on the inside. Double-fried to order and seasoned with our signature blend of fine sea salt and mild paprika.",
                'weight_options' => ['Regular', 'Large Carton'],
                'stock' => 200,
                'is_featured' => false,
                'is_active' => true,
                'ingredients' => 'Hand-cut Russet Potatoes, Pure Vegetable Oil, Sea Salt, Smoked Paprika.',
                'nutritional_info' => [
                    'serving_size' => 'Large Carton',
                    'protein' => '5g',
                    'fat' => '14g',
                    'carbs' => '45g',
                    'calories' => '320 kcal',
                ],
                'storage_instructions' => 'Best enjoyed warm and crisp.',
                'certifications' => ['100% Vegetarian', 'Made Fresh to Order'],
                'badges' => ['Sides'],
                'images' => [
                    'images/burger-house/hero-burger.jpg',
                ],
                'variants' => [
                    ['weight' => 'Large Carton', 'price' => 8000, 'promo_price' => null, 'stock' => 200, 'is_default' => true],
                ],
            ],
            [
                'category_slug' => 'original-beef-biltong',
                'name' => 'COY Signature Original Beef Biltong',
                'slug' => 'coy-signature-original-beef-biltong',
                'sku' => 'COY-ORIG-100',
                'pack_size' => '100g',
                'price' => 12000,
                'promo_price' => 10000,
                'short_description' => 'Handcrafted prime beef air-dried to perfection with toasted whole coriander and cracked black pepper.',
                'description' => "Our flagship original beef biltong represents the pinnacle of dried meat craftsmanship. Cut strictly from premium pasture-raised beef, each strip is marinated in natural cider vinegar, toasted coriander seeds, cracked black peppercorns and sea salt before undergoing slow, moisture-controlled ambient drying.\n\nNever cooked, never subjected to artificial heat, COY Signature Biltong retains the authentic texture, rich beefiness and natural proteins of true artisanal biltong. Perfectly sliced for instant enjoyment at your desk, on a safari drive, or paired with your favourite evening beverage.",
                'weight_options' => ['100g', '250g', '500g', '1kg'],
                'stock' => 120,
                'is_featured' => true,
                'is_active' => true,
                'ingredients' => '100% Tanzanian Prime Beef, Cider Vinegar, Roasted Coriander Seeds, Sea Salt, Cracked Black Pepper, Brown Sugar, Potassium Sorbate (natural preservative).',
                'nutritional_info' => [
                    'serving_size' => '50g',
                    'protein' => '28g',
                    'fat' => '4g',
                    'carbs' => '1.5g',
                    'calories' => '155 kcal',
                ],
                'storage_instructions' => 'Store in a cool, dry place away from direct sunlight. Once opened, consume within 3-4 days or keep refrigerated.',
                'certifications' => ['100% Halal Certified', 'TBS Compliant', 'Pasture Grazed Beef'],
                'badges' => ['Best Seller', 'Signature Cut'],
                'images' => [
                    'images/biltong-original-1.jpg',
                    'images/biltong-original-2.jpg',
                    'images/carvers-slab.jpg',
                ],
                'variants' => [
                    ['weight' => '100g', 'price' => 10000, 'promo_price' => 10000, 'stock' => 50, 'is_default' => true],
                    ['weight' => '250g', 'price' => 24000, 'promo_price' => 22000, 'stock' => 40, 'is_default' => false],
                    ['weight' => '500g', 'price' => 45000, 'promo_price' => 42000, 'stock' => 20, 'is_default' => false],
                    ['weight' => '1kg', 'price' => 85000, 'promo_price' => 80000, 'stock' => 10, 'is_default' => false],
                ],
            ],
            [
                'category_slug' => 'chilli-beef-biltong',
                'name' => 'COY Fire-Bite Chilli Beef Biltong',
                'slug' => 'coy-fire-bite-chilli-beef-biltong',
                'sku' => 'COY-CHILLI-100',
                'pack_size' => '100g',
                'price' => 13000,
                'promo_price' => 11000,
                'short_description' => 'Infused with sun-dried African bird’s eye chillies for a lingering, mouthwatering fiery crunch.',
                'description' => "Crafted for lovers of bold flavours and balanced heat. COY Fire-Bite Chilli Biltong combines prime lean beef cuts with coarse sun-dried bird’s eye chillies, cracked cayenne and whole coriander.\n\nThe initial bite introduces rich, savoury beef sweetness, followed by an exhilarating crescendo of warm, satisfying spice that lingers without overpowering the meat’s natural depth.",
                'weight_options' => ['100g', '250g', '500g'],
                'stock' => 85,
                'is_featured' => true,
                'is_active' => true,
                'ingredients' => 'Prime Beef, Crushed Dried Bird’s Eye Chillies, Cayenne Pepper, Cider Vinegar, Coriander, Salt, Black Pepper.',
                'nutritional_info' => [
                    'serving_size' => '50g',
                    'protein' => '29g',
                    'fat' => '3.5g',
                    'carbs' => '1.8g',
                    'calories' => '158 kcal',
                ],
                'storage_instructions' => 'Keep in a cool dry area. Seal bag tight after opening.',
                'certifications' => ['100% Halal Certified', 'TBS Compliant'],
                'badges' => ['Spicy Favourite', 'Staff Pick'],
                'images' => [
                    'images/chilli-biltong.jpg',
                    'images/craft-spices.jpg',
                ],
                'variants' => [
                    ['weight' => '100g', 'price' => 11000, 'promo_price' => 11000, 'stock' => 40, 'is_default' => true],
                    ['weight' => '250g', 'price' => 26000, 'promo_price' => 24000, 'stock' => 30, 'is_default' => false],
                    ['weight' => '500g', 'price' => 48000, 'promo_price' => 45000, 'stock' => 15, 'is_default' => false],
                ],
            ],
            [
                'category_slug' => 'spicy-beef-biltong',
                'name' => 'COY Aromatic Spicy Beef Biltong',
                'slug' => 'coy-aromatic-spicy-beef-biltong',
                'sku' => 'COY-SPICE-100',
                'pack_size' => '100g',
                'price' => 12500,
                'promo_price' => null,
                'short_description' => 'A complex, warm spice marinade featuring roasted pimento, cloves, smoked paprika and crushed black pepper.',
                'description' => "Inspired by traditional spice-island trade routes, our Aromatic Spicy Biltong infuses cured beef with hand-roasted pimento, Zanzibar cloves, smoked sweet paprika and coarse black pepper.\n\nNot intensely hot, but deeply fragrant and savoury, this profile is a favourite among gourmands looking for an editorial snacking profile.",
                'weight_options' => ['100g', '250g', '500g'],
                'stock' => 70,
                'is_featured' => true,
                'is_active' => true,
                'ingredients' => 'Prime Beef, Roasted Pimento, Ground Zanzibar Cloves, Smoked Paprika, Coriander, Sea Salt, Vinegar.',
                'nutritional_info' => [
                    'serving_size' => '50g',
                    'protein' => '27g',
                    'fat' => '4.2g',
                    'carbs' => '2.0g',
                    'calories' => '152 kcal',
                ],
                'storage_instructions' => 'Cool, dry location. Resealable zip packaging preserves peak aroma.',
                'certifications' => ['100% Halal Certified', 'TBS Compliant'],
                'badges' => ['Artisanal Spice'],
                'images' => [
                    'images/craft-spices.jpg',
                    'images/carvers-slab.jpg',
                ],
                'variants' => [
                    ['weight' => '100g', 'price' => 12500, 'promo_price' => null, 'stock' => 35, 'is_default' => true],
                    ['weight' => '250g', 'price' => 28000, 'promo_price' => 26000, 'stock' => 25, 'is_default' => false],
                    ['weight' => '500g', 'price' => 52000, 'promo_price' => 49000, 'stock' => 10, 'is_default' => false],
                ],
            ],
            [
                'category_slug' => 'premium-beef-biltong',
                'name' => 'COY Reserve Sirloin Carver Cut',
                'slug' => 'coy-reserve-sirloin-carver-cut',
                'sku' => 'COY-RES-250',
                'pack_size' => '250g',
                'price' => 32000,
                'promo_price' => 29000,
                'short_description' => 'Center-cut prime sirloin with golden fat edging, sliced thick for a buttery, luxurious mouthfeel.',
                'description' => "Our Reserve Sirloin Carver Cut is curated for biltong connoisseurs who appreciate the delicate balance of lean muscle and a ribbon of rich, golden fat.\n\nSlowly hung in precision airflow chambers, each carver slab develops tender grain and concentrated umami. Sliced slightly thicker to preserve moist tenderness.",
                'weight_options' => ['250g', '500g', '1kg'],
                'stock' => 45,
                'is_featured' => true,
                'is_active' => true,
                'ingredients' => 'Prime Center-Cut Sirloin Beef, Coriander, Sea Salt, Black Pepper, Balsamic Cider Reduction.',
                'nutritional_info' => [
                    'serving_size' => '50g',
                    'protein' => '26g',
                    'fat' => '7g',
                    'carbs' => '1.0g',
                    'calories' => '172 kcal',
                ],
                'storage_instructions' => 'Refrigerate after opening to preserve moisture.',
                'certifications' => ['Premium Reserve Grade', '100% Halal Certified'],
                'badges' => ['Connoisseur Cut', 'Limited Batch'],
                'images' => [
                    'images/carvers-slab.jpg',
                    'images/hero-steak.jpg',
                ],
                'variants' => [
                    ['weight' => '250g', 'price' => 29000, 'promo_price' => 29000, 'stock' => 25, 'is_default' => true],
                    ['weight' => '500g', 'price' => 56000, 'promo_price' => 52000, 'stock' => 15, 'is_default' => false],
                    ['weight' => '1kg', 'price' => 105000, 'promo_price' => 98000, 'stock' => 5, 'is_default' => false],
                ],
            ],
            [
                'category_slug' => 'family-packs',
                'name' => 'COY Executive Family Feast Pack (1kg)',
                'slug' => 'coy-executive-family-feast-pack',
                'sku' => 'COY-FAM-1KG',
                'pack_size' => '1kg',
                'price' => 95000,
                'promo_price' => 88000,
                'short_description' => 'A hearty 1kg bundle of premium sliced biltong packaged into four sealed 250g fresh-lock packs.',
                'description' => "Designed for households, weekend get-togethers, and serious biltong fans. The COY Executive Family Feast Pack contains a total of 1kg premium beef biltong divided across 4 individually vacuum-sealed 250g packs for guaranteed freshness.\n\nKeep one in the pantry, take one to the office, and pack one for your weekend road trip.",
                'weight_options' => ['1kg', '2kg'],
                'stock' => 30,
                'is_featured' => true,
                'is_active' => true,
                'ingredients' => 'Tanzanian Prime Beef, Spices, Sea Salt, Natural Vinegar.',
                'nutritional_info' => [
                    'serving_size' => '50g',
                    'protein' => '28g',
                    'fat' => '4g',
                    'carbs' => '1.5g',
                    'calories' => '155 kcal',
                ],
                'storage_instructions' => 'Unopened packs remain fresh for up to 90 days in cool storage.',
                'certifications' => ['100% Halal Certified', 'Family Value Size'],
                'badges' => ['Best Value', 'Free Shipping'],
                'images' => [
                    'images/wholesale-box.jpg',
                    'images/bbq-biltong.jpg',
                ],
                'variants' => [
                    ['weight' => '1kg (4 x 250g)', 'price' => 88000, 'promo_price' => 88000, 'stock' => 20, 'is_default' => true],
                    ['weight' => '2kg (8 x 250g)', 'price' => 170000, 'promo_price' => 160000, 'stock' => 10, 'is_default' => false],
                ],
            ],
            [
                'category_slug' => 'mixed-packs',
                'name' => 'COY Explorer Trio Tasting Pack',
                'slug' => 'coy-explorer-trio-tasting-pack',
                'sku' => 'COY-TRIO-300',
                'pack_size' => '3 x 100g',
                'price' => 35000,
                'promo_price' => 30000,
                'short_description' => 'The ultimate variety pack featuring 100g Original, 100g Chilli, and 100g Aromatic Spicy cuts.',
                'description' => "Can’t decide which flavour you love best? The COY Explorer Trio Tasting Pack includes three distinct 100g pouches:\n\n1. Signature Original Beef Biltong\n2. Fire-Bite Chilli Beef Biltong\n3. Aromatic Spicy Beef Biltong\n\nThe perfect introduction to the COY BILTONG experience, and a stunning gift for clients, friends, or safari travelers.",
                'weight_options' => ['300g (3x100g)', '750g (3x250g)'],
                'stock' => 50,
                'is_featured' => true,
                'is_active' => true,
                'ingredients' => 'Premium Tanzanian Beef, Toasted Coriander, Sea Salt, Bird’s Eye Chilli, Pimento, Vinegar.',
                'nutritional_info' => [
                    'serving_size' => '50g',
                    'protein' => '28g',
                    'fat' => '4g',
                    'carbs' => '1.5g',
                    'calories' => '155 kcal',
                ],
                'storage_instructions' => 'Cool dry place.',
                'certifications' => ['100% Halal Certified', 'Tasting Set'],
                'badges' => ['Tasting Pack', 'Gift Idea'],
                'images' => [
                    'images/hero-biltong.jpg',
                    'images/biltong-original-1.jpg',
                    'images/chilli-biltong.jpg',
                ],
                'variants' => [
                    ['weight' => '300g (3 x 100g)', 'price' => 30000, 'promo_price' => 30000, 'stock' => 35, 'is_default' => true],
                    ['weight' => '750g (3 x 250g)', 'price' => 70000, 'promo_price' => 65000, 'stock' => 15, 'is_default' => false],
                ],
            ],
        ];

        foreach ($productsData as $pData) {
            $cat = $categories[$pData['category_slug']] ?? null;
            if (!$cat) continue;

            $product = Product::updateOrCreate(
                ['slug' => $pData['slug']],
                [
                    'category_id' => $cat->id,
                    'name' => $pData['name'],
                    'sku' => $pData['sku'],
                    'pack_size' => $pData['pack_size'],
                    'price' => $pData['price'],
                    'promo_price' => $pData['promo_price'],
                    'short_description' => $pData['short_description'],
                    'description' => $pData['description'],
                    'weight_options' => $pData['weight_options'],
                    'stock' => $pData['stock'],
                    'is_featured' => $pData['is_featured'],
                    'is_active' => $pData['is_active'],
                    'ingredients' => $pData['ingredients'],
                    'nutritional_info' => $pData['nutritional_info'],
                    'storage_instructions' => $pData['storage_instructions'],
                    'certifications' => $pData['certifications'],
                    'badges' => $pData['badges'],
                ]
            );

            // Images
            foreach ($pData['images'] as $idx => $img) {
                ProductImage::updateOrCreate(
                    ['product_id' => $product->id, 'image_path' => $img],
                    ['is_primary' => $idx === 0, 'sort_order' => $idx]
                );
            }

            // Variants
            foreach ($pData['variants'] as $v) {
                ProductVariant::updateOrCreate(
                    ['product_id' => $product->id, 'weight' => $v['weight']],
                    [
                        'sku' => $product->sku . '-' . Str::slug($v['weight']),
                        'price' => $v['price'],
                        'promo_price' => $v['promo_price'],
                        'stock' => $v['stock'],
                        'is_default' => $v['is_default'],
                        'is_active' => true,
                    ]
                );
            }
        }

        // 5. Promotional and Hero Banners
        Banner::updateOrCreate(
            ['title' => 'REAL MEAT. REAL TASTE.'],
            [
                'subtitle' => 'Discover the rich taste of premium beef biltong. Carefully prepared for those who appreciate quality, flavour and convenience.',
                'badge' => 'PREMIUM ARTISANAL BILTONG',
                'image_url' => 'images/hero-biltong.jpg',
                'cta_text' => 'SHOP NOW',
                'cta_url' => '/shop',
                'secondary_cta_text' => 'DISCOVER OUR STORY',
                'secondary_cta_url' => '/about',
                'type' => 'hero',
                'is_active' => true,
                'sort_order' => 1,
            ]
        );

        Banner::updateOrCreate(
            ['title' => 'GOOD TASTE GOES EVERYWHERE.'],
            [
                'subtitle' => 'From high-powered corporate meetings to rugged off-road expeditions, COY BILTONG fuels your journey with pure protein and authentic taste.',
                'badge' => 'LIFESTYLE ESSENTIAL',
                'image_url' => 'images/bbq-biltong.jpg',
                'cta_text' => 'EXPLORE OUR PRODUCTS',
                'cta_url' => '/shop',
                'secondary_cta_text' => 'ORDER ON WHATSAPP',
                'secondary_cta_url' => 'https://wa.me/255768123456?text=Hello%20COY%20BILTONG,%20I%20would%20like%20to%20order',
                'type' => 'promo',
                'is_active' => true,
                'sort_order' => 2,
            ]
        );

        // 6. Testimonials (Demonstration Reviews)
        $testimonials = [
            [
                'customer_name' => 'Faraja Mwakyoma',
                'customer_role' => 'Corporate Legal Counsel, Dar es Salaam',
                'location' => 'Dar es Salaam',
                'comment' => 'COY BILTONG is in a class of its own. Tender, perfectly seasoned with whole toasted coriander seeds, and never dry or rubbery like supermarket brands. It has become a permanent staple in my office desk drawer.',
                'rating' => 5,
                'avatar' => 'images/hero-biltong.jpg',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'customer_name' => 'David Richardson',
                'customer_role' => 'Safari Expedition Leader',
                'location' => 'Arusha / Serengeti',
                'comment' => 'We pack COY BILTONG for every long overland expedition across the Serengeti. It’s clean, pure beef protein that withstands the safari heat and satisfies discerning international guests every single time.',
                'rating' => 5,
                'avatar' => 'images/carvers-slab.jpg',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'customer_name' => 'Aisha Khamis',
                'customer_role' => 'Marathon Runner & Fitness Coach',
                'location' => 'Dar es Salaam',
                'comment' => 'Finding clean, zero-sugar, high-protein snacks in Tanzania used to be a struggle. COY Biltong gives me 28 grams of real beef protein per serving with exceptional, natural taste. The Chilli cut is simply phenomenal.',
                'rating' => 5,
                'avatar' => 'images/chilli-biltong.jpg',
                'is_featured' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($testimonials as $t) {
            Testimonial::updateOrCreate(
                ['customer_name' => $t['customer_name']],
                array_merge($t, ['is_active' => true])
            );
        }

        // 7. Discount Coupons
        Coupon::updateOrCreate(
            ['code' => 'COY10'],
            [
                'type' => 'percentage',
                'value' => 10,
                'min_order_amount' => 20000,
                'max_discount_amount' => 15000,
                'usage_limit' => 100,
                'times_used' => 8,
                'starts_at' => now()->subDays(5),
                'expires_at' => now()->addDays(60),
                'is_active' => true,
            ]
        );

        Coupon::updateOrCreate(
            ['code' => 'KARIBU5'],
            [
                'type' => 'fixed',
                'value' => 5000,
                'min_order_amount' => 40000,
                'usage_limit' => 50,
                'times_used' => 3,
                'starts_at' => now()->subDays(2),
                'expires_at' => now()->addDays(90),
                'is_active' => true,
            ]
        );

        // 8. Sample Seed Orders
        $firstProduct = Product::first();
        if ($firstProduct) {
            $sampleOrder = Order::updateOrCreate(
                ['order_number' => 'COY-20261126-001'],
                [
                    'user_id' => $customer->id,
                    'customer_name' => 'Neema Mushi',
                    'customer_email' => 'customer@coybiltong.co.tz',
                    'customer_phone' => '+255 754 987 654',
                    'delivery_city' => 'Dar es Salaam',
                    'delivery_area' => 'Masaki / Oysterbay',
                    'delivery_address' => 'Plot 42 Chole Road, Floor 3',
                    'delivery_method' => 'Dar es Salaam Express',
                    'delivery_fee' => 0,
                    'subtotal' => 50000,
                    'coupon_code' => 'COY10',
                    'discount_amount' => 5000,
                    'total' => 45000,
                    'payment_method' => 'mpesa',
                    'payment_status' => 'paid',
                    'payment_reference' => 'QA983JK201',
                    'order_status' => Order::STATUS_DELIVERED,
                    'notes' => 'Please deliver by 2:00 PM.',
                    'ordered_via_whatsapp' => false,
                ]
            );

            OrderItem::updateOrCreate(
                ['order_id' => $sampleOrder->id, 'product_id' => $firstProduct->id],
                [
                    'product_name' => $firstProduct->name,
                    'pack_size' => '250g',
                    'unit_price' => 25000,
                    'quantity' => 2,
                    'subtotal' => 50000,
                ]
            );

            Payment::updateOrCreate(
                ['order_id' => $sampleOrder->id],
                [
                    'transaction_reference' => 'QA983JK201',
                    'payment_method' => 'mpesa',
                    'amount' => 45000,
                    'currency' => 'TZS',
                    'status' => 'verified',
                    'sender_phone' => '+255 754 987 654',
                    'sender_name' => 'Neema Mushi',
                    'verified_at' => now()->subDay(),
                    'verified_by' => $admin->id,
                ]
            );
        }
    }
}
