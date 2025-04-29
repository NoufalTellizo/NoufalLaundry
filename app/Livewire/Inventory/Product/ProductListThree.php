<?php

namespace App\Livewire\Inventory\Product;

use App\Models\CategoryNew;
use App\Models\ProductNew;
use App\Models\ProductNewTwo;
use App\Models\Unit;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Livewire\Component;

use function PHPUnit\Framework\returnSelf;

class ProductListThree extends Component
{
    public $name, $category_id, $sku, $purchase_price, $opening_balance, $description, $is_active = true, $products, $product, $categories, $is_latest = true;
    public $a = true, $b = 8, $c = 0, $array = ["'1' => ['Hello', 'Hai'],'2'=>'John','3'=>'Bobby'"], $array_filter = [], $all_name, $all_is_active, $product_status, $financial_year, $dateFilter, $number_of_items;
    public $toggleCategory = 'all', $filtered_products = [], $units, $toggleUnit, $search = '', $toggleSwitch = 1, $from_date, $to_date, $selectedProducts = [];
    public function render()
    {

        $this->products = ProductNewTwo::where('is_active', $this->toggleSwitch)->get();
        $this->categories = CategoryNew::latest()->get();
        $this->units = Unit::latest()->get();

        // $this->toggleCategory != null ? $this->filtered_products  = ProductNew::where('category_id',$this->toggleCategory) : $this->filtered_products = ProductNew::latest();
        // $query = $this->filtered_products;
        // if($this->search != '')
        // {
        //     $query->where('name','like','%'.$this->search.'%');
        // }
        // $this->filtered_products = $query->get();

        $query = ProductNewTwo::where('is_active', $this->toggleSwitch);

        if ($this->toggleCategory != 'all') {
            $query->where('category_id', $this->toggleCategory);
        }

        if ($this->search != '') {
            $query->where(
                function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhereHas('category',  function ($a) {
                            $a->where('name', 'like', '%' . $this->search . '%');
                        });
                }
            );
        }

        if ($this->from_date != null) {
            $query->whereBetween('created_at', [$this->from_date, $this->to_date]);
        }
        // if($this->is_latest == true){
        //     $query->latest();
        // }

        $this->financial_year = '2025';


        $this->filtered_products = $query->orderBy('name', 'asc')->get();

        // $this->dispatch('notify', [
        //     'type' => $this->a !== false ? 'success' : 'error',
        //     'title' => $this->a !== false ? 'Success' : "Failed",
        //     'message' => $this->a !== false ? 'Product has been created!' : 'Product has been skipped!'
        // ]);


        // switch ($this->a) {
        //     case false:
        //         $this->b = 'My name is Noufal';
        //         break;
        //     case true:
        //         $this->b = 'My name is Issac';
        //         break;
        //     case true:
        //         $this->b = 'My name is Akshay';
        //         break;
        //     default:
        //         $this->b = 'My name is Shiyas';
        // }

        // do{
        //     echo $this->b ='Hello Boy';
        //     $this->c++;
        // }while ($this->b < 6);

        // foreach ($this->array as $x) {
        //     $this->b = $x;
        //     echo $this->b;
        // }

        // foreach ($this->array as $index => $id) {
        //     echo "$index : $id <br>";
        // }

        return view('livewire.inventory.product.product-list-three')->with(['title' => 'Products List']);
    }
    
    public function mount()
    {
        $this->dateFilter = today();
    }

    public function resetFields()
    {
        $this->name = '';
        $this->category_id = '';
        $this->sku = '';
        $this->purchase_price = '';
        $this->opening_balance = '';
        $this->description = '';
        $this->is_active = true;
        $this->product = null;
        $this->resetErrorBag();
    }


    public function deleteSelectedProducts()
    {
        ProductNewTwo::whereIn('id', $this->selectedProducts)->delete();
        $this->selectedProducts = [];
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'category_id' => 'required',
            'sku' => $this->product ? 'required|unique:product_new_twos,sku,' . $this->product->id : 'required|unique:product_new_twos,sku,',
            'purchase_price' => 'required|numeric|min:0',
            'opening_balance' => 'nullable|numeric|min:0'
        ]);
        $product = new ProductNewTwo();
        if ($this->product) {
            $product = $this->product;
        }
        $product->name = $this->name;
        $product->category_id = $this->category_id;
        $product->sku = $this->sku;
        $product->purchase_price = $this->purchase_price;
        $product->opening_balance = $this->opening_balance;
        $product->description = $this->description;
        $product->is_active = $this->is_active;
        $product->save();
        $this->dispatch('closemodal');
        $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Success',
            'message' => $this->product ? 'Product has been updated!' : 'Product has been created!'
        ]);
    }
    public function edit($id)
    {
        $this->product = ProductNewTwo::whereId($id)->first();
        $this->name = $this->product->name;
        $this->category_id = $this->product->category_id;
        $this->sku = $this->product->sku;
        $this->purchase_price = $this->product->purchase_price;
        $this->opening_balance = $this->product->opening_balance;
        $this->description = $this->product->description;
        $this->is_active = $this->product->is_active == 1 ? true : false;
        $this->resetErrorBag();
    }

    public function updateAllName()
    {
        $newName = ProductNewTwo::whereIn('id', $this->selectedProducts)->get();
        foreach ($newName as $issac) {
            if ($this->all_name = '') {
                $issac->name = $this->all_name;
            }
            $issac->is_active = $this->all_is_active;
            $issac->save();
            $this->selectedProducts = [];
        }
        $this->dispatch('closemodal');
    }

    public function changeStatus($id)
    {
        $this->product_status = ProductNewTwo::whereId($id)->first();
        if ($this->product_status) {
            $this->product_status->is_active = $this->product_status->is_active ? 0 : 1;
            $this->product_status->save();
        }
    }
    public function delete($id)
    {
        $delete = ProductNewTwo::whereId($id)->delete();
        if (!$delete)
            $this->dispatch('notify', [
                'type' => 'error',
                'message' =>  'Nothing to delete!'
            ]);
        return;
        $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Success',
            'message' =>  'Product has been deleted!'
        ]);
        $this->product = null;
    }
}
