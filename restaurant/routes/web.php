<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Front\MenuController;
use App\Http\Controllers\Front\ReservationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChefController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AdminReservationController;
use App\Http\Controllers\Admin\KitchenController;
use App\Http\Controllers\Admin\CommandeController;
use App\Http\Controllers\Admin\SettingesController;

use App\Http\Controllers\Front\OrderController;

// Language switch route (with language middleware)
Route::middleware(['language'])->get('/language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');

// Apply language middleware to all client routes
Route::middleware(['language'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
    Route::get('/reservation', [ReservationController::class, 'index'])->name('reservation.index');
    Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');
    Route::get('/order/product', [OrderController::class, 'getProduct'])->name('order.getProduct');
    Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('order.place');
    Route::get('/cart', [OrderController::class, 'getCart'])->name('cart.get');
    Route::post('/cart/add', [OrderController::class, 'addToCart'])->name('cart.add');
    Route::put('/cart/update', [OrderController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/remove/{productId}', [OrderController::class, 'removeFromCart'])->name('cart.remove');
    Route::delete('/cart/clear', [OrderController::class, 'clearCart'])->name('cart.clear');
    Route::get('/commande', [OrderController::class, 'get'])->name('commande');
});

// --- (Admin Side) - No language middleware ---
Route::prefix('admin')->middleware(['language'])->group(function () {
    Route::get('/login', [DashboardController::class, 'login'])->name('admin.Register-Login.login');
    Route::post('/login', [DashboardController::class, 'postLogin'])->name('postLogin');
    Route::get('/register', [DashboardController::class, 'register'])->name('admin.Register-Login.register');
    Route::post('/register', [DashboardController::class, 'postRegister'])->name('postRegister');
    Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('categories', CategoryController::class)->names('admin.categories');
    Route::resource('products', ProductController::class)->names('admin.products');
    Route::resource('gallery', GalleryController::class)->names('admin.gallery');
    Route::resource('chef', ChefController::class)->names('admin.chef');

    Route::resource('reservations', AdminReservationController::class)->names('admin.reservations');
    Route::patch('reservations/{id}', [AdminReservationController::class, 'update'])->name('admin.reservations.update');

    Route::get('/commandes', [CommandeController::class, 'index'])->name('admin.commandes.index');
    Route::patch('/commandes/{id}/status', [CommandeController::class, 'updateStatus'])->name('admin.commandes.updateStatus');
    Route::patch('/commandes/{id}/delivered', [CommandeController::class, 'markDelivered'])->name('admin.commandes.delivered');
    Route::delete('/commandes/{id}', [CommandeController::class, 'destroy'])->name('admin.commandes.destroy');

    Route::get('/kitchen', [KitchenController::class, 'index'])->name('admin.kitchen.index');
    Route::patch('/kitchen/{id}', [KitchenController::class, 'updateStatus'])->name('admin.kitchen.update');
    Route::patch('/kitchen/{id}/status', [KitchenController::class, 'updateStatus'])->name('admin.kitchen.updateStatus');

    Route::get('/settings', [SettingesController::class, 'index'])->name('admin.settings.index');
    Route::put('/settings', [SettingesController::class, 'update'])->name('admin.settings.update');
});
