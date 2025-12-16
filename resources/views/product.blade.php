<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - ModeraHome</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900">
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
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            <!-- Product Image -->
            <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-96 object-cover">
                @else
                    <div class="w-full h-96 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                        <span class="text-gray-400">No Image</span>
                    </div>
                @endif
            </div>

            <!-- Product Info -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">{{ $product->name }}</h1>
                <p class="text-2xl font-bold text-primary mb-6">₱{{ number_format($product->price, 2) }}</p>
                
                <div class="mb-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Category</p>
                    <p class="text-gray-900 dark:text-white">{{ $product->category->name }}</p>
                </div>

                <div class="mb-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Stock</p>
                    <p class="text-gray-900 dark:text-white">
                        @if($product->stock > 0)
                            <span class="text-green-600 dark:text-green-400">{{ $product->stock }} available</span>
                        @else
                            <span class="text-red-600 dark:text-red-400">Out of stock</span>
                        @endif
                    </p>
                </div>

                <div class="mb-8">
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Description</p>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $product->description }}</p>
                </div>

                @if($product->stock > 0)
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="mb-4">
                        @csrf
                        <div class="flex items-center gap-4 mb-4">
                            <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">Quantity:</label>
                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-20 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                        </div>
                        <button type="submit" class="w-full bg-primary text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                            Add to Cart
                        </button>
                    </form>
                @else
                    <button disabled class="w-full bg-gray-400 text-white py-3 rounded-lg font-semibold cursor-not-allowed">
                        Out of Stock
                    </button>
                @endif

                <form action="{{ route('wishlist.add', $product) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full border-2 border-primary text-primary py-3 rounded-lg font-semibold hover:bg-primary hover:text-white transition">
                        Add to Wishlist
                    </button>
                </form>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Related Products</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $related)
                        <a href="{{ route('product.show', $related) }}" class="group bg-white dark:bg-gray-800 rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700 hover:shadow-lg transition">
                            @if($related->image)
                                <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}" class="w-full h-48 object-cover group-hover:scale-105 transition">
                            @else
                                <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                    <span class="text-gray-400">No Image</span>
                                </div>
                            @endif
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-900 dark:text-white mb-2">{{ $related->name }}</h3>
                                <p class="text-lg font-bold text-primary">₱{{ number_format($related->price, 2) }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <script>
        // Load cart count
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

