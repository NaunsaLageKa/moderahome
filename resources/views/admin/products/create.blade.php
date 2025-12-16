<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - ModeraHome</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #0F172A; }
    </style>
</head>
<body class="text-white bg-gray-900 min-h-screen">
    <!-- Header -->
    <header class="bg-gray-800 border-b border-gray-700 px-6 py-4">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">Add Product</h1>
            <a href="{{ route('admin.products.index') }}" class="text-gray-400 hover:text-white font-semibold">
                Close
            </a>
        </div>
    </header>

    <div class="max-w-2xl mx-auto px-6 py-6">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-6">
                <!-- Product Image -->
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-3">PRODUCT IMAGE</label>
                    <input type="file" name="image" id="imageInput" accept="image/*" class="hidden" onchange="previewImage(this)">
                    <label for="imageInput" class="block w-full h-64 bg-gray-800 border-2 border-dashed border-gray-700 rounded-xl cursor-pointer hover:border-blue-500 transition flex items-center justify-center">
                        <div class="text-center" id="uploadPlaceholder">
                            <p class="text-gray-400 font-medium">Tap to upload</p>
                        </div>
                        <img id="imagePreview" src="" alt="Preview" class="hidden w-full h-full object-cover rounded-xl">
                    </label>
                </div>

                <!-- Product Name -->
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-3">PRODUCT NAME</label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('name')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-3">CATEGORY</label>
                    <select name="category_id" required class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-3">DESCRIPTION</label>
                    <textarea name="description" rows="4" required class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price and Stock -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-3">PRICE</label>
                        <input type="number" step="0.01" name="price" value="{{ old('price') }}" required class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('price')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-3">STOCK</label>
                        <input type="number" name="stock" value="{{ old('stock', 0) }}" required class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('stock')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Featured and Active -->
                <div class="space-y-4">
                    <label class="flex items-center justify-between p-4 bg-gray-800 rounded-xl border border-gray-700 cursor-pointer">
                        <div>
                            <p class="font-semibold">Featured Product</p>
                            <p class="text-sm text-gray-400">Show in featured section</p>
                        </div>
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="w-5 h-5 bg-gray-700 border-gray-600 rounded text-blue-600 focus:ring-blue-500 focus:ring-2">
                    </label>
                    <label class="flex items-center justify-between p-4 bg-gray-800 rounded-xl border border-gray-700 cursor-pointer">
                        <div>
                            <p class="font-semibold">Active</p>
                            <p class="text-sm text-gray-400">Show this product to customers</p>
                        </div>
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="w-5 h-5 bg-gray-700 border-gray-600 rounded text-blue-600 focus:ring-blue-500 focus:ring-2">
                    </label>
                </div>

                <!-- Save Button -->
                <button type="submit" class="w-full bg-blue-600 text-white py-4 rounded-xl font-bold text-lg hover:bg-blue-700 transition">
                    SAVE PRODUCT
                </button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreview').src = e.target.result;
                    document.getElementById('imagePreview').classList.remove('hidden');
                    document.getElementById('uploadPlaceholder').classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>
