<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('register', [RegisterController::class ,'showRegisterForm'])->name('register');
Route::post('register-data', [RegisterController::class,'register'])->name('register.store');

Route::get('customer-login', [RegisterController::class ,'showLoginForm'])->name('login');
Route::post('login', [RegisterController::class,'login'])->name('login-data');

Route::get('/admin/dashboard', [AdminController::class, 'AdminIndex'])->name('admin.dashboard');
Route::post('logout/', [RegisterController::class, 'logout'])->name('logout');



Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
Route::post('/payment', [PaymentController::class, 'createPayment'])->name('payment.create');
Route::get('/add-product', [AdminController::class, 'AddProductPage'])->name('add.product');
Route::post('/store-data', [AdminController::class,'StoreProducts'])->name('products.store');
Route::get('/product-list',[AdminController::class,'ListProductPage'])->name('list.products');

Route::get('product/{p_id}', [HomeController::class, 'productPage'])->name('product.page');
