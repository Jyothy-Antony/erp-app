<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

Route::prefix('admin')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::prefix('supplier')->group(function () {
    Route::get('index', [SupplierController::class, 'index'])->name('supplier.index');
    Route::get('add', [SupplierController::class, 'add'])->name('supplier.add');
    Route::post('store', [SupplierController::class, 'store'])->name('supplier.store');
});

Route::prefix('item')->group(function () {
    Route::get('index', [ItemController::class, 'index'])->name('item.index');
    Route::get('add', [ItemController::class, 'add'])->name('item.add');
    Route::post('store', [ItemController::class, 'store'])->name('item.store');
    Route::get('show/{id}',[ItemController::class, 'show'])->name('item.show');
});

Route::prefix('purchase')->group(function () {
    Route::get('index', [PurchaseController::class, 'index'])->name('purchase.index');
    Route::get('add', [PurchaseController::class, 'add'])->name('purchase.add');
    Route::post('store', [PurchaseController::class, 'store'])->name('purchase.store');
    Route::get('view/{id}',[PurchaseController::class, 'view'])->name('purchase.view');
});
