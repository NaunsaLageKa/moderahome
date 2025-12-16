<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ReviewController;
use App\Models\Category;
use App\Models\Product;

Route::get('/', function () {
    return view('home');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $categories = Category::where('is_active', true)->get();
        $featuredProducts = Product::where('is_active', true)
            ->where('is_featured', true)
            ->with('category')
            ->take(4)
            ->get();
        
        return view('dashboard', compact('categories', 'featuredProducts'));
    })->name('dashboard');

    Route::get('/categories/{category}', function (string $category) {
        $categoryModel = Category::where('slug', $category)->where('is_active', true)->firstOrFail();
        
        $products = Product::where('category_id', $categoryModel->id)
            ->where('is_active', true)
            ->latest()
            ->get();
        
        // Get all active categories for the category buttons
        $allCategories = Category::where('is_active', true)->get();
        
        // Pad to 16 products and chunk into rows of 4
        $paddedProducts = $products->pad(16, null)->chunk(4);
        
        return view('category', [
            'category' => $categoryModel,
            'products' => $paddedProducts,
            'allCategories' => $allCategories,
        ]);
    })->name('category.show');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('orders', OrderController::class)->except(['create', 'store']);
    Route::resource('users', UserController::class)->except(['create', 'store']);
    Route::resource('reviews', ReviewController::class)->except(['create', 'store']);
});
