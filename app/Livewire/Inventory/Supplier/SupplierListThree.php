<?php

namespace App\Livewire\Inventory\Supplier;

use App\Models\SupplierNewTwo;
use Livewire\Component;

class SupplierListThree extends Component
{
    public $name, $phone, $email, $tax_number, $opening_balance, $address, $is_active = true, $supplier, $suppliers;
    public function render()
    {
        $this->suppliers = SupplierNewTwo::latest()->get();
        return view('livewire.inventory.supplier.supplier-list-three');
    }
    public function resetFields()
    {
        $this->name = '';
        $this->phone = '';
        $this->email = '';
        $this->tax_number = '';
        $this->opening_balance = null;
        $this->address = '';
        $this->is_active = true;
        $this->supplier = null;
        $this->resetErrorBag();
    }
    public function save()
    {
        $this->validate([
            'name' => 'required',
            'phone' => 'required',
            'opening_balance' => 'nullable|numeric|min:0',
        ]);

        $supplier = new SupplierNewTwo();
        if($this->supplier)
        {
            $supplier = $this->supplier;
        }
       
        $supplier->name = $this->name;
        $supplier->phone = $this->phone;
        $supplier->email = $this->email;
        $supplier->tax_number = $this->tax_number;
        $supplier->opening_balance = $this->opening_balance;
        $supplier->address = $this->address;
        $supplier->is_active = $this->is_active;
        $supplier->save();
        $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Success',
            'message' => $this->supplier ? 'Supplier has been updated!' : 'Supplier has been created'
        ]);
        $this->dispatch('closemodal');
    }
    public function edit($id)
    {
        $this->supplier = SupplierNewTwo::whereId($id)->first();
        $this->name = $this->supplier->name;
        $this->phone = $this->supplier->phone;
        $this->email = $this->supplier->email;
        $this->tax_number = $this->supplier->tax_number;
        $this->opening_balance = $this->supplier->opening_balance;
        $this->address = $this->supplier->address;
        $this->is_active = $this->supplier->is_active == 1? true:false;
        $this->resetErrorBag();
    }
    public function delete($id)
    {
        SupplierNewTwo::whereId($id)->delete();
        $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Supplier has been deleted!'
        ]);
        $this->supplier = null;
    }
}
