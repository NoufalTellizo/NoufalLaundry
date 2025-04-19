<?php

namespace App\Livewire\Inventory\Units;

use App\Models\Unit;
use Livewire\Component;

class UnitList extends Component
{
    public $name, $description, $short_form, $is_active = true, $unit, $units;
    public function render()
    {
        $this->units = Unit::latest()->get();
        return view('livewire.inventory.units.unit-list');
    }
    public function resetInputFields()
    {
        $this->name = '';
        $this->description = '';
        $this->short_form = '';
        $this->is_active = true;
        $this->resetErrorBag();
    }
    public function save()
    {
        $this->validate([
            'name' => 'required',
            'short_form' => 'required',
        ]);

        if($this->unit){
            $unit = $this->unit;
        }else{
            $unit = new Unit();
        }

        $unit->name = $this->name;
        $unit->description = $this->description;
        $unit->short_form = $this->short_form;
        $unit->is_active = $this->is_active;
        $unit->save();
        $this->resetInputFields();
        $this->dispatch('closemodal');
    }
    public function delete($id)
    {
        $unit = Unit::whereId($id)->first();
        if(!$unit){
            return;
        }
        $unit->delete();
    }
    public function edit($id){
        $this->unit = Unit::whereId($id)->first();
        $this->name = $this->unit->name;
        $this->description = $this->unit->description;
        $this->short_form = $this->unit->short_form;
        $this->is_active = $this->unit->is_active == 1 ? true:false;
        $this->resetErrorBag();
    }
}
