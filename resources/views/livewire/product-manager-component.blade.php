<!-- resources/views/livewire/product-manager.blade.php -->
<div>
    <!-- Product Form -->
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h2 class="text-xl font-bold mb-4">Add New Product</h2>
        <form wire:submit.prevent="create" enctype="multipart/form-data">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Name
                </label>
                <input wire:model="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Product Name">
                @error('name') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Description
                </label>
                <textarea wire:model="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" placeholder="Product Description"></textarea>
                @error('description') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="category">
                    Category
                </label>
                <select wire:model="category_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="category">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                    Image
                </label>
                <input wire:model="image" type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="image">
                @error('image') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image_gallery">
                    Image Gallery
                </label>
                <input wire:model="image_gallery" type="file" multiple class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="image_gallery">
                @error('image_gallery') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                    Price
                </label>
                <input wire:model="price" type="number" step="0.01" min="0" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="price" placeholder="Product Price">
                @error('price') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
            </div>

            <!-- Additional fields can be added here -->

            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Save
                </button>
            </div>
        </form>
    </div>

    <!-- Product List -->
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h2 class="text-xl font-bold mb-4">Product List</h2>
        <ul>
            @foreach ($products as $product)
            <li class="flex items-center justify-between">
                <div class="flex items-center">
                    @if ($product->image)
                    <img class="w-10 h-10 rounded-full mr-4" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    @else
                    <div class="w-10 h-10 rounded-full bg-gray-300 mr-4"></div>
                    @endif
                    <div>
                        <span class="font-bold">{{ $product->name }}</span>
                        <p class="text-sm text-gray-600">{{ \Illuminate\Support\Str::limit($product->description, 100) }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="block text-gray-900 font-semibold">${{ $product->price }}</span>
                </div>
            </li>
            @endforeach
        </ul>
    </div>

</div>
