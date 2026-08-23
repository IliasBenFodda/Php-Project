<?php

require __DIR__ . '/auth.php';

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::get('/contact', function () {return view('contact.index');})->name('contact');

Route::get('/dashboard', function () {return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource('users', UserController::class);

        Route::patch('/users/{user}/change-role', [UserController::class, 'changeRole'])
            ->name('users.changeRole');
        Route::get('admin/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');


        Route::get('/faq/create', [FaqController::class, 'create'])->name('faq.create');
        Route::post('/faq', [FaqController::class, 'store'])->name('faq.store');
        Route::get('/faq/{faq}/edit', [FaqController::class, 'edit'])->name('faq.edit');
        Route::put('/faq/{faq}', [FaqController::class, 'update'])->name('faq.update');
        Route::delete('/faq/{faq}', [FaqController::class, 'destroy'])->name('faq.destroy');

        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });

    Route::get('/',[ProductController::class,'index'])->name('home');
    Route::get('/products',[ProductController::class,'index'])->name('products.index');
    Route::get('/products/{product}',[ProductController::class,'show'])->name('products.show');

    Route::middleware(['auth', 'user'])->group(function () {
        Route::get('/cart',[CartController::class,'index'])->name('cart.index');
        Route::post('/cart/{product}',[CartController::class,'add'])->name('cart.add');
        Route::patch('/cart/{product}',[CartController::class,'update'])->name('cart.update');
        Route::delete('/cart/{product}',[CartController::class,'remove'])->name('cart.remove');

        Route::post('/checkout',[CartController::class,'checkout'])->name('cart.checkout');
    });

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/admin/products/create',[ProductController::class,'create'])->name('admin.products.create');
        Route::post('/admin/products',[ProductController::class,'store'])->name('admin.products.store');
        Route::get('/admin/products/{product}/edit',[ProductController::class,'edit'])->name('admin.products.edit');
        Route::put('/admin/products/{product}',[ProductController::class,'update'])->name('admin.products.update');
        Route::delete('/admin/products/{product}',[ProductController::class,'destroy'])->name('admin.products.destroy');

        Route::get('/admin/orders',[OrderController::class,'index'])->name('admin.orders.index');
        Route::get('/admin/orders/{order}',[OrderController::class,'show'])->name('admin.orders.show');
        Route::patch('/admin/orders/{order}/status',[OrderController::class,'updateStatus'])->name('admin.orders.updateStatus');
    });
