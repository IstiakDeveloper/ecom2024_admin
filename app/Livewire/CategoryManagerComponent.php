<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;

class CategoryManagerComponent extends Component
{
    use WithFileUploads;

    public $categories;
    public $name;
    public $image;

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function render()
    {
        return view('livewire.category-manager-component');
    }

    public function create()
    {
        $this->validate([
            'name' => 'required',
            'image' => 'nullable|image|max:1024', // 1MB max size
        ]);

        Category::create([
            'name' => $this->name,
            'image' => $this->image ? $this->image->store('categories', 'public') : null,
        ]);

        $this->resetFields();
    }

    private function resetFields()
    {
        $this->name = '';
        $this->image = '';
    }

}
