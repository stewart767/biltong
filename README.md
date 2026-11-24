# biltong

## INAS Premium Beef Biltong — Web Platform & Operations

A world-class, premium food-brand eCommerce and B2B wholesale platform built for **INAS Company Limited** (Buguruni Malapa, Dar es Salaam, Tanzania).

---

### Brand & Design Identity
- **Color Palette**: Butcher Crimson Red (`#b91c1c`, `#dc2626`), Deep Charcoal Black (`#0b0b0b`), and Crisp White card surfaces.
- **Layout**: Inspired by artisanal butchery showcases — sizzling dark hero with curved arch divider, horizontal butcher category banner, white card bestsellers with full-width red action bars, and secondary slabs showcase.
- **Bilingual Experience**: Built-in **Kiswahili** (🇹🇿) and **English** (🇬🇧) with an automatic first-visit language selection popup and on-demand header toggle.

---

### Core Features

1. **Flagship Catalogue & Product Management**:
   - Flagship **Biltong Original 100g**, Chilli Biltong Bites, Traditional Droëwors, Carver's Slabs, and Starter Cartons.
   - Dynamic weight pack size price calculation (100g, 250g, 500g, 1kg).
   - Nutritional breakdown panel (52.4g protein per 100g, iron, zero artificial nitrates).
   - 100% Halal certification badges.

2. **Full eCommerce & Tanzanian Checkout**:
   - Reactive slide-over shopping bag drawer with free Dar es Salaam delivery progress meter (qualifies at TZS 50,000+).
   - Delivery district selector covering Buguruni, Masaki, Oysterbay, Mikocheni, Sinza, Kinondoni, and regional parcel dispatch.
   - Tanzanian mobile money & payment methods:
     - **Vodacom M-Pesa** (Lipa Namba / Till: 5829100)
     - **Tigo Pesa Mixx** (6182900)
     - **Airtel Money Merchant** (712900)
     - **Halopesa Till** (489200)
     - **Cash on Delivery / Direct Bank Transfer**
   - Direct 1-Click WhatsApp order generation with pre-filled message templates.

3. **Real-Time Order Tracking Pipeline**:
   - 5-stage visual delivery tracker: *Received &rarr; Confirmed &rarr; Sliced & Sealed &rarr; Out for Delivery &rarr; Delivered*.

4. **Wholesale B2B Distribution Portal**:
   - Dedicated commercial inquiry portal for supermarkets, safari lodges (Serengeti, Ngorongoro), hotels, and gyms.
   - Volume tier selections and direct dispatch coordination.

5. **Secure Admin Operations Portal**:
   - **Dashboard**: Revenue analytics, pending dispatch queues, and lead summaries.
   - **Products & Categories**: Full CRUD for catalogue items, prices, and imagery.
   - **Orders Management**: Order status updates and payment tracking.
   - **Wholesale Leads**: Pipeline from New to Quoted and Closed.
   - **Site Settings**: Live updates for hotline numbers, addresses, and banner announcements.

---

### Tech Stack
- **Backend**: Laravel 12, PHP 8.3, SQLite / MySQL
- **Frontend**: Tailwind CSS 4, Alpine.js, Blade Templates, Vite v8
- **Testing**: PHPUnit / Pest (24 automated tests, 84 assertions)

---

### Local Installation & Setup

1. **Clone Repository**:
   ```bash
   git clone https://github.com/stewart767/biltong.git
   cd biltong
   ```

2. **Install PHP & Node Dependencies**:
   ```bash
   composer install
   npm install
   ```

3. **Environment & Database**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   php artisan migrate --seed
   ```

4. **Compile Assets & Run Server**:
   ```bash
   npm run build
   php artisan serve
   ```

---

### Default Admin Credentials
- **URL**: `http://127.0.0.1:8000/admin/login`
- **Email**: `admin@inas.co.tz`
- **Password**: `password`

---

### Business Contact
- **Company**: INAS Company Limited
- **Location**: Buguruni Malapa, Ilala District, Dar es Salaam, Tanzania
- **Phone / WhatsApp**: +255 682 869 629
- **Email**: sales@inasbiltong.co.tz
