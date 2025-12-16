<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - ModeraHome</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400,500,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen">
    <!-- Header -->
    <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-6 py-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <a href="{{ route('dashboard') }}" class="text-xl font-bold text-primary">ModeraHome</a>
            <div class="flex items-center gap-4">
                <a href="{{ route('cart.index') }}" class="relative flex items-center justify-center rounded-lg h-10 w-10 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    <span id="cartCount" class="absolute -top-1 -right-1 bg-primary text-white text-xs rounded-full h-5 w-5 flex items-center justify-center hidden">0</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600">Logout</button>
                </form>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-6 py-8">
        <!-- Search Bar -->
        <form action="{{ route('search') }}" method="GET" class="mb-8">
            <div class="flex gap-4 mb-4">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                        <span class="material-symbols-outlined text-gray-500">search</span>
                    </div>
                    <input name="q" value="{{ $query }}" class="w-full h-12 pl-12 pr-4 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary focus:outline-none" placeholder="Search for furniture..." type="text">
                </div>
                <select name="category" class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $categoryId == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg font-semibold hover:bg-blue-700">Search</button>
            </div>

            <!-- Filters -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Price Range -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Price Range</label>
                        <div class="flex gap-2">
                            <input type="number" name="min_price" value="{{ $minPrice }}" placeholder="Min" class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <input type="number" name="max_price" value="{{ $maxPrice }}" placeholder="Max" class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                        </div>
                    </div>

                    <!-- Availability -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Availability</label>
                        <select name="availability" onchange="this.form.submit()" class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <option value="all" {{ $availability == 'all' || !$availability ? 'selected' : '' }}>All</option>
                            <option value="in_stock" {{ $availability == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                            <option value="out_of_stock" {{ $availability == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                        </select>
                    </div>

                    <!-- Sort By -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Sort By</label>
                        <select name="sort" onchange="this.form.submit()" class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <option value="newest" {{ $sortBy == 'newest' ? 'selected' : '' }}>Newest</option>
                            <option value="price_low" {{ $sortBy == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_high" {{ $sortBy == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="name_asc" {{ $sortBy == 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
                            <option value="name_desc" {{ $sortBy == 'name_desc' ? 'selected' : '' }}>Name: Z to A</option>
                        </select>
                    </div>

                    <!-- Clear Filters -->
                    <div class="flex items-end">
                        <a href="{{ route('search', ['q' => $query]) }}" class="w-full px-4 py-2 border-2 border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg font-semibold hover:bg-gray-100 dark:hover:bg-gray-700 text-center">
                            Clear Filters
                        </a>
                    </div>
                </div>
            </div>
        </form>

        <!-- Results -->
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                @if($query)
                    Search Results for "{{ $query }}"
                @else
                    All Products
                @endif
                <span class="text-lg font-normal text-gray-500">({{ $products->total() }} found)</span>
            </h1>
        </div>

        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-8">
                @foreach($products as $product)
                    <a href="{{ route('product.show', $product) }}" class="group bg-white dark:bg-gray-800 rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700 hover:shadow-lg transition">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover group-hover:scale-105 transition">
                        @else
                            <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                <span class="text-gray-400">No Image</span>
                            </div>
                        @endif
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-2">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">{{ $product->category->name }}</p>
                            <p class="text-lg font-bold text-primary">₱{{ number_format($product->price, 2) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $products->links() }}
            </div>
        @else
            <div class="bg-white dark:bg-gray-800 rounded-xl p-12 text-center">
                <span class="material-symbols-outlined text-6xl text-gray-400 mb-4">search_off</span>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">No products found</h2>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Try adjusting your search criteria</p>
                <a href="{{ route('dashboard') }}" class="inline-block bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    Back to Dashboard
                </a>
            </div>
        @endif
    </div>

    <script>
        fetch('{{ route("cart.count") }}')
            .then(response => response.json())
            .then(data => {
                if (data.count > 0) {
                    document.getElementById('cartCount').textContent = data.count;
                    document.getElementById('cartCount').classList.remove('hidden');
                }
            });
    </script>
</body>
</html>

