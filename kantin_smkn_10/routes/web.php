<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // Products - Public
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');
    
    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
    
    // Cart routes
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add/{product}', [CartController::class, 'add'])->name('add');
        Route::put('/update/{cart}', [CartController::class, 'update'])->name('update');
        Route::delete('/remove/{cart}', [CartController::class, 'remove'])->name('remove');
        Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
    });
    
    // Order routes
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/{order}', [OrderController::class, 'show'])->name('show');
        Route::post('/{order}/cancel', [OrderController::class, 'cancel'])->name('cancel');
    });
    
    // Admin routes
    Route::middleware(['role:admin'])->group(function () {
        // Admin dashboard
        Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
        
        // Product management
        Route::resource('/admin/products', ProductController::class)->except(['index', 'show']);
        
        // Category management
        Route::resource('/admin/categories', CategoryController::class)->except(['index', 'show']);
        
        // Order management
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/orders', [OrderController::class, 'adminIndex'])->name('orders.index');
            Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
        });
        
        // Transaction management
        Route::resource('/admin/transactions', TransactionController::class);
        
        // User management
        Route::get('/admin/users', [DashboardController::class, 'users'])->name('admin.users');
        Route::put('/admin/users/{user}/role', [DashboardController::class, 'updateRole'])->name('admin.users.update-role');
    });
    
    // Cashier routes
    Route::middleware(['role:cashier'])->group(function () {
        // Cashier dashboard
        Route::get('/cashier/dashboard', [DashboardController::class, 'cashier'])->name('cashier.dashboard');
        
        // Quick order
        Route::get('/cashier/quick-order', [OrderController::class, 'quickOrder'])->name('cashier.quick-order');
        Route::post('/cashier/quick-order/process', [OrderController::class, 'processQuickOrder'])->name('cashier.quick-order.process');
        
        // Order processing
        Route::prefix('cashier')->name('cashier.')->group(function () {
            Route::get('/orders', [OrderController::class, 'cashierIndex'])->name('orders.index');
            Route::post('/orders/{order}/complete', [OrderController::class, 'complete'])->name('orders.complete');
            Route::post('/orders/{order}/process', [OrderController::class, 'process'])->name('orders.process');
        });
        
        // Transaction processing
        Route::prefix('cashier')->name('cashier.')->group(function () {
            Route::post('/transactions/process/{order}', [TransactionController::class, 'process'])->name('transactions.process');
        });
    });
    
    // Customer routes
    Route::middleware(['role:customer'])->group(function () {
        // Customer dashboard
        Route::get('/customer/dashboard', [DashboardController::class, 'customer'])->name('customer.dashboard');
    });
});