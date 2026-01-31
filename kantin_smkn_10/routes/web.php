<?php

use App\Livewire\Admin\ProductManager;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('role:administration')->prefix('admin')->group(function(){
    Route::get('/product', ProductManager::class)->name('admin.products');
});
