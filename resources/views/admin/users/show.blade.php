<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details - ModeraHome</title>
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
            <h1 class="text-2xl font-bold">User: {{ $user->name }}</h1>
            <a href="{{ route('admin.users.index') }}" class="text-gray-400 hover:text-white font-semibold">
                Close
            </a>
        </div>
    </header>

    <div class="max-w-4xl mx-auto px-6 py-6">
        <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 mb-6">
            <h2 class="text-xl font-bold mb-4">User Information</h2>
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <p class="text-sm text-gray-400 mb-1">Name</p>
                    <p class="font-semibold text-lg">{{ $user->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-400 mb-1">Email</p>
                    <p class="font-semibold text-lg">{{ $user->email }}</p>
                </div>
            </div>
            <div>
                <p class="text-sm text-gray-400 mb-2">Admin Status</p>
                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <label class="flex items-center justify-between p-4 bg-gray-700 rounded-xl border border-gray-600 cursor-pointer">
                        <span class="font-semibold">Is Admin</span>
                        <input type="checkbox" name="is_admin" value="1" {{ $user->is_admin ? 'checked' : '' }} onchange="this.form.submit()" class="w-11 h-6 bg-gray-600 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-800 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600 relative">
                    </label>
                </form>
            </div>
        </div>

        <div class="bg-gray-800 rounded-xl border border-gray-700 p-6">
            <h2 class="text-xl font-bold mb-4">Orders ({{ $user->orders->count() }})</h2>
            @if($user->orders->count() > 0)
                <div class="space-y-3">
                    @foreach($user->orders as $order)
                        <div class="p-4 bg-gray-700 rounded-lg">
                            <div class="flex items-center justify-between mb-2">
                                <p class="font-semibold">Order #{{ $order->order_number }}</p>
                                <p class="text-blue-400 font-bold">₱{{ number_format($order->total, 2) }}</p>
                            </div>
                            <p class="text-sm text-gray-400">{{ $order->created_at->format('M d, Y') }}</p>
                            <span class="inline-block mt-2 px-3 py-1 rounded-full text-xs font-semibold
                                @if($order->status == 'pending') bg-yellow-500/20 text-yellow-400
                                @elseif($order->status == 'processing') bg-blue-500/20 text-blue-400
                                @elseif($order->status == 'shipped') bg-purple-500/20 text-purple-400
                                @elseif($order->status == 'delivered') bg-green-500/20 text-green-400
                                @else bg-red-500/20 text-red-400
                                @endif">
                                {{ strtoupper($order->status) }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-400 text-center py-8">No orders</p>
            @endif
        </div>
    </div>
</body>
</html>
