<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ColorController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Livewire\Backend\Brand\Index as BrandIndex;
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [FrontendController::class, 'index'])->name('index');
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
    Route::post('product/color/update/{id}', [ProductController::class, 'updateColorQuantity'])->name('product.color.update');
    Route::post('product/color/delete/{id}', [ProductController::class, 'deleteColorQuantity'])->name('product.color.delete');


    //color
    Route::get('color', [ColorController::class, 'index'])->name('color.index');
    Route::get('color/create', [ColorController::class, 'create'])->name('color.create');
    Route::post('color', [ColorController::class, 'store'])->name('color.store');
    Route::get('color/{color}/edit', [ColorController::class, 'edit'])->name('color.edit');
    Route::put('color/{color}', [ColorController::class, 'update'])->name('color.update');
    Route::delete('color/{color}', [ColorController::class, 'destroy'])->name('color.destroy');

    //slider
    Route::get('slider', [SliderController::class, 'index'])->name('slider.index');
    Route::get('slider/create', [SliderController::class, 'create'])->name('slider.create');
    Route::post('slider', [SliderController::class, 'store'])->name('slider.store');
    Route::get('slider/{slider}/edit', [SliderController::class, 'edit'])->name('slider.edit');
    Route::put('slider/{slider}', [SliderController::class, 'update'])->name('slider.update');
    Route::delete('slider/{slider}', [SliderController::class, 'destroy'])->name('slider.destroy');

});
 