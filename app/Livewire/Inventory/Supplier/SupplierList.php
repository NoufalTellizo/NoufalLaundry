<?php

namespace App\Livewire\Inventory\Supplier;

use App\Models\Supplier;
use Livewire\Component;

class SupplierList extends Component
{
    public $name, $phone, $tax_number, $opening_balance, $email, $address,$is_active = true, $supplier, $suppliers;
    public function render()
    {
        $this->suppliers = Supplier::latest()->get();
        return view('livewire.inventory.supplier.supplier-list');
    }
    public function resetInputFields()
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
    public function save()
    {
        $this->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        if($this->supplier){
            $supplier = $this->supplier;
        }else{
            $supplier = new Supplier();
        }

        $supplier->name = $this->name;
        $supplier->phone = $this->phone;
        $supplier->tax_number = $this->tax_number;
        $supplier->opening_balance = $this->opening_balance;
        $supplier->email = $this->email;
        $supplier->address = $this->address;
        $supplier->is_active = $this->is_active == 1 ? true:false;
        $supplier->save();
        $this->resetInputFields();
        $this->dispatch('closemodal');
        $this->dispatch(
            'alert',
            ['type' => 'success',  'message' => 'Product  has been created!']
        );
    }
    public function delete($id)
    {
        $supplier = Supplier::whereId($id)->first();
        if(!$supplier){
            return;
        }
        $supplier->delete();
    }
    public function edit($id){
        $this->supplier = Supplier::whereId($id)->first();
        $this->name = $this->supplier->name;
        $this->phone = $this->supplier->phone;
        $this->tax_number = $this->supplier->tax_number;
        $this->opening_balance = $this->supplier->opening_balance;
        $this->email = $this->supplier->email;
        $this->address = $this->supplier->address;
        $this->is_active = $this->supplier->is_active == 1 ? true:false;
        $this->resetErrorBag();
    }
}
