<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Site\CategoryController;
use App\Http\Controllers\Site\ProductController;
use App\Http\Controllers\Site\CartController;
use App\Http\Controllers\Site\CheckoutController;
use App\Http\Controllers\Site\AccountController;
use App\Models\Category;
use App\Repositories\CategoryRepository;

require 'admin.php';

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $categories = array();
    $slugs = Category::all('slug');
    foreach ($slugs as $idx => $slug) {
        $category = null;
        if ($slug->slug != 'root' && $slug->slug != 'danh-muc-san-pham') {
            $category = Category::with('products')
                ->where('slug', $slug->slug)
                ->where('menu', 1)
                ->first();
            array_push($categories, $category);
        }
    }
    // dd($categories);
    return view('site.pages.homepage', compact('categories'));
});

// Route::view('/', 'site.pages.homepage');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::post('/product/add/cart', [ProductController::class, 'addToCart'])->name('product.add.cart');

Route::get('/cart', [CartController::class, 'getCart'])->name('checkout.cart');
Route::get('/cart/item/{id}/remove', [CartController::class, 'removeItem'])->name('checkout.cart.remove');
Route::get('/cart/clear', [CartController::class, 'clearCart'])->name('checkout.cart.clear');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/checkout', [CheckoutController::class, 'getCheckout'])->name('checkout.index');
    Route::post('/checkout/order', [CheckoutController::class, 'placeOrder'])->name('checkout.place.order');
    Route::get('checkout/payment/complete', [CheckoutController::class, 'complete'])->name('checkout.payment.complete');
    Route::get('account/orders', [AccountController::class, 'getOrders'])->name('account.orders');
});

Auth::routes();
