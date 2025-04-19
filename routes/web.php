<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Dashboard::class)->name('dashboard');

Route::group(['prefix' => 'inventory/'], function () {
    Route::get('/products', \App\Livewire\Inventory\Products\ProductList::class)->name('inventory.products');
    Route::get('/categories', \App\Livewire\Inventory\Categories\CategoryList::class)->name('inventory.categories');
    Route::get('/units', \App\Livewire\Inventory\Units\UnitList::class)->name('inventory.units');
    Route::get('/suppliers', \App\Livewire\Inventory\Supplier\SupplierList::class)->name('inventory.suppliers');
    Route::get('/purchase', \App\Livewire\Inventory\Purchase\PurchaseList::class)->name('inventory.purchase.list');
    Route::get('/purchase-manage', \App\Livewire\Inventory\Purchase\PurchaseManage::class)->name('inventory.purchase.manage');
});
