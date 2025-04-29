<?php

use App\Http\Controllers\SampleController;
use App\Http\Controllers\TestController;
use App\Livewire\Inventory\Categories\CategoryListTwo;
use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Dashboard::class)->name('dashboard');



Route::group(['prefix' => 'inventory/'], function () {
    Route::get('/products', \App\Livewire\Inventory\Products\ProductList::class)->name('inventory.products');
    Route::get('/products_two', \App\Livewire\Inventory\Product\ProductListTwo::class)->name('inventory.products.two');
    Route::get('/products_three', \App\Livewire\Inventory\Product\ProductListThree::class)->name('inventory.products.three');
    Route::get('/categories', \App\Livewire\Inventory\Categories\CategoryList::class)->name('inventory.categories');
    Route::get('/categories_two', CategoryListTwo::class)->name('inventory.categories.two');
    Route::get('/units', \App\Livewire\Inventory\Units\UnitList::class)->name('inventory.units');
    Route::get('/suppliers', \App\Livewire\Inventory\Supplier\SupplierList::class)->name('inventory.suppliers');
    Route::get('/suppliers_two', \App\Livewire\Inventory\Supplier\SupplierListTwo::class)->name('inventory.suppliers.two');
    Route::get('/suppliers_three', \App\Livewire\Inventory\Supplier\SupplierListThree::class)->name('inventory.suppliers.three');
    Route::get('/suppliers_four', \App\Livewire\Inventory\Supplier\SupplierListFour::class)->name('inventory.suppliers.four');
    Route::get('/purchase', \App\Livewire\Inventory\Purchase\PurchaseList::class)->name('inventory.purchase.list');
    Route::get('/purchase-manage', \App\Livewire\Inventory\Purchase\PurchaseManage::class)->name('inventory.purchase.manage');
});
