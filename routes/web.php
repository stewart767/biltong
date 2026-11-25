<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\Admin\AdminSubscriberController;
use App\Http\Controllers\Admin\AdminWholesaleController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
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
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/product/{slug}', [ShopController::class, 'show'])->name('product.show');

Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/craft', [PageController::class, 'craft'])->name('craft');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'contactSend'])->name('contact.send');
Route::post('/newsletter', [PageController::class, 'newsletterSubscribe'])->name('newsletter.subscribe');

Route::get('/wholesale', [WholesaleController::class, 'index'])->name('wholesale');
Route::post('/wholesale', [WholesaleController::class, 'store'])->name('wholesale.store');

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/order-confirmation/{orderNumber}', [CheckoutController::class, 'confirmation'])->name('order.confirmation');

Route::get('/track-order', [OrderTrackingController::class, 'index'])->name('track');

/*
|--------------------------------------------------------------------------
| Language / Localization Switcher Route
|--------------------------------------------------------------------------
*/
Route::get('/locale/{lang}', function (string $lang, \Illuminate\Http\Request $request) {
    if (in_array($lang, ['en', 'sw'])) {
        session(['locale' => $lang]);
        cookie()->queue(cookie('inas_locale', $lang, 60 * 24 * 365));
    }

    if ($request->wantsJson() || $request->ajax()) {
        return response()->json(['success' => true, 'locale' => $lang]);
    }

    return redirect()->back();
})->name('locale.switch');

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
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

    Route::resource('products', AdminProductController::class);
    Route::resource('categories', AdminCategoryController::class);
    
    Route::resource('orders', AdminOrderController::class)->only(['index', 'show']);
    Route::post('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.status');

    Route::resource('wholesale', AdminWholesaleController::class)->only(['index', 'show', 'update']);

    Route::resource('messages', AdminContactController::class)->only(['index', 'show', 'destroy']);
    Route::post('/messages/{message}/status', [AdminContactController::class, 'updateStatus'])->name('messages.status');

    Route::resource('subscribers', AdminSubscriberController::class)->only(['index', 'destroy']);

    Route::get('/settings', [AdminSettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [AdminSettingsController::class, 'update'])->name('settings.update');
});
