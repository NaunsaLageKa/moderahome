<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\UserProfileController;
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

    // Product Routes
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('product.show');

    // Search Routes
    Route::get('/search', [SearchController::class, 'search'])->name('search');

    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');

    // Checkout Routes
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // Order Routes (User-facing)
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{order}/confirmation', [OrderController::class, 'confirmation'])->name('orders.confirmation');

    // Wishlist Routes
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add/{product}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{wishlist}', [WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::post('/wishlist/move-to-cart/{wishlist}', [WishlistController::class, 'moveToCart'])->name('wishlist.move-to-cart');

    // Profile Routes
    Route::get('/profile', [UserProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [UserProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/change-password', [UserProfileController::class, 'changePassword'])->name('profile.change-password');
    Route::post('/profile/addresses', [UserProfileController::class, 'storeAddress'])->name('profile.addresses.store');
    Route::put('/profile/addresses/{address}', [UserProfileController::class, 'updateAddress'])->name('profile.addresses.update');
    Route::delete('/profile/addresses/{address}', [UserProfileController::class, 'deleteAddress'])->name('profile.addresses.destroy');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    Route::resource('products', AdminProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('orders', AdminOrderController::class)->except(['create', 'store']);
    Route::resource('users', UserController::class)->except(['create', 'store']);
    Route::resource('reviews', ReviewController::class)->except(['create', 'store']);
});
