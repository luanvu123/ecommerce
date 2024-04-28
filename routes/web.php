<?php

use App\Http\Controllers\AttributeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CouponController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\CustomerRegisterController;
use App\Http\Controllers\CustomerForgotPasswordController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OutgoingProductController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\PosterController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProductMetaController;
use App\Http\Controllers\AttributeOptionController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\SkuController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TempImageController;
use App\Http\Controllers\WishlistController;

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


Route::get('/', [SiteController::class, 'index'])->name('/');
Route::get('/the-loai/{slug}', [SiteController::class, 'category'])->name('category');
Route::get('/contact', [SiteController::class, 'contact'])->name('contact');
Route::get('/cart', [SiteController::class, 'cart'])->name('cart');
Route::get('/shop', [SiteController::class, 'shop'])->name('shop');
// Route::get('/wishlist', [SiteController::class, 'wishlist'])->name('wishlist');
Route::get('/privacy-policy', [SiteController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('/terms-of-service', [SiteController::class, 'termsOfService'])->name('terms.of.service');
Route::get('/tim-kiem', [SiteController::class, 'search'])->name('tim-kiem');
Route::get('/product/{slug}', [SiteController::class, 'product'])->name('product');
Route::get('/get-product/{id}',  [SiteController::class, 'getProduct'])->name('get.product');


Auth::routes(['verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('shippings', ShippingController::class);
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('info', InfoController::class);
    Route::resource('policies', PolicyController::class);
    Route::resource('posters', PosterController::class);
    Route::resource('metas', ProductMetaController::class);
    Route::resource('coupons', CouponController::class);
    Route::resource('inventories', InventoryController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('outgoing_products', OutgoingProductController::class);
    Route::resource('attributes', AttributeController::class);
    Route::resource('attribute-options', AttributeOptionController::class);
    Route::resource('skus', SkuController::class);
    Route::resource('orders', OrderController::class);
    Route::get('skus/create/{product_id}', [SkuController::class, 'create_sku'])->name('skus.create.product');
    Route::get('/inventories/create/{product_id}', [InventoryController::class, 'create_product'])->name('inventories.create.product');
    Route::get('/outgoing-products/create/{product_id}', [OutgoingProductController::class, 'outgoing_create_product'])->name('outgoing.products.create.product');
    Route::get('inventories/{inventory}/print', [InventoryController::class, 'generatePDF'])->name('inventories.generatePDF');
    Route::get('/outgoing-products/{id}/generate-pdf', [OutgoingProductController::class, 'generatePDF'])->name('outgoing.products.generate.pdf');


    Route::get('/meta-choose', [ProductMetaController::class, 'meta_choose'])->name('meta-choose');
    Route::get('/supplier-choose', [SupplierController::class, 'supplier_choose'])->name('supplier-choose');
    Route::get('/poster-choose', [PosterController::class, 'poster_choose'])->name('poster-choose');
    Route::get('/large-poster-choose', [PosterController::class, 'large_poster_choose'])->name('large-poster-choose');
    Route::get('/trangthai-choose', [ProductController::class, 'trangthai_choose'])->name('trangthai-choose');
    Route::get('/policy-choose', [PolicyController::class, 'policy_choose'])->name('policy-choose');
    Route::get('/hotDeal-choose', [ProductController::class, 'hotDeal_choose'])->name('hotDeal-choose');
    Route::get('/cate-choose', [CategoryController::class, 'cate_choose'])->name('cate-choose');
    Route::get('/newviral-choose', [ProductController::class, 'updateNewViralChoose'])->name('newviral-choose');
    Route::get('/mostsold-choose', [ProductController::class, 'updateMostSoldChoose'])->name('mostsold-choose');
    Route::get('/coupon-choose', [CouponController::class, 'coupon_choose'])->name('coupon-choose');


    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::post('/temp-images', [TempImageController::class, 'store'])->name('temp-images.create');
    Route::post('/product-images', [ProductImageController::class, 'store'])->name('product-images.store');
    Route::delete('/product-images/{image}', [ProductImageController::class, 'destroy'])->name('product-images.delete');
});
// Show the form to request a password reset link
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');

// Send password reset email
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');

// Show the form to reset the password
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');

// Update the password
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
    ->name('password.update');
// Show the login form
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Handle the login request
Route::post('/login', [LoginController::class, 'login']);

// Logout the user
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


//customer

Route::post('/customer/register', [CustomerRegisterController::class, 'register'])
    ->name('customer.register');
Route::get('/signup', [CustomerRegisterController::class, 'showRegistrationForm'])
    ->name('customer.signup');


// Route for logging out the customer
Route::post('/customer-logout', [CustomerLoginController::class, 'logout'])->name('customer.logout');
Route::get('/customer/password/reset', [CustomerForgotPasswordController::class, 'showCustomerLinkRequestForm'])
    ->name('customer.request');
Route::post('/reset-new-pass', [CustomerForgotPasswordController::class, 'reset_new_pass'])->name('customer.update');
Route::get('/update-new-pass', [CustomerForgotPasswordController::class, 'update_new_pass']);
Route::post('/customer/password/email', [CustomerForgotPasswordController::class, 'sendPasswordResetLink'])
    ->name('customer.email');


// Route for showing the customer login form
Route::get('/customer-login', [CustomerLoginController::class, 'showLoginForm'])->name('customer.login');

// Route for handling the customer login request
Route::post('/customer-login', [CustomerLoginController::class, 'login'])->name('customer.login.submit');
// Routes that require customer authentication
Route::get('/my-account', [CustomerLoginController::class, 'showAccount'])->name('customer.account');
Route::post('/update-account', [CustomerLoginController::class, 'updateAccount'])->name('customer.update.account');


Route::get('/customer-login-google', [CustomerLoginController::class, 'redirectToGoogle'])->name('customer.login.google');
Route::get('/customer-login-google/callback', [CustomerLoginController::class, 'handleGoogleCallback']);

Route::get('/customer-login-facebook', [CustomerLoginController::class, 'redirectToFacebook'])->name('customer.login.facebook');
Route::get('/customer-login-facebook/callback', [CustomerLoginController::class, 'handleFacebookCallback']);

Route::middleware('customer')->group(function () {
    //wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
    Route::get('/wishlist/add/{product_id}', [WishlistController::class, 'addToWishlist'])->name('add.to.wishlist');
    Route::post('/wishlist/remove', [WishlistController::class, 'removeFromWishlist'])->name('remove.from.wishlist');

    //cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::match(['get', 'post'], '/cart/add/{product_id}', [CartController::class, 'addToCart'])->name('add.to.cart');
    Route::get('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
    Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('remove.from.cart');
    Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
    Route::match(['put', 'patch'], '/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('update.cart.quantity');
    //checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'applyCoupon'])->name('cart.applyCoupon');
    Route::post('/checkout-submit', [CheckoutController::class, 'checkoutSubmit'])->name('checkout_submit');
    Route::post('/charge-momo',  [CheckoutController::class, 'chargeMomo'])->name('charge-momo');
    Route::post('/charge-vnpay', [CheckoutController::class, 'chargeVnpay'])->name('charge-vnpay');
    Route::get('/thanh-toan-vnpay-thanh-cong', [CheckoutController::class, 'result_vnpay'])->name('success_vnpay');
    Route::get('/checkout-success', [CheckoutController::class, 'checkoutSuccess'])->name('checkout-success');



});
