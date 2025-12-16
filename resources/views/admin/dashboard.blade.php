<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - ModeraHome</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #0F172A; }
        .greeting-time {
            @apply text-gray-400 text-sm;
        }
        .metric-card {
            @apply bg-gray-800 rounded-xl p-6 border border-gray-700;
        }
        .quick-action {
            @apply bg-gray-800 rounded-xl p-4 border border-gray-700 hover:bg-gray-750 transition;
        }
        .order-card {
            @apply bg-gray-800 rounded-lg p-4 border border-gray-700 mb-3;
        }
        .status-badge {
            @apply px-3 py-1 rounded-full text-xs font-semibold;
        }
    </style>
</head>
<body class="text-white">
    <div class="min-h-screen bg-gray-900">
        <!-- Header -->
        <header class="bg-gray-800 border-b border-gray-700 px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold">Admin Dashboard</h1>
                    <p class="text-gray-400 text-sm">ModeraHome</p>
                </div>
                <div class="flex items-center gap-4">
                    <button class="p-2 hover:bg-gray-700 rounded-lg text-gray-400">
                        Notifications
                    </button>
                    <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center">
                        <span class="text-white font-semibold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    </div>
                </div>
            </div>
        </header>

        <div class="max-w-7xl mx-auto px-6 py-6">
            <!-- Greeting -->
            <div class="mb-6">
                <p class="greeting-time">{{ now()->format('l, F j') }}</p>
                <h2 class="text-3xl font-bold mt-1">Good {{ now()->hour < 12 ? 'Morning' : (now()->hour < 18 ? 'Afternoon' : 'Evening') }}</h2>
                <p class="text-gray-400 mt-1">Overview of your curated collection performance.</p>
            </div>

            <!-- Key Metrics -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div class="metric-card">
                    <p class="text-gray-400 text-sm mb-2">TOTAL REVENUE</p>
                    <div class="flex items-center justify-between">
                        <h3 class="text-3xl font-bold">₱{{ number_format($stats['total_revenue'], 0) }}</h3>
                        <span class="text-green-400 text-sm font-semibold">
                            {{ number_format(abs($revenueChange), 1) }}%
                        </span>
                    </div>
                </div>
                <div class="metric-card">
                    <p class="text-gray-400 text-sm mb-2">NEW ORDERS</p>
                    <h3 class="text-3xl font-bold">{{ $stats['new_orders'] }}</h3>
                </div>
            </div>

            <!-- Weekly Trend -->
            <div class="metric-card mb-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-gray-400 text-sm">WEEKLY TREND</p>
                        <h3 class="text-2xl font-bold">₱{{ number_format(array_sum(array_column($weeklyTrend, 'revenue')), 0) }}</h3>
                    </div>
                </div>
                <div class="h-32 flex items-end justify-between gap-2">
                    @php
                        $maxRevenue = max(array_column($weeklyTrend, 'revenue'));
                        $maxRevenue = $maxRevenue > 0 ? $maxRevenue : 1; // Prevent division by zero
                    @endphp
                    @foreach($weeklyTrend as $day)
                        <div class="flex-1 flex flex-col items-center">
                            <div class="w-full bg-blue-600 rounded-t" style="height: {{ max(10, ($day['revenue'] / $maxRevenue) * 100) }}%"></div>
                            <span class="text-xs text-gray-400 mt-2">{{ $day['day'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                <a href="{{ route('admin.products.create') }}" class="quick-action text-center">
                    <p class="font-semibold">Add Product</p>
                </a>
                <a href="{{ route('admin.orders.index') }}" class="quick-action text-center">
                    <p class="font-semibold">Orders</p>
                </a>
                <a href="{{ route('admin.categories.index') }}" class="quick-action text-center">
                    <p class="font-semibold">Campaigns</p>
                </a>
                <a href="{{ route('admin.dashboard') }}" class="quick-action text-center">
                    <p class="font-semibold">Analytics</p>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Inventory Alerts -->
                <div class="metric-card">
                    <h3 class="text-xl font-bold mb-4">Inventory Alerts</h3>
                    @if($out_of_stock_products->count() > 0 || $low_stock_products->count() > 0)
                        <div class="space-y-3">
                            @foreach($out_of_stock_products as $product)
                                <div class="flex items-center justify-between p-3 bg-gray-700 rounded-lg">
                                    <div class="flex items-center gap-3">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-12 h-12 rounded object-cover">
                                        @else
                                            <div class="w-12 h-12 bg-gray-600 rounded"></div>
                                        @endif
                                        <div>
                                            <p class="font-semibold">{{ $product->name }}</p>
                                            <p class="text-xs text-gray-400">{{ $product->category->name }}</p>
                                        </div>
                                    </div>
                                    <span class="status-badge bg-red-500/20 text-red-400">OUT OF STOCK</span>
                                </div>
                            @endforeach
                            @foreach($low_stock_products as $product)
                                <div class="flex items-center justify-between p-3 bg-gray-700 rounded-lg">
                                    <div class="flex items-center gap-3">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-12 h-12 rounded object-cover">
                                        @else
                                            <div class="w-12 h-12 bg-gray-600 rounded"></div>
                                        @endif
                                        <div>
                                            <p class="font-semibold">{{ $product->name }}</p>
                                            <p class="text-xs text-gray-400">{{ $product->category->name }}</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('admin.products.edit', $product) }}" class="status-badge bg-blue-500/20 text-blue-400">VIEW</a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-400 text-center py-4">All products are in stock</p>
                    @endif
                </div>

                <!-- Recent Orders -->
                <div class="metric-card">
                    <h3 class="text-xl font-bold mb-4">Recent Orders</h3>
                    @if($recent_orders->count() > 0)
                        <div class="space-y-3">
                            @foreach($recent_orders as $order)
                                <div class="order-card">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-semibold">ORD-{{ $order->id }}</span>
                                        <span class="status-badge 
                                            @if($order->status == 'pending') bg-yellow-500/20 text-yellow-400
                                            @elseif($order->status == 'processing') bg-blue-500/20 text-blue-400
                                            @elseif($order->status == 'shipped') bg-purple-500/20 text-purple-400
                                            @elseif($order->status == 'delivered') bg-green-500/20 text-green-400
                                            @else bg-red-500/20 text-red-400
                                            @endif">
                                            {{ strtoupper($order->status) }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-400">{{ $order->user->name }}</p>
                                    <p class="text-sm font-semibold mt-1">₱{{ number_format($order->total, 2) }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-400 text-center py-4">No orders yet</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Bottom Navigation -->
        <nav class="fixed bottom-0 left-0 right-0 bg-gray-800 border-t border-gray-700 px-6 py-3">
            <div class="flex justify-around items-center max-w-7xl mx-auto">
                <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center text-blue-400">
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
        <div class="h-20"></div>
    </div>
</body>
</html>
