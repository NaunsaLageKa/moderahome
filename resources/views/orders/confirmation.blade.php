<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - ModeraHome</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400,500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-3xl mx-auto px-6 py-12">
        <div class="bg-white dark:bg-gray-800 rounded-xl p-8 border border-gray-200 dark:border-gray-700 text-center">
            <div class="mb-6">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 dark:bg-green-900 rounded-full mb-4">
                    <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Order Placed Successfully!</h1>
                <p class="text-gray-600 dark:text-gray-400">Thank you for your purchase</p>
            </div>

            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 mb-6">
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Order Number</p>
                <p class="text-2xl font-bold text-primary">{{ $order->order_number }}</p>
            </div>

            <div class="text-left space-y-4 mb-6">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Total Amount</p>
                    <p class="text-xl font-bold text-gray-900 dark:text-white">₱{{ number_format($order->total, 2) }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Status</p>
                    <p class="text-lg font-semibold text-yellow-600 dark:text-yellow-400 capitalize">{{ $order->status }}</p>
                </div>
            </div>

            <div class="flex gap-4 justify-center">
                <a href="{{ route('orders.show', $order) }}" class="px-6 py-3 bg-primary text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                    View Order Details
                </a>
                <a href="{{ route('dashboard') }}" class="px-6 py-3 border-2 border-primary text-primary rounded-lg font-semibold hover:bg-primary hover:text-white transition">
                    Continue Shopping
                </a>
            </div>
        </div>
    </div>
</body>
</html>

