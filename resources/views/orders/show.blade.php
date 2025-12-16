<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - ModeraHome</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400,500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen">
    <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-6 py-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <a href="{{ route('dashboard') }}" class="text-xl font-bold text-primary">ModeraHome</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600">Logout</button>
            </form>
        </div>
    </header>

    <div class="max-w-4xl mx-auto px-6 py-8">
        <div class="mb-6">
            <a href="{{ route('orders.index') }}" class="text-primary hover:underline">← Back to Orders</a>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-8 border border-gray-200 dark:border-gray-700">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Order Details</h1>
                <p class="text-gray-600 dark:text-gray-400">Order #{{ $order->order_number }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Status</p>
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold 
                        @if($order->status == 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                        @elseif($order->status == 'processing') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                        @elseif($order->status == 'shipped') bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200
                        @elseif($order->status == 'delivered') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                        @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                        @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Order Date</p>
                    <p class="text-gray-900 dark:text-white">{{ $order->created_at->format('F d, Y h:i A') }}</p>
                </div>
            </div>

            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Order Items</h2>
                <div class="space-y-4">
                    @foreach($order->items as $item)
                        <div class="flex gap-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            @if($item->product->image)
                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-20 h-20 object-cover rounded">
                            @else
                                <div class="w-20 h-20 bg-gray-200 dark:bg-gray-600 rounded flex items-center justify-center">
                                    <span class="text-gray-400 text-xs">No Image</span>
                                </div>
                            @endif
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900 dark:text-white">{{ $item->product->name }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Quantity: {{ $item->quantity }}</p>
                                <p class="text-primary font-bold mt-1">₱{{ number_format($item->price * $item->quantity, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                <div class="flex justify-between text-xl font-bold text-gray-900 dark:text-white mb-6">
                    <span>Total</span>
                    <span>₱{{ number_format($order->total, 2) }}</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Shipping Address</h3>
                        <p class="text-gray-600 dark:text-gray-400">{{ $order->shipping_address }}</p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Billing Address</h3>
                        <p class="text-gray-600 dark:text-gray-400">{{ $order->billing_address }}</p>
                    </div>
                </div>

                @if($order->phone)
                    <div class="mt-4">
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Phone</h3>
                        <p class="text-gray-600 dark:text-gray-400">{{ $order->phone }}</p>
                    </div>
                @endif

                @if($order->notes)
                    <div class="mt-4">
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Notes</h3>
                        <p class="text-gray-600 dark:text-gray-400">{{ $order->notes }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>

