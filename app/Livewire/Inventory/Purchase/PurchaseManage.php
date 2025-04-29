<?php

namespace App\Livewire\Inventory\Purchase;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\PurchasePayment;
use App\Models\Supplier;
use Carbon\Carbon;
use Livewire\Component;

class PurchaseManage extends Component
{
    public $search_suppliers = '', $filtered_suppliers = [], $selected_supplier = null;
    public $search_products = '', $filtered_products = [], $selected_product = null, $cart = [];
    public $name, $phone, $tax_number, $opening_balance, $email, $address, $is_active = true;
    public $sub_total, $discount, $taxable_amount, $tax_amount, $gross_total, $cart_data, $tax_rate, $paid_amount, $purchase_number,$note,$invoice_number,$invoice_date,$purchase_payment,$payment_method, $purchase,$payment_remark,$purchase_details;
    public function render()
    {
        return view('livewire.inventory.purchase.purchase-manage');
    }

    public function mount($id = null)
    {
        if($id)
        {
            $this->purchase_payment = PurchasePayment::where('purchase_id', $id)->first();
            $this->paid_amount = $this->purchase_payment->paid_amount ?? 0;
            $this->payment_method = $this->purchase_payment->payment_method ?? 1;
            $this->note = $this->purchase_payment->note ?? '';
            $this->payment_remark = $this->purchase_payment->payment_remark ?? '';

            $this->purchase = Purchase::where('id', $id)->first();
            $this->search_suppliers = $this->purchase->supplier_name;
            $this->selected_supplier = Supplier::find($this->purchase->supplier_id);
            $this->invoice_date = $this->purchase->invoice_date;
            $this->invoice_number = $this->purchase->invoice_number;

            $this->purchase_details = PurchaseDetail::where('purchase_id', $id)->get();
            $this->cart = [];

            foreach($this->purchase_details as $item) 
            {
                $this->cart[] = [
                    'id' => $item->product_id,
                    'name' => $item->product_name,
                    'qty' => $item->quantity,
                    'rate' => $item->rate,
                    'discount' => $item->disount ?? 0,
                    'tax_amount' => $item->tax_amount ?? 0,
                    'total' => $item->total,
                ];
            }
            $this->purchase_number = $this->purchase->purchase_number;
        }
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
        $this->selected_supplier = $supplier;
        $this->resetSupplierInputFields();
        $this->dispatch('closemodal');
        $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Supplier has been added!'
        ]);
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
    public function savePurchase()
    {
        if(!$this->selected_supplier){
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Please select a valid supplier!'
            ]);
            return;
        }
        foreach($this->cart as $index => $product){
            if(($product['quantity'] ?? 0) <= 0){
                $this->dispatch('notify', [
                    'type' => 'error',
                    'message' => 'Products quantity must be greater than zero!'
                ]);
                return;
            }
            if(($product['quantity'] ?? 0) <= 0){
                $this->dispatch('notify', [
                    'type' => 'error',
                    'message' => 'Products quantity must be greater than zero!'
                ]);
                return;
            }
            if(($product['rate'] ?? 0) <= 0){
                $this->dispatch('notify', [
                    'type' => 'error',
                    'message' => 'Products rate cannot be negative!'
                ]);
                return;
            }
            if(($product['discount']) > $product['rate']){
                $this->dispatch('notify', [
                    'type' => 'error',
                    'message' => 'Cannot give discount more than the rate!'
                ]);
                return;
            }
            if(($product['discount'] ?? 0) < 0){
                $this->dispatch('notify', [
                    'type' => 'error',
                    'message' => 'Discounts cannot be negative!'
                ]);
                return;
            }
            if(($product['total'] ?? 0) < 0){
                $this->dispatch('notify', [
                    'type' => 'error',
                    'message' => 'Item total cannot be negative!'
                ]);
                return;
            }
        }
        if(($this->paid_amount ?? 0) < 0){
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Paid amount cannot be negative!'
            ]);
            return;
        }

        $this->validate([
            'paid_amount' => 'required',
            'payment_method' => 'required',
            'invoice_number' => 'required',
            'invoice_date' => 'required',
        ]);
        if(empty($this->cart)){
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'You must add at least one product to make purchase!'
            ]);
            return;
        }
        if($this->paid_amount > $this->cart_data['total']){
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Paid amount cannot be higher than Total!'
            ]);
            return;
        }
        if($this->purchase){
            $purchase = $this->purchase;
        }
        else{
            $purchase = new Purchase();
        }
        $total_quantity = 0;
        foreach($this->cart as $product)
        {
            $total_quantity = $total_quantity + $product['quantity'];
        }
         
        $last_purchase = Purchase::orderBy('purchase_number', 'desc')->first();
        $this->purchase_number = $last_purchase ? $last_purchase->purchase_number + 1 : 1;

        if($this->purchase)
        {
            $purchase->purchase_number = $this->purchase->purchase_number;
        }
        else
        {
            $purchase->purchase_number = $this->purchase_number;
        }

        $purchase->purchase_date = Carbon::now();
        $purchase->supplier_name = $this->selected_supplier->name;
        $purchase->supplier_id = $this->selected_supplier->id;
        $purchase->discount = $this->tax_rate ?? 0;
        $purchase->discount_total = $this->cart_data['discount'];
        $purchase->invoice_number = $this->invoice_number;
        $purchase->invoice_date = $this->invoice_date;
        $purchase->sub_total = $this->cart_data['sub_total'];
        $purchase->tax_amount = $this->cart_data['tax_amount'];
        $purchase->taxable_amount = $this->cart_data['taxable_amount'];
        $purchase->total = $this->cart_data['total'];
        $purchase->total_quantity = $total_quantity;
        $purchase->note = $this->note;
        $purchase->status = 1;
        $purchase->save();


        if($this->purchase)
        {
            PurchaseDetail::where('purchase_id', $this->purchase->id)->delete();
        }
        foreach($this->cart as $product)
        {
            $item = new PurchaseDetail();
            $item->purchase_id = $purchase->id;
            $item->type = 1;
            $item->quantity = $product['quantity'];
            $item->product_id = $product['product']['id'];
            $item->product_name = $product['product']['name'];
            $item->rate = $product['rate'] ?? 0;
            $item->purchase_price = $product['rate'] ?? 0;
            $item->total = $product['total'] ?? 0;
            $item->tax_percentage = $this->tax_rate ?? 0;
            $item->tax_amount = $product['tax_amount'] ?? 0;
            $item->save();
        }

        if(!empty($this->paid_amount) && ($this->payment_method))
        {
            if($this->purchase_payment)
            {
                $payment = $this->purchase_payment;
            }
            else
            {
                $payment = new PurchasePayment();
            }
            $payment->purchase_id = $purchase->id;
            $payment->supplier_id = $purchase->supplier_id;
            $payment->paid_amount = $this->paid_amount;
            $payment->payment_method = $this->payment_method;
            $payment->note = $this->note;
            $payment->payment_remark = $this->payment_remark;
            $payment->save();
        }

        $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Purchase has beem saved!'
        ]);
        $this->reset([
            'cart',
            'selected_supplier',
            'search_suppliers',
            'search_products',
            'paid_amount',
            'payment_method',
            'note',
            'payment_remark',
        ]);
    }
}
