<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Management - ModeraHome</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #0F172A; }
    </style>
</head>
<body class="text-white bg-gray-900 min-h-screen">
    <!-- Header -->
    <header class="bg-gray-800 border-b border-gray-700 px-6 py-4">
        <h1 class="text-2xl font-bold">Review Management</h1>
        <!-- Search Bar -->
        <div class="relative mt-4">
            <input type="text" placeholder="Search by product, customer, or SKU..." class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-6 py-6 pb-24">
        <!-- Key Metrics -->
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div class="bg-gray-800 rounded-xl p-4 border border-gray-700">
                <p class="text-gray-400 text-xs mb-1">PENDING</p>
                <p class="text-3xl font-bold">{{ $reviews->where('is_approved', false)->count() }}</p>
            </div>
            <div class="bg-gray-800 rounded-xl p-4 border border-gray-700">
                <p class="text-gray-400 text-xs mb-1">FLAGGED</p>
                <p class="text-3xl font-bold">0</p>
            </div>
        </div>

        <!-- Filter Buttons -->
        <div class="flex gap-2 mb-6 overflow-x-auto">
            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold whitespace-nowrap">PENDING</button>
            <button class="px-4 py-2 bg-gray-800 text-gray-400 rounded-lg font-semibold whitespace-nowrap border border-gray-700">APPROVED</button>
            <button class="px-4 py-2 bg-gray-800 text-gray-400 rounded-lg font-semibold whitespace-nowrap border border-gray-700">REJECTED</button>
        </div>

        <!-- Review List -->
        <div class="space-y-4">
            @forelse($reviews as $review)
                <div class="bg-gray-800 rounded-xl border border-gray-700 p-4">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center">
                                <span class="text-white font-semibold text-sm">{{ strtoupper(substr($review->user->name, 0, 1)) }}</span>
                            </div>
                            <div>
                                <p class="font-semibold">{{ $review->user->name }}</p>
                                <p class="text-xs text-gray-400">{{ $review->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        @if(!$review->is_approved)
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-500/20 text-red-400">FLAGGED</span>
                        @endif
                    </div>

                    <div class="flex items-start gap-4 mb-3">
                        @if($review->product->image)
                            <img src="{{ asset('storage/' . $review->product->image) }}" alt="{{ $review->product->name }}" class="w-16 h-16 rounded-lg object-cover">
                        @else
                            <div class="w-16 h-16 bg-gray-700 rounded-lg"></div>
                        @endif
                        <div class="flex-1">
                            <p class="font-semibold">{{ $review->product->name }}</p>
                            <p class="text-xs text-gray-400">SKU-{{ str_pad($review->product->id, 4, '0', STR_PAD_LEFT) }}</p>
                            <div class="flex items-center gap-1 mt-1">
                            <span class="text-yellow-400">{{ $review->rating }}/5</span>
                            </div>
                        </div>
                    </div>

                    <p class="text-sm text-gray-300 mb-3">{{ \Illuminate\Support\Str::limit($review->comment ?? 'No comment', 150) }}</p>
                    @if($review->comment && strlen($review->comment) > 150)
                        <a href="{{ route('admin.reviews.show', $review) }}" class="text-blue-400 text-sm font-semibold mb-3 inline-block">Read full review</a>
                    @endif

                    <div class="flex gap-2 pt-3 border-t border-gray-700">
                        @if(!$review->is_approved)
                            <form action="{{ route('admin.reviews.update', $review) }}" method="POST" class="flex-1">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="is_approved" value="1">
                                <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg font-semibold text-sm hover:bg-green-700">APPROVE</button>
                            </form>
                        @else
                            <form action="{{ route('admin.reviews.update', $review) }}" method="POST" class="flex-1">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="is_approved" value="0">
                                <button type="submit" class="w-full bg-yellow-600 text-white py-2 rounded-lg font-semibold text-sm hover:bg-yellow-700">RESOLVE</button>
                            </form>
                        @endif
                        <a href="{{ route('admin.reviews.show', $review) }}" class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 text-sm font-semibold">
                            Edit
                        </a>
                        <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm font-semibold">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <p class="text-xl font-bold mb-2">You're all caught up!</p>
                    <p class="text-gray-400">NO MORE PENDING REVIEWS</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($reviews->hasPages())
            <div class="mt-6">
                {{ $reviews->links() }}
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
                <a href="{{ route('admin.users.index') }}" class="flex flex-col items-center text-gray-400">
                    <span class="text-xs font-semibold">Settings</span>
                </a>
            </div>
        </nav>
</body>
</html>
