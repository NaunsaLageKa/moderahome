<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management - ModeraHome</title>
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
            <h1 class="text-2xl font-bold">Product Management</h1>
            <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </a>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-6 py-6 pb-24">
        <!-- Inventory Section -->
        <div class="mb-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold">Inventory</h2>
                <span class="text-gray-400 text-sm">{{ $products->total() }} ITEMS</span>
            </div>
            
            <!-- Search Bar -->
            <div class="relative mb-4">
                <input type="text" placeholder="Search collection..." class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Filter Buttons -->
            <div class="flex gap-2 mb-6 overflow-x-auto">
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold whitespace-nowrap">ALL ITEMS</button>
                <button class="px-4 py-2 bg-gray-800 text-gray-400 rounded-lg font-semibold whitespace-nowrap border border-gray-700">SOFAS</button>
                <button class="px-4 py-2 bg-gray-800 text-gray-400 rounded-lg font-semibold whitespace-nowrap border border-gray-700">SEATING</button>
                <button class="px-4 py-2 bg-gray-800 text-gray-400 rounded-lg font-semibold whitespace-nowrap border border-gray-700">TABLES</button>
                <button class="px-4 py-2 bg-gray-800 text-gray-400 rounded-lg font-semibold whitespace-nowrap border border-gray-700">LIGHTING</button>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @forelse($products as $product)
                <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">
                    <div class="relative">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-700 flex items-center justify-center">
                                <span class="text-gray-500">No Image</span>
                            </div>
                        @endif
                        <div class="absolute top-3 right-3">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                @if($product->stock == 0) bg-red-500/20 text-red-400
                                @elseif($product->stock <= 5) bg-yellow-500/20 text-yellow-400
                                @else bg-green-500/20 text-green-400
                                @endif">
                                @if($product->stock == 0) NEED OUT
                                @elseif($product->stock <= 5) LOW STOCK
                                @else IN STOCK
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="p-4">
                        <p class="text-xs text-gray-400 mb-1">{{ strtoupper($product->category->name) }}</p>
                        <h3 class="font-bold text-lg mb-2">{{ $product->name }}</h3>
                        <p class="text-blue-400 font-semibold text-lg mb-3">₱{{ number_format($product->price, 2) }}</p>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.products.edit', $product) }}" class="flex-1 bg-blue-600 text-white text-center py-2 rounded-lg font-semibold hover:bg-blue-700">EDIT</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')" class="w-full bg-red-600 text-white py-2 rounded-lg font-semibold hover:bg-red-700">DELETE</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-2 text-center py-12">
                    <p class="text-gray-400 mb-4">No products found</p>
                    <a href="{{ route('admin.products.create') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold">Add Your First Product</a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($products->hasPages())
            <div class="mt-6">
                {{ $products->links() }}
            </div>
        @endif
    </div>

    <!-- Floating Add Button -->
    <a href="{{ route('admin.products.create') }}" class="fixed bottom-24 right-6 bg-blue-600 px-6 py-3 rounded-full shadow-lg hover:bg-blue-700 transition text-white font-semibold">
        Add
    </a>

        <!-- Bottom Navigation -->
        <nav class="fixed bottom-0 left-0 right-0 bg-gray-800 border-t border-gray-700 px-6 py-3">
            <div class="flex justify-around items-center max-w-7xl mx-auto">
                <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center text-gray-400">
                    <span class="text-xs font-semibold">Home</span>
                </a>
                <a href="{{ route('admin.products.index') }}" class="flex flex-col items-center text-blue-400">
                    <span class="text-xs font-semibold">Stock</span>
                </a>
                <a href="{{ route('admin.orders.index') }}" class="flex flex-col items-center text-gray-400">
                    <span class="text-xs font-semibold">Orders</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex flex-col items-center text-gray-400">
                    <span class="text-xs font-semibold">Admin</span>
                </a>
            </div>
        </nav>
</body>
</html>
