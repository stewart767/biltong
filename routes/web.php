<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminContentController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\Admin\AdminSubscriberController;
use App\Http\Controllers\Admin\AdminWholesaleController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderTrackingController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\WholesaleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Storefront Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [ShopController::class, 'menu'])->name('menu');
Route::get('/shop', [ShopController::class, 'menu'])->name('shop');
Route::get('/product/{slug}', [ShopController::class, 'show'])->name('product.show');
Route::get('/api/product/{id}/quick-view', [ShopController::class, 'quickView'])->name('product.quickview');

// Editorial / Brand Pages
Route::get('/about-us', [PageController::class, 'about'])->name('about');
Route::get('/our-story', [PageController::class, 'about']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/order', [CheckoutController::class, 'orderPage'])->name('order');
Route::get('/quality-process', [PageController::class, 'craft'])->name('craft');
Route::get('/craft', [PageController::class, 'craft']);
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'contactSend'])->name('contact.send');
Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/terms-and-conditions', [PageController::class, 'terms'])->name('terms');
Route::get('/refund-policy', [PageController::class, 'refund'])->name('refund');
Route::get('/our-shops', [PageController::class, 'shops'])->name('shops');

Route::post('/newsletter', [PageController::class, 'newsletterSubscribe'])->name('newsletter.subscribe');
Route::get('/wholesale', [WholesaleController::class, 'index'])->name('wholesale');
Route::post('/wholesale', [WholesaleController::class, 'store'])->name('wholesale.store');

/*
|--------------------------------------------------------------------------
| Shopping Cart & Checkout
|--------------------------------------------------------------------------
*/

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/cart/coupon/apply', [CartController::class, 'applyCoupon'])->name('cart.coupon.apply');
Route::post('/cart/coupon/remove', [CartController::class, 'removeCoupon'])->name('cart.coupon.remove');
Route::get('/api/cart/count', [CartController::class, 'count'])->name('cart.count');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/order-confirmation/{orderNumber}', [CheckoutController::class, 'confirmation'])->name('order.confirmation');
Route::get('/track-order', [OrderTrackingController::class, 'index'])->name('track');

/*
|--------------------------------------------------------------------------
| Customer Authentication & Account Portal
|--------------------------------------------------------------------------
*/

Route::get('/login', [CustomerAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [CustomerAuthController::class, 'login'])->name('login.submit');
Route::get('/register', [CustomerAuthController::class, 'showRegister'])->name('register');
Route::post('/register', [CustomerAuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('logout');
Route::get('/forgot-password', [CustomerAuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [CustomerAuthController::class, 'forgotPassword'])->name('password.email');

Route::middleware('auth')->prefix('account')->name('account.')->group(function () {
    Route::get('/dashboard', [AccountController::class, 'dashboard'])->name('dashboard');
    Route::get('/orders', [AccountController::class, 'orders'])->name('orders');
    Route::get('/orders/{orderNumber}', [AccountController::class, 'orderDetail'])->name('orders.show');
    Route::get('/profile', [AccountController::class, 'profile'])->name('profile');
    Route::post('/profile', [AccountController::class, 'updateProfile'])->name('profile.update');
    Route::get('/addresses', [AccountController::class, 'addresses'])->name('addresses');
    Route::post('/addresses', [AccountController::class, 'storeAddress'])->name('addresses.store');
    Route::delete('/addresses/{id}', [AccountController::class, 'deleteAddress'])->name('addresses.destroy');
    Route::post('/addresses/{id}/default', [AccountController::class, 'setDefaultAddress'])->name('addresses.default');
});

/*
|--------------------------------------------------------------------------
| Admin Authentication
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
| Protected Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [AdminDashboardController::class, 'index']);

    // Product & Inventory Management
    Route::resource('products', AdminProductController::class);
    Route::delete('/products/image/{id}', [AdminProductController::class, 'destroyImage'])->name('products.image.destroy');
    Route::resource('categories', AdminCategoryController::class);

    // Order & Delivery Management
    Route::resource('orders', AdminOrderController::class)->only(['index', 'show']);
    Route::post('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.status');
    Route::post('/orders/{order}/confirm-payment', [AdminOrderController::class, 'confirmPayment'])->name('orders.payment.confirm');
    Route::post('/orders/{order}/delivery', [AdminOrderController::class, 'updateDelivery'])->name('orders.delivery');
    Route::get('/orders/{order}/invoice', [AdminOrderController::class, 'invoice'])->name('orders.invoice');

    // Customer Management
    Route::resource('customers', AdminCustomerController::class)->only(['index', 'show']);

    // Content Management (Hero banners, Promo banners, Testimonials)
    Route::get('/content/banners', [AdminContentController::class, 'banners'])->name('content.banners');
    Route::post('/content/banners', [AdminContentController::class, 'storeBanner'])->name('content.banners.store');
    Route::put('/content/banners/{banner}', [AdminContentController::class, 'updateBanner'])->name('content.banners.update');
    Route::delete('/content/banners/{banner}', [AdminContentController::class, 'destroyBanner'])->name('content.banners.destroy');

    Route::get('/content/testimonials', [AdminContentController::class, 'testimonials'])->name('content.testimonials');
    Route::post('/content/testimonials', [AdminContentController::class, 'storeTestimonial'])->name('content.testimonials.store');
    Route::put('/content/testimonials/{testimonial}', [AdminContentController::class, 'updateTestimonial'])->name('content.testimonials.update');
    Route::delete('/content/testimonials/{testimonial}', [AdminContentController::class, 'destroyTestimonial'])->name('content.testimonials.destroy');

    // Reports & Analytics
    Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');

    // Communication & Leads
    Route::resource('wholesale', AdminWholesaleController::class)->only(['index', 'show', 'update']);
    Route::resource('messages', AdminContactController::class)->only(['index', 'show', 'destroy']);
    Route::post('/messages/{message}/status', [AdminContactController::class, 'updateStatus'])->name('messages.status');
    Route::resource('subscribers', AdminSubscriberController::class)->only(['index', 'destroy']);

    // Settings
    Route::get('/settings', [AdminSettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [AdminSettingsController::class, 'update'])->name('settings.update');
});
