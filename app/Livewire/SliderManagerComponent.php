<?php

namespace App\Livewire;

use App\Models\Slider;
use Livewire\Component;
use Livewire\WithFileUploads;

class SliderManagerComponent extends Component
{
    use WithFileUploads;
    public $sliders;
    public $name;
    public $image;
    public $status;

    public function mount()
    {
        $this->sliders = Slider::all();
    }

    public function render()
    {
        return view('livewire.slider-manager-component');
    }

    public function create()
    {
        $this->validate([
            'name' => 'required',
            'image' => 'required|image|max:1024',
            'status' => 'required|in:publish,unpublish',
        ]);

        $imagePath = $this->image->store('sliders', 'public');

        Slider::create([
            'name' => $this->name,
            'image' => $imagePath,
            'status' => $this->status,
        ]);

        $this->resetFields();
        $this->sliders = Slider::all();
    }

    public function edit($id)
    {
        // Fetch the slider by ID and fill the form fields for editing
        $slider = Slider::findOrFail($id);
        $this->name = $slider->name;
        $this->status = $slider->status;
    }

    public function update($id)
    {
        $this->validate([
            'name' => 'required',
            'status' => 'required|in:publish,unpublish',
        ]);

        $slider = Slider::findOrFail($id);

        if ($this->image) {
            // Update image if a new image is provided
            $imagePath = $this->image->store('sliders', 'public');
            $slider->update(['image' => $imagePath]);
        }

        $slider->update([
            'name' => $this->name,
            'status' => $this->status,
        ]);

        $this->resetFields();
        $this->sliders = Slider::all();
    }

    public function delete($id)
    {
        Slider::findOrFail($id)->delete();
        $this->sliders = Slider::all();
    }

    private function resetFields()
    {
        $this->name = '';
        $this->image = '';
        $this->status = '';
    }

}
