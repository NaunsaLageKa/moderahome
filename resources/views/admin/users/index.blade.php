<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - ModeraHome</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #0F172A; }
    </style>
</head>
<body class="text-white bg-gray-900 min-h-screen">
    <!-- Header -->
    <header class="bg-gray-800 border-b border-gray-700 px-6 py-4">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-bold">User Management</h1>
            <button class="bg-blue-600 px-4 py-2 rounded-lg hover:bg-blue-700 text-white font-semibold">
                Add
            </button>
        </div>
        <!-- Search Bar -->
        <div class="relative">
            <input type="text" placeholder="Search users..." class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-6 py-6 pb-24">
        <!-- Filter Buttons -->
        <div class="flex gap-2 mb-6 overflow-x-auto">
            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold whitespace-nowrap">ALL</button>
            <button class="px-4 py-2 bg-gray-800 text-gray-400 rounded-lg font-semibold whitespace-nowrap border border-gray-700">ADMINS</button>
            <button class="px-4 py-2 bg-gray-800 text-gray-400 rounded-lg font-semibold whitespace-nowrap border border-gray-700">CUSTOMERS</button>
            <button class="px-4 py-2 bg-gray-800 text-gray-400 rounded-lg font-semibold whitespace-nowrap border border-gray-700">SUSPENDED</button>
        </div>

        <!-- Recently Active -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold">Recently Active</h2>
            <button class="text-blue-400 text-sm font-semibold">SORT</button>
        </div>

        <div class="space-y-3 mb-8">
            @foreach($users->take(3) as $user)
                <div class="bg-gray-800 rounded-xl border border-gray-700 p-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-blue-600 flex items-center justify-center">
                            <span class="text-white font-semibold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                        </div>
                        <div>
                            <p class="font-semibold">{{ $user->name }} @if($user->is_admin)<span class="text-xs text-blue-400">(Admin)</span>@endif</p>
                            <p class="text-sm text-gray-400">{{ $user->email }}</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.users.show', $user) }}">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Needs Attention -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold">Needs Attention</h2>
        </div>

        <div class="space-y-3">
            @foreach($users->skip(3)->take(3) as $user)
                <div class="bg-gray-800 rounded-xl border border-gray-700 p-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-gray-600 flex items-center justify-center">
                            <span class="text-white font-semibold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                        </div>
                        <div>
                            <p class="font-semibold">{{ $user->name }}</p>
                            <p class="text-sm text-gray-400">{{ $user->email }}</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.users.show', $user) }}">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($users->hasPages())
            <div class="mt-6">
                {{ $users->links() }}
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
                <a href="{{ route('admin.users.index') }}" class="flex flex-col items-center text-blue-400">
                    <span class="text-xs font-semibold">Settings</span>
                </a>
            </div>
        </nav>
</body>
</html>
