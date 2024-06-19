<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/create', [ProductController::class,'create'])->name('product.create');
Route::post('/products', [ProductController::class,'store'])->name('product.store');
Route::get('/products/{id}/edit', [ProductController::class,'edit'])->name('product.edit');
Route::put('/product/{id}', [ProductController::class,'update'])->name('product.update');
Route::delete('/products/{id}', [ProductController::class,'delete'])->name('product.delete');
