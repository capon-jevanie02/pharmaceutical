<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\HomeController;

// Public Routes
Route::get('/', function () {
    return view('auth.login');
})->name('login');

// Authentication Routes
Auth::routes();

// Protected Routes: Requires User to Be Logged In
Route::middleware(['auth'])->group(function () {
    // Home Route
   

   Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

    // Product Routes
   

    Route::get('/views', [ProductController::class, 'index'])->name('products.index');
    Route::get('cart', [ProductController::class, 'cart'])->name('cart');
    Route::get('add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add.to.cart');
    Route::patch('update-cart', [ProductController::class, 'update'])->name('update.cart');
    Route::delete('remove-from-cart', [ProductController::class, 'remove'])->name('remove.from.cart');

    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('products', [ProductController::class, 'store'])->name('products.store');

    // Table Routes
    Route::get('/table', [TableController::class, 'index'])->name('admin.table');

    // Admin Section: Protect further with Role Middleware (if needed)
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin', [HomeController::class, 'index'])->name('admin');
        Route::get('/create.blade', [HomeController::class, 'index'])->name('create.blade');
    });


});
