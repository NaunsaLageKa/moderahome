<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist - ModeraHome</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400,500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen">
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
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">My Wishlist</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($wishlists->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($wishlists as $wishlist)
                    <div class="group bg-white dark:bg-gray-800 rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700 hover:shadow-lg transition">
                        <a href="{{ route('product.show', $wishlist->product) }}" class="relative block">
                            @if($wishlist->product->image)
                                <img src="{{ asset('storage/' . $wishlist->product->image) }}" alt="{{ $wishlist->product->name }}" class="w-full h-48 object-cover group-hover:scale-105 transition">
                            @else
                                <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                    <span class="text-gray-400">No Image</span>
                                </div>
                            @endif
                            <form action="{{ route('wishlist.remove', $wishlist) }}" method="POST" class="absolute top-3 right-3" onclick="event.stopPropagation(); event.preventDefault(); if(confirm('Remove from wishlist?')) this.submit();">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex items-center justify-center size-8 rounded-full bg-white/80 dark:bg-black/50 text-red-500 hover:bg-red-500 hover:text-white transition-colors">
                                    <span class="material-symbols-outlined text-xl">favorite</span>
                                </button>
                            </form>
                        </a>
                        <div class="p-4">
                            <a href="{{ route('product.show', $wishlist->product) }}" class="block">
                                <h3 class="font-semibold text-gray-900 dark:text-white mb-2 hover:text-primary transition">{{ $wishlist->product->name }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">{{ $wishlist->product->category->name }}</p>
                                <p class="text-lg font-bold text-primary mb-4">₱{{ number_format($wishlist->product->price, 2) }}</p>
                            </a>
                            <div class="flex gap-2">
                                @if($wishlist->product->stock > 0)
                                    <form action="{{ route('cart.add', $wishlist->product) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit" class="w-full bg-primary text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition text-sm">
                                            Add to Cart
                                        </button>
                                    </form>
                                @else
                                    <button disabled class="flex-1 bg-gray-400 text-white py-2 rounded-lg font-semibold cursor-not-allowed text-sm">
                                        Out of Stock
                                    </button>
                                @endif
                                <form action="{{ route('wishlist.move-to-cart', $wishlist) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 border-2 border-primary text-primary rounded-lg hover:bg-primary hover:text-white transition" title="Move to Cart">
                                        <span class="material-symbols-outlined text-lg">shopping_cart</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $wishlists->links() }}
            </div>
        @else
            <div class="bg-white dark:bg-gray-800 rounded-xl p-12 text-center">
                <span class="material-symbols-outlined text-6xl text-gray-400 mb-4">favorite</span>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Your wishlist is empty</h2>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Start adding items to your wishlist!</p>
                <a href="{{ route('dashboard') }}" class="inline-block bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    Start Shopping
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

