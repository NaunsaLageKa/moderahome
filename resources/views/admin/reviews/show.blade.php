<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Details - ModeraHome</title>
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
            <h1 class="text-2xl font-bold">Review Details</h1>
            <a href="{{ route('admin.reviews.index') }}" class="text-gray-400 hover:text-white font-semibold">
                Close
            </a>
        </div>
    </header>

    <div class="max-w-4xl mx-auto px-6 py-6">
        <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 mb-6">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-16 h-16 rounded-full bg-blue-600 flex items-center justify-center">
                    <span class="text-white font-semibold text-xl">{{ strtoupper(substr($review->user->name, 0, 1)) }}</span>
                </div>
                <div>
                    <p class="font-bold text-lg">{{ $review->user->name }}</p>
                    <p class="text-sm text-gray-400">{{ $review->created_at->diffForHumans() }}</p>
                </div>
            </div>

            <div class="mb-6">
                <p class="text-sm text-gray-400 mb-2">Product</p>
                <div class="flex items-center gap-4">
                    @if($review->product->image)
                        <img src="{{ asset('storage/' . $review->product->image) }}" alt="{{ $review->product->name }}" class="w-20 h-20 rounded-lg object-cover">
                    @else
                        <div class="w-20 h-20 bg-gray-700 rounded-lg"></div>
                    @endif
                    <div>
                        <p class="font-semibold">{{ $review->product->name }}</p>
                        <p class="text-sm text-gray-400">SKU-{{ str_pad($review->product->id, 4, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <p class="text-sm text-gray-400 mb-2">Rating</p>
                <p class="text-yellow-400 font-semibold text-lg">{{ $review->rating }}/5</p>
            </div>

            <div class="mb-6">
                <p class="text-sm text-gray-400 mb-2">Comment</p>
                <p class="text-gray-300 bg-gray-700 rounded-lg p-4">{{ $review->comment ?? 'No comment provided' }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-400 mb-2">Approval Status</p>
                <form action="{{ route('admin.reviews.update', $review) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <label class="flex items-center justify-between p-4 bg-gray-700 rounded-xl border border-gray-600 cursor-pointer">
                        <span class="font-semibold">Approve Review</span>
                        <input type="checkbox" name="is_approved" value="1" {{ $review->is_approved ? 'checked' : '' }} onchange="this.form.submit()" class="w-11 h-6 bg-gray-600 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-800 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600 relative">
                    </label>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
