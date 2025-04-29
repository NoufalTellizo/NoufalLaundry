<?php

namespace App\Livewire\Inventory\Supplier;

use App\Models\SupplierNewThree;
use Livewire\Component;

class SupplierListFour extends Component
{
    public $name, $phone, $email, $tax_number, $opening_balance, $address, $is_active = true, $supplier, $suppliers;
    public function render()
    {
        $this->suppliers = SupplierNewThree::latest()->get();
        return view('livewire.inventory.supplier.supplier-list-four');
    }
    public function resetFields()
    {
        $this->name = '';
        $this->phone = '';
        $this->email = '';
        $this->tax_number = '';
        $this->opening_balance = '';
        $this->address = '';
        $this->is_active = true;
        $this->supplier = null;
        $this->resetErrorBag();
    }
    public function save()
    {
        $this->validate([
            'name' => $this->supplier ? 'required|unique:supplier_new_threes,name'. $this->supplier->id : 'required|unique:supplier_new_threes,name',
            'phone' => 'required|numeric',
            'opening_balance' => 'nullable|numeric|min:0',
        ]);
        $supplier = new SupplierNewThree();
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
        $this->resetFields();
        $this->dispatch('closemodal');
        $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Success',
            'message' => $this->supplier ? 'Supplier has been created!' : 'Supplier has been updated!'
        ]);
    }
    public function edit($id)
    {
        $this->supplier = SupplierNewThree::whereId($id)->first();
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
        SupplierNewThree::whereId($id)->delete();
        $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Supplier has been deleted!'
        ]);
        $this->supplier = null;
    }
}
