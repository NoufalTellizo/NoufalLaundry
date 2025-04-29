<?php

namespace App\Livewire\Inventory\Categories;

use App\Models\Category;
use App\Models\CategoryNew;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Support\Arr;
use Livewire\Component;

class CategoryListTwo extends Component
{
    public $name, $description, $is_active = true, $categories,$category, $toggleSwitch = 1, $date_variable, $interval, $a = ['products'=>['desk'=>['price' => 1000]]], $flattened_array;
    public $b = ['random'=>['100', 'James', 100, false, 5.56], 'numbers'=>[1,2,3,4,5], 'letters'=>['A','B','C','D','E']];
    public function render()
    {
        $this->categories = CategoryNew::where('is_active', $this->toggleSwitch)->get();
        $category_create = CategoryNew::firstOrCreate([
            'name' => 'Category 1',
            'description' => 'This is a Sample Category for you.',
        ]);
        // $this->date_variable = Carbon::now()->addDays(30);
        // $this->date_variable = Carbon::now()->addYear();
        // $this->date_variable = Carbon::now()->addYears(5);
        // $this->date_variable = Carbon::now()->subYear();
        // $this->date_variable = Carbon::now()->subYears(5);
        // $this->date_variable = Carbon::now()->addMonth();
        // $this->date_variable = Carbon::now()->addMonths(5);
        // $this->date_variable = Carbon::now()->addDays(2);
        // $this->date_variable = Carbon::now()->addHours(1)->toFormattedDateString();
        $this->date_variable = Carbon::create(2012,1,31,0);
        $future = Carbon::create(2012,1,31,0);
        $past = Carbon::create(2012,1,31,0);
        $future = $future->addMonths(2);
        $past = $past->subMonths(2);
        // $this->flattened_array = Arr::dot($this->a);
        // $keyed = Arr::prependKeysWith($this->a , 'item.');
        $sample_name = Arr::pull($this->b, 'letters');
        // $sample_name = Arr::pull($this->a, 'products');
        // $sample_name = Arr::random($this->b);
        $new_array_a = Arr::set($this->a , 'products.desk.price' , 200);
        $shuffled_b = Arr::shuffle($this->b['numbers']);
        $filled_data = data_fill($this->a, 'products.desk.discount', 100);
        dd($filled_data);
        // $this->interval = CarbonInterval::months(3);
        return view('livewire.inventory.categories.category-list-two');
    }
    public function resetFields()
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

        if($this->category){
            $category = $this->category;
        }else{
            $category = new CategoryNew();
        }

        $category->name = $this->name;
        $category->description = $this->description;
        $category->is_active = $this->is_active;
        $category->save();
        $this->dispatch('closemodal');
        $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Category has been created!'
        ]);
    }
    public function edit($id)
    {
        $this->category = CategoryNew::whereId($id)->first();
        $this->name = $this->category->name;
        $this->description = $this->category->description;
        $this->is_active = $this->category->is_active == 1 ? true:false;
        $this->resetErrorBag();
    }
    public function delete($id)
    {
         CategoryNew::whereId($id)->delete();
         $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Category has been delete!'
        ]);
    }
}
