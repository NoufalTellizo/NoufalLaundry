<?php

namespace App\Livewire\Inventory\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ProductList extends Component
{
    public $name, $unit_id, $category_id, $sku, $purchase_price, $opening_stock, $minimum_stock_level, $description, $is_consumable = true, $is_active = true, $product, $products, $categories, $units;
    public function render()
    {
        $this->categories = Category::where('is_active', 1)->latest()->get();
        $this->units = Unit::where('is_active', 1)->latest()->get();
        $this->products = Product::latest()->get();
        return view('livewire.inventory.products.product-list');
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->unit_id = '';
        $this->category_id = '';
        $this->purchase_price = '';
        $this->sku = '';
        $this->opening_stock = '';
        $this->minimum_stock_level = '';
        $this->description = '';
        $this->is_consumable = true;
        $this->is_active = true;
        $this->product = null;
        $this->resetErrorBag();
    }
    public function save()
    {
        $this->validate([
            'name' => 'required',
            'unit_id' => 'required',
            'category_id' => 'required',
            'purchase_price' => 'required',
        ]);

        if ($this->product) {
            $product = $this->product;
            $this->validate([
                'sku' => 'required|unique:products,sku,' . $this->product->id,
            ]);
            $this->dispatch('notify', [
                'type' => 'success',
                'title' => 'Success',
                'message' => 'Unit has been updated!'
            ]);
        } else {
            $product = new Product();
            $this->validate(['sku'=>'required|unique:products,sku']);
            $this->dispatch('notify', [
                'type' => 'success',
                'title' => 'Success',
                'message' => 'Product has been saved!'
            ]);
        }

        $product->name = $this->name;
        $product->category_id = $this->category_id;
        $product->unit_id = $this->unit_id;
        $product->sku = $this->sku;
        $product->purchase_price = $this->purchase_price;
        $product->opening_stock = $this->opening_stock;
        $product->minimum_stock_level = $this->minimum_stock_level;
        $product->description = $this->description;
        $product->is_consumable = $this->is_consumable == 1 ? true : false;
        $product->is_active = $this->is_active == 1 ? true : false;
        $product->save();
        $this->resetInputFields();
        $this->dispatch('closemodal');
        
    }
    public function delete($id)
    {
        $product = Product::whereId($id)->first();
        if (!$product) {
            return;
        }
        $product->delete();
        $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Product has been deleted!'
        ]);
    }
    public function edit($id)
    {
        $this->product = Product::whereId($id)->first();
        $this->name = $this->product->name;
        $this->category_id = $this->product->category_id;
        $this->unit_id = $this->product->unit_id;
        $this->sku = $this->product->sku;
        $this->purchase_price = $this->product->purchase_price;
        $this->opening_stock = $this->product->opening_stock;
        $this->minimum_stock_level = $this->product->minimum_stock_level;
        $this->description = $this->product->description;
        $this->is_active = $this->product->is_active == 1 ? true : false;
        $this->resetErrorBag();
    }
}
