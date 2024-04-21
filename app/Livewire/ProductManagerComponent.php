<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductManagerComponent extends Component
{


    use WithFileUploads;

    public $products;
    public $name;
    public $description;
    public $category_id;
    public $image;
    public $image_gallery = [];
    public $price;
    public $categories;

    public function mount()
    {
        $this->products = Product::all();
        $this->categories = Category::all();
    }

    public function render()
    {
        return view('livewire.product-manager-component');
    }

    public function create()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|max:1024', // 1MB max size
            'image_gallery.*' => 'nullable|image|max:1024'
        ]);

        // Upload main image
        $mainImagePath = $this->image->store('products', 'public');

        // Upload image gallery if provided
        $galleryPaths = [];
        if ($this->image_gallery) {
            foreach ($this->image_gallery as $image) {
                $galleryPaths[] = $image->store('product_gallery', 'public');
            }
        }

        // Create new product
        $product = Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'image' => $mainImagePath,
            'image_gallery' => $galleryPaths ?: null, // Set to null if no images are uploaded
            'price' => $this->price,
        ]);

        // Reset form fields
        $this->resetFields();
        $this->products->prepend($product);
    }

    private function resetFields()
    {
        $this->name = '';
        $this->description = '';
        $this->category_id = '';
        $this->image = '';
        $this->image_gallery = [];
        $this->price = '';
    }

}
