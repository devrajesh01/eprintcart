<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;


Route::get('/',[HomeController::class, 'index'])->name('home');
Route::get('register',[RegisterController::class ,'showRegisterForm' ])->name('register');
Route::get('login',[RegisterController::class ,'showLoginForm' ])->name('login');
