<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('user', 'product')->latest()->paginate(15);
        return view('admin.reviews.index', compact('reviews'));
    }

    public function show(Review $review)
    {
        $review->load('user', 'product');
        return view('admin.reviews.show', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        $validated = $request->validate([
            'is_approved' => 'boolean',
        ]);

        $validated['is_approved'] = $request->has('is_approved');
        $review->update($validated);

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review updated successfully.');
    }

    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review deleted successfully.');
    }
}
