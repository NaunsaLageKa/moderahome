<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>ModeraHome - My Account</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#137fec",
                        "background-light": "#f6f7f8",
                        "background-dark": "#101922",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings:
                'FILL' 0,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24
        }
    </style>
</head>
<body class="font-display bg-background-light dark:bg-background-dark">
    <div class="relative flex min-h-screen w-full">
        <aside class="flex w-64 flex-col bg-white dark:bg-gray-900/50 dark:border-r dark:border-gray-800 p-4 border-r border-gray-200">
            <div class="flex items-center gap-3 mb-8">
                <div class="bg-primary/20 rounded-full size-10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary text-2xl">chair</span>
                </div>
                <div class="flex flex-col">
                    <h1 class="text-gray-900 dark:text-white text-base font-bold leading-normal">ModeraHome</h1>
                </div>
            </div>
            <div class="flex flex-col items-center gap-2 mb-8 border-b border-gray-200 dark:border-gray-800 pb-8">
                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-20" data-alt="Avatar of the current user" style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuA1MFqiGW6Iq2pZteFelfkxT2X_pq_mywSETE47l4eWsuQaH_JG0-Cqqykmfl98ctAfvyLKf5gGYdWI5RJ93GIH3EEBWHnFBPj4_vXRyrnmaPlsT6ql8Uttxo-SP5JiLCDJUKYq_XwRM_sozPEHC1_LYBifSzbjH-QUhwSn3n72z2xQU0RSGKMJdG86MBdWzKwJB2Vda_vPAdR8dMRrik0HNw0luOi3hz0Wxi6I4sGaq4lbTPGeFLcWlXVgn-E-5gpaVtfegKM5ESM');"></div>
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mt-2">{{ Auth::user()->name ?? 'Olivia Smith' }}</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ Auth::user()->email ?? 'olivia.smith@email.com' }}</p>
            </div>
            <nav class="flex flex-col gap-2 flex-grow">
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary/20 text-primary" href="#">
                    <span class="material-symbols-outlined">dashboard</span>
                    <p class="text-sm font-medium leading-normal">Dashboard</p>
                </a>
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800" href="#">
                    <span class="material-symbols-outlined">inventory_2</span>
                    <p class="text-sm font-medium leading-normal">My Orders</p>
                </a>
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800" href="#">
                    <span class="material-symbols-outlined">favorite</span>
                    <p class="text-sm font-medium leading-normal">Wishlist</p>
                </a>
            </nav>
            <div class="flex flex-col gap-1 border-t border-gray-200 dark:border-gray-800 pt-4">
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800" href="#">
                    <span class="material-symbols-outlined">help</span>
                    <p class="text-sm font-medium leading-normal">Support</p>
                </a>
            </div>
        </aside>
        <main class="flex-1 flex flex-col">
            <header class="flex items-center justify-between border-b border-gray-200 dark:border-gray-800 px-10 py-3 bg-white dark:bg-gray-900/50">
                <div class="flex items-center gap-8">
                    <h2 class="text-gray-900 dark:text-white text-lg font-bold leading-tight tracking-[-0.015em]">Dashboard</h2>
                </div>
                <div class="flex flex-1 justify-end items-center gap-4">
                    <button class="flex cursor-pointer items-center justify-center rounded-lg h-10 w-10 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                        <span class="material-symbols-outlined text-xl">notifications</span>
                    </button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 rounded-lg px-4 py-2 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                            <span class="material-symbols-outlined">logout</span>
                            <span class="text-sm font-medium leading-normal">Logout</span>
                        </button>
                    </form>
                </div>
            </header>
            <div class="p-10 flex-1 overflow-y-auto">
                <div class="max-w-xl mx-auto mb-10 text-center">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Hello, {{ Auth::user()->name ?? 'Olivia!' }}</h2>
                    <p class="text-center text-gray-600 dark:text-gray-400 mt-2">What are you looking for today?</p>
                    <div class="relative mt-6">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <span class="material-symbols-outlined text-gray-500">search</span>
                        </div>
                        <input class="w-full h-14 pl-12 pr-4 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-primary focus:outline-none" placeholder="Search for furniture, styles, and more..." type="text" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                    @foreach ($categories as $category)
                        <a href="{{ route('category.show', $category->slug) }}" class="group relative flex flex-col justify-end overflow-hidden rounded-xl border border-gray-200 dark:border-gray-800 h-80">
                            @if($category->image)
                                <img alt="{{ $category->name }}" class="absolute inset-0 h-full w-full object-cover transition-transform duration-300 group-hover:scale-110" src="{{ asset('storage/' . $category->image) }}" />
                            @else
                                <div class="absolute inset-0 bg-gradient-to-br from-gray-300 to-gray-400"></div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                            <div class="relative z-10 p-6">
                                <h3 class="text-2xl font-bold text-white">{{ $category->name }}</h3>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">You Might Also Like</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @forelse ($featuredProducts as $product)
                            <div class="group flex flex-col bg-white dark:bg-gray-900/50 rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden">
                                <div class="relative">
                                    @if($product->image)
                                        <img alt="{{ $product->name }}" class="h-56 w-full object-cover" src="{{ asset('storage/' . $product->image) }}" />
                                    @else
                                        <div class="h-56 w-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                            <span class="text-gray-400">No Image</span>
                                        </div>
                                    @endif
                                    <button class="absolute top-3 right-3 flex items-center justify-center size-8 rounded-full bg-white/80 dark:bg-black/50 text-gray-700 dark:text-gray-300 hover:text-red-500 transition-colors">
                                        <span class="material-symbols-outlined text-xl">favorite</span>
                                    </button>
                                </div>
                                <div class="p-4 flex-1 flex flex-col">
                                    <h3 class="text-base font-semibold text-gray-900 dark:text-white">{{ $product->name }}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ \Illuminate\Support\Str::limit($product->description, 50) }}</p>
                                    <div class="flex items-center justify-between mt-4">
                                        <p class="text-lg font-bold text-primary">₱{{ number_format($product->price, 2) }}</p>
                                        <button class="flex items-center justify-center size-9 bg-primary/20 rounded-full text-primary hover:bg-primary hover:text-white transition-colors">
                                            <span class="material-symbols-outlined text-lg">add_shopping_cart</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-4 text-center py-12">
                                <p class="text-gray-500 dark:text-gray-400">No featured products available yet.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>

