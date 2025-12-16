<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management - ModeraHome</title>
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
            <div>
                <h1 class="text-2xl font-bold">Order Management</h1>
                <p class="text-gray-400 text-sm">Modera</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-white font-semibold">
                Close
            </a>
        </div>
        <!-- Search Bar -->
        <div class="relative">
            <input type="text" placeholder="Search orders..." class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-6 py-6 pb-24">
        <!-- Filter Buttons -->
        <div class="flex gap-2 mb-6 overflow-x-auto">
            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold whitespace-nowrap">ALL</button>
            <button class="px-4 py-2 bg-gray-800 text-gray-400 rounded-lg font-semibold whitespace-nowrap border border-gray-700">PENDING</button>
            <button class="px-4 py-2 bg-gray-800 text-gray-400 rounded-lg font-semibold whitespace-nowrap border border-gray-700">SHIPPED</button>
            <button class="px-4 py-2 bg-gray-800 text-gray-400 rounded-lg font-semibold whitespace-nowrap border border-gray-700">DELIVERED</button>
        </div>

        <!-- Key Metrics -->
        <div class="grid grid-cols-3 gap-4 mb-6">
            <div class="bg-gray-800 rounded-xl p-4 border border-gray-700">
                <p class="text-gray-400 text-xs mb-1">NEW ORDERS</p>
                <div class="flex items-center justify-between">
                    <p class="text-2xl font-bold">{{ $orders->whereIn('status', ['pending', 'processing'])->count() }}</p>
                    <span class="text-green-400 text-xs font-semibold">+1%</span>
                </div>
            </div>
            <div class="bg-gray-800 rounded-xl p-4 border border-gray-700">
                <p class="text-gray-400 text-xs mb-1">TOTAL REVENUE</p>
                <div class="flex items-center justify-between">
                    <p class="text-2xl font-bold">₱{{ number_format($orders->where('status', '!=', 'cancelled')->sum('total') / 1000, 1) }}k</p>
                    <span class="text-red-400 text-xs font-semibold">-1%</span>
                </div>
            </div>
            <div class="bg-gray-800 rounded-xl p-4 border border-gray-700">
                <p class="text-gray-400 text-xs mb-1">RETURNED</p>
                <p class="text-2xl font-bold">{{ $orders->where('status', 'cancelled')->count() }}</p>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold">Recent Activity</h2>
            <button class="text-blue-400 text-sm font-semibold">SEE ALL</button>
        </div>

        <!-- Order List -->
        <div class="space-y-4">
            @forelse($orders as $order)
                <div class="bg-gray-800 rounded-xl border border-gray-700 p-4">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <p class="font-bold text-lg">ORD-{{ $order->id }}</p>
                            <p class="text-gray-400 text-sm">{{ $order->created_at->format('M d, g:i A') }}</p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            @if($order->status == 'pending') bg-yellow-500/20 text-yellow-400
                            @elseif($order->status == 'processing') bg-blue-500/20 text-blue-400
                            @elseif($order->status == 'shipped') bg-purple-500/20 text-purple-400
                            @elseif($order->status == 'delivered') bg-green-500/20 text-green-400
                            @else bg-red-500/20 text-red-400
                            @endif">
                            {{ strtoupper($order->status) }}
                        </span>
                    </div>
                    
                    @if($order->items->count() > 0)
                        @php $firstItem = $order->items->first(); @endphp
                        <div class="flex items-center gap-4 mb-3">
                            @if($firstItem->product->image)
                                <img src="{{ asset('storage/' . $firstItem->product->image) }}" alt="{{ $firstItem->product->name }}" class="w-16 h-16 rounded-lg object-cover">
                            @else
                                <div class="w-16 h-16 bg-gray-700 rounded-lg"></div>
                            @endif
                            <div class="flex-1">
                                <p class="font-semibold">{{ $firstItem->product->name }}</p>
                                <p class="text-blue-400 font-semibold">₱{{ number_format($order->total, 2) }}</p>
                                <p class="text-gray-400 text-sm">{{ $order->items->sum('quantity') }} ITEM{{ $order->items->sum('quantity') > 1 ? 'S' : '' }}</p>
                            </div>
                        </div>
                    @endif

                    <div class="flex items-center justify-between pt-3 border-t border-gray-700">
                        <div>
                            @if($order->status == 'shipped')
                                <p class="text-sm text-gray-400">FedEx {{ $order->id }}</p>
                            @elseif($order->status == 'delivered')
                                <p class="text-sm text-gray-400">Delivered {{ $order->updated_at->format('M d') }}</p>
                            @elseif($order->status == 'cancelled')
                                <p class="text-sm text-gray-400">Refund Processed</p>
                            @else
                                <p class="text-sm text-gray-400">Standard Shipping</p>
                            @endif
                        </div>
                        <a href="{{ route('admin.orders.show', $order) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold text-sm hover:bg-blue-700">
                            @if($order->status == 'shipped') TRACK
                            @elseif($order->status == 'delivered') PROOF
                            @elseif($order->status == 'cancelled') DETAILS
                            @else UPDATE
                            @endif
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <p class="text-gray-400">No orders found</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($orders->hasPages())
            <div class="mt-6">
                {{ $orders->links() }}
            </div>
        @endif
    </div>

        <!-- Bottom Navigation -->
        <nav class="fixed bottom-0 left-0 right-0 bg-gray-800 border-t border-gray-700 px-6 py-3">
            <div class="flex justify-around items-center max-w-7xl mx-auto">
                <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center text-gray-400">
                    <span class="text-xs font-semibold">Home</span>
                </a>
                <a href="{{ route('admin.orders.index') }}" class="flex flex-col items-center text-blue-400">
                    <span class="text-xs font-semibold">Orders</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex flex-col items-center text-gray-400">
                    <span class="text-xs font-semibold">Settings</span>
                </a>
            </div>
        </nav>
</body>
</html>
