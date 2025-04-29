<?php

namespace App\Livewire\Inventory\Products;

use App\Models\ProductNewThree;
use Livewire\Component;

class ProductsListFour extends Component
{
    public $products, $search = '', $active_filter = 'Yes', $name, $description ,$latest_product ,$latest_filter = true;
    public function render()
    {
        $query = ProductNewThree::where('is_active', $this->active_filter == 'Yes' ? 1:0);
        if($this->search != ''){
            $query->where('name','like','%'.$this->search.'%');
        }
        if($this->latest_filter == true){
            $query->latest();
        }
        $this->products = $query->orderBy('name','ASC')->get();
        return view('livewire.inventory.products.products-list-four');
    }
    public function mount()
    {
        $this->latest_product = ProductNewThree::latest()->first();
    }
    public function save()
    {
        $this->validate([
            'name' => 'required|min:5',
        ]);
        $product = new ProductNewThree();
        $product->latest_product_id = $this->latest_product->id ?? null;
        $product->name = $this->name;
        $product->description = $this->description;
        $product->save();
    }
}
