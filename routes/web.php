<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Public Routes (No Authentication Required)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('register-data', [RegisterController::class, 'register'])->name('register.store');

Route::get('customer-login', [RegisterController::class, 'showLoginForm'])->name('login');
Route::post('login', [RegisterController::class, 'login'])->name('login-data');

Route::post('logout/', [RegisterController::class, 'logout'])->name('logout');
Route::get('/about-page', [HomeController::class, 'AboutPage'])->name('about.page');
Route::get('/contact-page', [HomeController::class, 'ContactPage'])->name('contact.page');
Route::get('/shop',[HomeController::class, 'showShop'] )->name('shop');
Route::get('/privacy-policy',[HomeController::class, 'showPrivacy'] )->name('privacy.page');
Route::get('/terms-conditions',[HomeController::class, 'showTerms'] )->name('terms.page');

/*
|--------------------------------------------------------------------------
| Customer Routes (Must be logged in + role = customer)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/check-out', [PaymentController::class, 'index'])->name('checkout');
    Route::post('/payment', [PaymentController::class, 'createPayment'])->name('payment.create');
    Route::get('product/{id}', [HomeController::class, 'productPage'])->name('product.page');
    Route::get('/mugdesign', [HomeController::class, 'showMugDesign'])->name('mugdesign');
    Route::get('/order/thankyou/{id}', function(){
        return view('product.thankyou');
    })->name('thankyou');
    Route::get('cart', function(){
        return view('product.cart');
    })->name('add.cart');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Must be logged in + role = admin)
2
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminIndex'])->name('admin.dashboard');
    Route::get('/admin/dashboard/add-product', [AdminController::class, 'AddProductPage'])->name('add.product');
    Route::post('/store-data', [AdminController::class, 'StoreProducts'])->name('products.store');
    Route::get('/admin/dashboard/product-list', [AdminController::class, 'ListProductPage'])->name('list.products');
    Route::get('/admin/dashboard/product-list/edit-product/{id}', [AdminController::class, 'EditProduct'])->name('product.edit');
    Route::put('/admin/dashboard/product-list/update-product/{id}', [AdminController::class, 'UpdateProduct'])->name('product.update');
    Route::delete('/delete-product/{id}', [AdminController::class, 'DeleteProduct'])->name('product.delete');
});
