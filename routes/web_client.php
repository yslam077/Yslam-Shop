<?php

use App\Http\Controllers\Client\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\CategoryController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\SearchController;

Route::get('locale/{locale}', [HomeController::class, 'locale'])->name('locale')->where('locale', '[a-z]+');
Route::get('/',[HomeController::class,'index'])->name('home.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
