<?php

namespace App\Livewire\Inventory\Supplier;

use App\Models\SupplierNew;
use Livewire\Component;

class SupplierListTwo extends Component
{
    public $name, $phone, $tax_number, $opening_balance, $email, $address, $is_active = true, $supplier, $suppliers;
    public function render()
    {
        $this->suppliers = SupplierNew::latest()->get();
        return view('livewire.inventory.supplier.supplier-list-two');
    }
    public function resetFields()
    {
        $this->name = '';
        $this->phone = '';
        $this->tax_number = '';
        $this->opening_balance = null;
        $this->email = '';
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
            'opening_balance' => 'nullable|numeric|min:0'
        ]);
        $supplier = new SupplierNew();

        if ($this->supplier) {
            $supplier = $this->supplier;
            $this->dispatch('notify', [
                'type' => 'success',
                'title' => 'Success',
                'message' => 'Supplier has been updated!'
            ]);
        } else {
            $this->dispatch('notify', [
                'type' => 'success',
                'title' => 'Success',
                'message' => 'Supplier has been created!'
            ]);
        }
        $supplier->name = $this->name;
        $supplier->phone = $this->phone;
        $supplier->tax_number = $this->tax_number;
        $supplier->opening_balance = $this->opening_balance;
        $supplier->email = $this->email;
        $supplier->address = $this->address;
        $supplier->is_active = $this->is_active;
        $supplier->save();
        $this->dispatch('closemodal');
    }
    public function edit($id)
    {
        $this->supplier = SupplierNew::whereId($id)->first();
        $this->name = $this->supplier->name;
        $this->phone = $this->supplier->phone;
        $this->tax_number = $this->supplier->tax_number;
        $this->opening_balance = $this->supplier->opening_balance;
        $this->email = $this->supplier->email;
        $this->address = $this->supplier->address;
        $this->is_active = $this->supplier->is_active == 1 ? true : false;
        $this->resetErrorBag();
    }
    public function delete($id)
    {
        $this->supplier = null;
        SupplierNew::whereId($id)->delete();
        $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Supplier has been deleted!'
        ]);
    }
}
