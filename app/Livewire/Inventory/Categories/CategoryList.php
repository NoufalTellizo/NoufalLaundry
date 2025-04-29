<?php

namespace App\Livewire\Inventory\Categories;

use App\Models\Category;
use App\Models\Unit;
use Livewire\Component;

class CategoryList extends Component
{
    public $name, $description, $is_active = true, $category, $categories;
    public function render()
    {
        $this->categories = Category::latest()->get();
        return view('livewire.inventory.categories.category-list');
    }
    public function resetInputFields()
    {
        $this->name = '';
        $this->description = '';
        $this->is_active = true;
        $this->category = null;
        $this->resetErrorBag();
    }
    public function save()
    {
        $this->validate([
            'name' => 'required',
        ]);

        if ($this->category) {
            $category = $this->category;
            $this->dispatch('notify', [
                'type' => 'success',
                'title' => 'Success',
                'message' => 'Category has been updated!'
            ]);
        } else {
            $category = new Category();
            $this->dispatch('notify', [
                'type' => 'success',
                'title' => 'Success',
                'message' => 'Category has been saved!'
            ]);
        }

        $category->name = $this->name;
        $category->description = $this->description;
        $category->is_active = $this->is_active == 1 ? true : false;
        $category->save();
        $this->resetInputFields();
        $this->dispatch('closemodal');
    }
    
    public function edit($id)
    {
        $this->category = Category::whereId($id)->first();
        $this->name = $this->category->name;
        $this->description = $this->category->description;
        $this->is_active = $this->category->is_active == 1 ? true : false;
        $this->resetErrorBag();
    }

    public function delete($id)
    {
        $category = Category::whereId($id)->first();
        if (!$category) {
            return;
        }
        $category->delete();
        $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Category has been deleted!'
        ]);
    }
}
