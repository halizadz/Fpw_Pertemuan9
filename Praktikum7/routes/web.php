<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Route untuk halaman index product (dengan search & pagination)
    Route::get('/product', [ProductController::class, 'index'])->name('product-index');
    
    // Route untuk halaman create product
    Route::get('/product/create', [ProductController::class, 'create'])->name('product-create');
    
    // Route untuk store product
    Route::post('/product/store', [ProductController::class, 'store'])->name('product-store');
    
    // Route untuk halaman edit product
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product-edit');
    
    // Route untuk update product
    Route::put('/product/{id}/update', [ProductController::class, 'update'])->name('product-update');
    
    // Route untuk delete product
    Route::delete('/product/{id}/delete', [ProductController::class, 'destroy'])->name('product-delete');
    
    // Route untuk halaman detail product (harus di bawah routes lain yang lebih spesifik)
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product-detail');
});

require __DIR__ . '/auth.php';