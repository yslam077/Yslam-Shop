<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminUsersController;

Route::post('/admin/login-process', [AdminAuthController::class, 'login'])->name('admin.login.process');


Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


Route::middleware(['admin.auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('products', AdminProductController::class);
    Route::get('/users', [AdminUsersController::class, 'index'])->name('users.index');
    Route::delete('/users/{id}', [AdminUsersController::class, 'destroy'])->name('users.destroy');
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
});