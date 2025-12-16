<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('q', '');
        $categoryId = $request->get('category');
        $minPrice = $request->get('min_price');
        $maxPrice = $request->get('max_price');
        $availability = $request->get('availability'); // 'in_stock', 'out_of_stock', 'all'
        $sortBy = $request->get('sort', 'newest'); // 'newest', 'price_low', 'price_high', 'name_asc', 'name_desc'

        $products = Product::where('is_active', true)
            ->when($query, function ($q) use ($query) {
                $q->where(function ($queryBuilder) use ($query) {
                    $queryBuilder->where('name', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%");
                });
            })
            ->when($categoryId, function ($q) use ($categoryId) {
                $q->where('category_id', $categoryId);
            })
            ->when($minPrice, function ($q) use ($minPrice) {
                $q->where('price', '>=', $minPrice);
            })
            ->when($maxPrice, function ($q) use ($maxPrice) {
                $q->where('price', '<=', $maxPrice);
            })
            ->when($availability === 'in_stock', function ($q) {
                $q->where('stock', '>', 0);
            })
            ->when($availability === 'out_of_stock', function ($q) {
                $q->where('stock', '=', 0);
            })
            ->with('category')
            ->when($sortBy === 'price_low', function ($q) {
                $q->orderBy('price', 'asc');
            })
            ->when($sortBy === 'price_high', function ($q) {
                $q->orderBy('price', 'desc');
            })
            ->when($sortBy === 'name_asc', function ($q) {
                $q->orderBy('name', 'asc');
            })
            ->when($sortBy === 'name_desc', function ($q) {
                $q->orderBy('name', 'desc');
            })
            ->when($sortBy === 'newest', function ($q) {
                $q->latest();
            })
            ->paginate(16)
            ->appends($request->except('page'));

        $categories = Category::where('is_active', true)->get();

        // Get price range for filter
        $priceRange = Product::where('is_active', true)
            ->selectRaw('MIN(price) as min_price, MAX(price) as max_price')
            ->first();

        return view('search', compact('products', 'query', 'categories', 'categoryId', 'minPrice', 'maxPrice', 'availability', 'sortBy', 'priceRange'));
    }
}
