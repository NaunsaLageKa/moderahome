<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category - ModeraHome</title>
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
            <h1 class="text-2xl font-bold">Category Management</h1>
            <a href="{{ route('admin.categories.index') }}" class="text-gray-400 hover:text-white font-semibold">
                Close
            </a>
        </div>
    </header>

    <div class="max-w-2xl mx-auto px-6 py-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold">Edit Category</h2>
        </div>

        <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Cover Image -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-300 mb-3">COVER IMAGE</label>
                <div class="relative">
                    <input type="file" name="image" id="imageInput" accept="image/*" class="hidden" onchange="previewImage(this)">
                    <label for="imageInput" class="block w-full h-64 bg-gray-800 border-2 border-dashed border-gray-700 rounded-xl cursor-pointer hover:border-blue-500 transition flex items-center justify-center">
                        @if($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" id="imagePreview" class="w-full h-full object-cover rounded-xl">
                        @else
                            <div class="text-center" id="uploadPlaceholder">
                                <p class="text-gray-400 font-medium">Tap to upload</p>
                            </div>
                        @endif
                    </label>
                </div>
            </div>

            <!-- Category Name -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-300 mb-3">CATEGORY NAME</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" required placeholder="e.g. Living Room" class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-300 mb-3">DESCRIPTION</label>
                <textarea name="description" rows="3" placeholder="Category description..." class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $category->description) }}</textarea>
            </div>

            <!-- Share Visibility Toggle -->
            <div class="mb-8">
                <label class="flex items-center justify-between p-4 bg-gray-800 rounded-xl border border-gray-700 cursor-pointer">
                    <div>
                        <p class="font-semibold">Share Visibility</p>
                        <p class="text-sm text-gray-400">Show this category to customers</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ $category->is_active ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-800 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                </label>
            </div>

            <!-- Save Button -->
            <button type="submit" class="w-full bg-blue-600 text-white py-4 rounded-xl font-bold text-lg hover:bg-blue-700 transition">
                SAVE CATEGORY
            </button>
        </form>
    </div>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('imagePreview');
                    if (preview) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                    } else {
                        const placeholder = document.getElementById('uploadPlaceholder');
                        if (placeholder) {
                            placeholder.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover rounded-xl">`;
                        }
                    }
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>
