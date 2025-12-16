<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Management - ModeraHome</title>
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
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-white font-semibold">Close</a>
                    <a href="{{ route('admin.categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 font-semibold">Add Category</a>
                </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-6 py-6 pb-24">
        @if(session('success'))
            <div class="bg-green-500/20 border border-green-500 text-green-400 px-4 py-3 rounded-lg mb-4">{{ session('success') }}</div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($categories as $category)
                <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">
                    @if($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-700 flex items-center justify-center">
                            <span class="text-gray-500">No Image</span>
                        </div>
                    @endif
                    <div class="p-4">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="font-bold text-lg">{{ $category->name }}</h3>
                            <span class="px-2 py-1 text-xs rounded {{ $category->is_active ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                                {{ $category->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-400 mb-4">{{ $category->slug }}</p>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="flex-1 bg-blue-600 text-white text-center py-2 rounded-lg font-semibold hover:bg-blue-700">EDIT</a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')" class="w-full bg-red-600 text-white py-2 rounded-lg font-semibold hover:bg-red-700">DELETE</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <p class="text-gray-400 mb-4">No categories found</p>
                    <a href="{{ route('admin.categories.create') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold">Add Your First Category</a>
                </div>
            @endforelse
        </div>

        @if($categories->hasPages())
            <div class="mt-6">
                {{ $categories->links() }}
            </div>
        @endif
    </div>

        <!-- Bottom Navigation -->
        <nav class="fixed bottom-0 left-0 right-0 bg-gray-800 border-t border-gray-700 px-6 py-3">
            <div class="flex justify-around items-center max-w-7xl mx-auto">
                <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center text-gray-400">
                    <span class="text-xs font-semibold">Home</span>
                </a>
                <a href="{{ route('admin.products.index') }}" class="flex flex-col items-center text-gray-400">
                    <span class="text-xs font-semibold">Products</span>
                </a>
                <a href="{{ route('admin.orders.index') }}" class="flex flex-col items-center text-gray-400">
                    <span class="text-xs font-semibold">Orders</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex flex-col items-center text-gray-400">
                    <span class="text-xs font-semibold">Settings</span>
                </a>
            </div>
        </nav>
</body>
</html>
