<?php

namespace App\Livewire\Inventory\Product;

use App\Models\Category;
use App\Models\CategoryNew;
use App\Models\ProductNew;
use App\Models\Unit;
use Livewire\Component;

class ProductListTwo extends Component
{
    public $name, $unit_id, $category_id, $sku, $purchase_price, $opening_stock, $description, $is_active = true, $product, $products,$categories,$units;
    public function render()
    {
        $this->products = ProductNew::latest()->get();
        return view('livewire.inventory.product.product-list-two');
    }
    public function mount()
    {
        $this->categories = CategoryNew::latest()->get();
    }
    public function resetFields()
    {
        $this->name = '';
        $this->unit_id = '';
        $this->category_id = '';
        $this->sku = '';
        $this->purchase_price = '';
        $this->opening_stock = '';
        $this->description = '';
        $this->is_active = true;
        $this->product = null;
        $this->resetErrorBag();
    }
    public function save()
    {
        $this->validate([
            'name' => 'required',
            // 'unit_id' => 'required',
            'category_id' => 'required',
            'sku' => $this->product ? 'required|unique:product_news,sku' .$this->product->id : 'required|unique:product_news,sku',
            'purchase_price' => 'required|numeric|min:0',
            'opening_stock' => 'nullable|numeric|min:0'
        ]);

        $product = new ProductNew();

        if($this->product)
        {
            $product = $this->product;
        }

        $product->name = $this->name;
        $product->unit_id = $this->unit_id;
        $product->category_id = $this->category_id;
        $product->sku = $this->sku;
        $product->purchase_price = $this->purchase_price;
        $product->opening_stock = $this->opening_stock;
        $product->description = $this->description;
        $product->is_active = $this->is_active;
        $product->save();
        $this->dispatch('closemodal');
        $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Success',
            'message' => $this->product ? 'Product has been updated!' : 'Product has been created'
        ]);
    }
    public function edit($id)
    {
        $this->product = ProductNew::whereId($id)->first();
        $this->name = $this->product->name;
        $this->unit_id = $this->product->unit_id;
        $this->category_id = $this->product->category_id;
        $this->sku = $this->product->sku;
        $this->purchase_price = $this->product->purchase_price;
        $this->opening_stock = $this->product->opening_stock;
        $this->description = $this->product->description;
        $this->is_active = $this->product->is_active == 1? true:false;
        $this->resetErrorBag();
    }
    public function delete($id)
    {
        ProductNew::whereId($id)->delete();
        $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Product has been deleted!'
        ]);
        $this->product = null;
    }
}
