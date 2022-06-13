<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', [ProductController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/cart', [CartController::class,'index'])->middleware(['auth', 'verified'])->name('cart');
Route::post('/product-store', [CartController::class, 'store'])->middleware(['auth', 'verified'])->name('productStore');
Route::post('/product-remove', [CartController::class, 'remove'])->middleware(['auth', 'verified'])->name('productRemove');
Route::post('/add-number', [CartController::class, 'add'])->middleware(['auth', 'verified'])->name('addNumber');

require __DIR__.'/auth.php';
