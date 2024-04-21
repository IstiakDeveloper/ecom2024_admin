<!-- resources/views/livewire/category-manager.blade.php -->
<div>
    <!-- Category Form -->
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h2 class="text-xl font-bold mb-4">Add New Category</h2>
        <form wire:submit.prevent="create" enctype="multipart/form-data">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Name
                </label>
                <input wire:model="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Category Name">
                @error('name') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                    Image
                </label>
                <input wire:model="image" type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="image">
                @error('image') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
            </div>

            <!-- Additional fields can be added here -->

            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Save
                </button>
            </div>
        </form>
    </div>

    <!-- Category List -->
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h2 class="text-xl font-bold mb-4">Category List</h2>
        <ul>
            @foreach ($categories as $category)
            <li class="flex items-center justify-between">
                <div class="flex items-center">
                    @if ($category->image)
                    <img class="w-10 h-10 rounded-full mr-4" src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}">
                    @else
                    <div class="w-10 h-10 rounded-full bg-gray-300 mr-4"></div>
                    @endif
                    <span>{{ $category->name }}</span>
                </div>
            </li>
            @endforeach
        </ul>
    </div>

</div>
