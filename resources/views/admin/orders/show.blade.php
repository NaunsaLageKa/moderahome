<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - ModeraHome</title>
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
            <h1 class="text-2xl font-bold">Order #{{ $order->order_number }}</h1>
            <a href="{{ route('admin.orders.index') }}" class="text-gray-400 hover:text-white font-semibold">
                Close
            </a>
        </div>
    </header>

    <div class="max-w-4xl mx-auto px-6 py-6">
        @if(session('success'))
            <div class="bg-green-500/20 border border-green-500 text-green-400 px-4 py-3 rounded-lg mb-4">{{ session('success') }}</div>
        @endif

        <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 mb-6">
            <h2 class="text-xl font-bold mb-4">Order Information</h2>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <p class="text-sm text-gray-400 mb-1">Customer</p>
                    <p class="font-semibold">{{ $order->user->name }}</p>
                    <p class="text-sm text-gray-400">{{ $order->user->email }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-400 mb-1">Total</p>
                    <p class="font-bold text-2xl text-blue-400">₱{{ number_format($order->total, 2) }}</p>
                </div>
            </div>
            <div>
                <p class="text-sm text-gray-400 mb-2">Status</p>
                <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <select name="status" onchange="this.form.submit()" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </form>
            </div>
        </div>

        <div class="bg-gray-800 rounded-xl border border-gray-700 p-6">
            <h2 class="text-xl font-bold mb-4">Order Items</h2>
            <div class="space-y-4">
                @foreach($order->items as $item)
                    <div class="flex items-center gap-4 p-4 bg-gray-700 rounded-lg">
                        @if($item->product->image)
                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-20 h-20 rounded-lg object-cover">
                        @else
                            <div class="w-20 h-20 bg-gray-600 rounded-lg"></div>
                        @endif
                        <div class="flex-1">
                            <p class="font-semibold">{{ $item->product->name }}</p>
                            <p class="text-sm text-gray-400">Quantity: {{ $item->quantity }}</p>
                            <p class="text-blue-400 font-semibold">₱{{ number_format($item->price, 2) }} each</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-lg">₱{{ number_format($item->quantity * $item->price, 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-6 pt-6 border-t border-gray-700 flex justify-between items-center">
                <p class="text-xl font-bold">Total</p>
                <p class="text-2xl font-bold text-blue-400">₱{{ number_format($order->total, 2) }}</p>
            </div>
        </div>
    </div>
</body>
</html>
