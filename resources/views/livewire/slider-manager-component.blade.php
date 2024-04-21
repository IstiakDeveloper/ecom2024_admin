<!-- resources/views/livewire/slider-manager.blade.php -->

<div class="container mx-auto min-h-[85vh]">
    <div class="bg-white shadow-md rounded px-8 py-6 mb-8">
        <h2 class="text-2xl font-bold mb-4">Slider Manager</h2>

        <!-- Add Slider Form -->
        <form wire:submit.prevent="create">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Name:
                </label>
                <input wire:model="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Enter slider name">
                @error('name') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                    Image:
                </label>
                <input wire:model="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="image" type="file">
                @error('image') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                    Status:
                </label>
                <select wire:model="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="status">
                    <option value="publish">Publish</option>
                    <option value="unpublish">Unpublish</option>
                </select>
                @error('status') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Add Slider
            </button>
        </form>
    </div>

    <!-- Sliders List -->
    <div class="bg-white shadow-md rounded px-8 py-6">
        <h2 class="text-2xl font-bold mb-4">Sliders</h2>
        <ul>
            @foreach ($sliders as $slider)
            <li class="flex items-center justify-between mb-2">
                <div class="flex items-center">
                    <img class="w-12 h-12 rounded-full mr-4" src="{{ asset('storage/' . $slider->image) }}" alt="{{ $slider->name }}">
                    <div>
                        <span class="font-bold">{{ $slider->name }}</span>
                        <span class="text-sm text-gray-600">{{ $slider->status }}</span>
                    </div>
                </div>
                <div>
                    <button wire:click="edit({{ $slider->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Edit</button>
                    <button wire:click="delete({{ $slider->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete</button>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
