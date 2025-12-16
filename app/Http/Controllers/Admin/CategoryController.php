<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(15);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        Category::create($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        
        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        $category->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
