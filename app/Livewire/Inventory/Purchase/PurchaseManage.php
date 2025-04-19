<?php

namespace App\Livewire\Inventory\Purchase;

use App\Models\Product;
use App\Models\Supplier;
use Livewire\Component;

class PurchaseManage extends Component
{
    public $search_suppliers = '', $filtered_suppliers = [], $selected_supplier = null;
    public $search_products = '', $filtered_products = [], $selected_product = null, $cart = [];
    public $name, $phone, $tax_number, $opening_balance, $email, $address, $is_active = true;
    public $sub_total, $discount, $taxable_amount, $tax_amount, $gross_total, $cart_data, $tax_rate, $paid_amount;
    public function render()
    {
        return view('livewire.inventory.purchase.purchase-manage');
    }

    public function mount()
    {
        $this->tax_rate = 2;
    }
    public function resetSupplierInputFields()
    {
        $this->name = '';
        $this->phone = '';
        $this->tax_number = '';
        $this->opening_balance = '';
        $this->email = '';
        $this->address = '';
        $this->is_active = true;
        $this->resetErrorBag();
    }

    public function updatedSearchSuppliers($value)
    {
        if ($value == '') {
            $this->filtered_suppliers = [];
            return;
        } else {
            $this->filtered_suppliers = Supplier::where('is_active', 1)->where('name', 'like', '%' . $this->search_suppliers . '%')->get();
        }
    }

    public function select_supplier($id)
    {
        $this->selected_supplier = Supplier::where('id', $id)->first();
        $this->search_suppliers = '';
        $this->filtered_suppliers = [];
    }

    public function updatedSearchProducts($value)
    {
        if ($value == '') {
            $this->filtered_products = [];
            return;
        } else {
            $this->filtered_products = Product::where('is_active', 1)->where('name', 'like', '%' . $this->search_products . '%')->get();
        }
    }
    public function select_product($id)
    {
        $product = Product::where('id', $id)->first();
        $this->search_products = '';
        $this->filtered_products = [];
        $purchase_price = $product->purchase_price;
        $product_index = null;
        foreach ($this->cart as $index => $item) {
            if ($item['product']['id'] == $id) {
                $product_index = $index;
            }
        }
        if ($product_index !== null) {
            $this->cart[$product_index]['quantity'] = $this->cart[$product_index]['quantity'] + 1;
            return;
        }
        $item = [
            'product' => $product,
            'quantity' => 1,
            'rate' => $purchase_price,
            'unit_price' => $purchase_price,
            'discount' => 0,
            'tax' => 0,
            'tax_amount' => 0,
            'total' => $purchase_price,
        ];
        $this->cart[] = $item;
        $this->calculateTotal();
    }
    public function save()
    {
        $this->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        $supplier = new Supplier();
        $supplier->name = $this->name;
        $supplier->phone = $this->phone;
        $supplier->tax_number = $this->tax_number;
        $supplier->opening_balance = $this->opening_balance;
        $supplier->email = $this->email;
        $supplier->address = $this->address;
        $supplier->is_active = $this->is_active == 1 ? true : false;
        $supplier->save();
        $this->resetInputFields();
        $this->dispatch('closemodal');
        $this->dispatch(
            'alert',
            ['type' => 'success',  'message' => 'Product  has been created!']
        );
    }
    public function calculateTotal()
    {
        $this->cart_data = [];
        $this->cart_data['sub_total'] = 0;
        $this->cart_data['discount'] = 0;
        $this->cart_data['taxable_amount'] = 0;
        $this->cart_data['tax_amount'] = 0;
        $this->cart_data['total'] = 0;
        $tax_type = 2;
        foreach($this->cart as $index => $item)
        {
            if($tax_type == 2)
            {
                $gross_total_amount = (float)$item['rate'] * (float)$item['quantity'];
                $unit_amount = $gross_total_amount * (100/ (100 + $this->tax_rate ?? 0));
                $item_tax = $gross_total_amount - $unit_amount;
                $item_total = $gross_total_amount - (float)$item['discount'];

                $this->cart_data['sub_total'] += $gross_total_amount;
                $this->cart_data['tax_amount'] += $item_tax;
                $this->cart_data['total'] += $item_total;
                $this->cart_data['discount'] += (float)$item['discount'];

                $this->cart[$index]['total'] = $item_total;
                $this->cart[$index]['tax_amount'] = $item_tax;
                $this->cart[$index]['taxable_amount'] = $unit_amount;
            }
            else
            {
                
            }
        }
        $this->paid_amount = $this->cart_data['total'];
    }
    // public function savePurchase()
    // {
    //     if(!$this->selected_supplier && empty())
    // }
}
