<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Livewire\Backend\Brand\Index as BrandIndex;
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {

    // Add other admin routes here
     Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');
     //category
     Route::get('category', [CategoryController::class, 'index'])->name('category.index');
     Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
     Route::post('category', [CategoryController::class, 'store'])->name('category.store');
     Route::get('category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
     Route::put('category/{category}', [CategoryController::class, 'update'])->name('category.update');
     Route::delete('category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

        //brand
    Route::get('brand', BrandIndex::class)->name('brand.index');

    //product
    Route::get('product', [ProductController::class, 'index'])->name('product.index');
    Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('product', [ProductController::class, 'store'])->name('product.store');
    Route::get('product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('product/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('product/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('product/image/{image}', [ProductController::class, 'destroyImage'])->name('product.image.destroy');
    

});
 