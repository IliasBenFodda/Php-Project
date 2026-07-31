<?php

require __DIR__ . '/auth.php';

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
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
Route::get('/contact', function () {
    return view('contact.index');
})->name('contact');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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

    Route::middleware('auth')->group(function () {
        Route::get('/cart',[CartController::class,'index'])->name('cart.index');
        Route::post('/cart/{product}',[CartController::class,'add'])->name('cart.add');
        Route::patch('/cart',[CartController::class,'update'])->name('cart.update');
        Route::delete('/cart',[CartController::class,'remove'])->name('cart.remove');
    });
