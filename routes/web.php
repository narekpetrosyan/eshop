<?php

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Auth::routes([
    'confirm' => false,
    'reset' => false,
    'verify' => false,
]);

Route::middleware('auth')->group(function (){
    Route::prefix('person')->namespace('Person')->as('person.')->group(function (){
        Route::get('/', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/{id}', [OrderController::class, 'show'])->name('orders.show');
    });



    Route::namespace('Admin')->prefix('admin')->group(function () {
        Route::middleware('is_admin')->prefix('orders')->group(function (){
            Route::get('/', [OrderController::class, 'index'])->name('home');
            Route::get('/{id}', [OrderController::class, 'show'])->name('orders.show');
        });

        Route::prefix('categories')->group(function (){
            Route::get('/',[CategoryController::class,'index'])->name('categories.index');
            Route::get('/create',[CategoryController::class,'create'])->name('categories.create');
            Route::post('/store',[CategoryController::class,'store'])->name('categories.store');
            Route::get('/{code}',[CategoryController::class,'show'])->name('categories.show');
            Route::put('/update/{id}',[CategoryController::class,'update'])->name('categories.update');
            Route::get('/edit/{code}',[CategoryController::class,'edit'])->name('categories.edit');
            Route::delete('/destroy/{id}',[CategoryController::class,'destroy'])->name('categories.destroy');
        });

        Route::prefix('products')->group(function (){
            Route::get('/',[ProductController::class,'index'])->name('products.index');
            Route::get('/create',[ProductController::class,'create'])->name('products.create');
            Route::post('/store',[ProductController::class,'store'])->name('products.store');
            Route::get('/{code}',[ProductController::class,'show'])->name('products.show');
            Route::put('/update/{id}',[ProductController::class,'update'])->name('products.update');
            Route::get('/edit/{code}',[ProductController::class,'edit'])->name('products.edit');
            Route::delete('/destroy/{id}',[ProductController::class,'destroy'])->name('products.destroy');
        });
    });
});





Route::prefix('basket')->group(function (){
    Route::post('/add/{id}', [BasketController::class, 'add'])->name('basket-add');

    Route::middleware('basket_not_empty')->group(function (){
        Route::get('/', [BasketController::class, 'basket'])->name('basket');
        Route::get('/place', [BasketController::class, 'place'])->name('basket-place');
        Route::post('/place', [BasketController::class, 'confirm'])->name('basket-confirm');
        Route::post('/remove/{id}', [BasketController::class, 'remove'])->name('basket-remove');
    });
});






Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/categories', [MainController::class, 'categories'])->name('categories');
Route::get('/{category}', [MainController::class, 'category'])->name('category');
Route::get('/{category}/{product?}', [MainController::class, 'product'])->name('product');


