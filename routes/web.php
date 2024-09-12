<?php

use App\Http\Controllers\AdminAnnouncementController;
use App\Http\Controllers\AdminBrandController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminTrendingController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'products' => ProductResource::collection(Product::inRandomOrder()->limit(10)->get()),
        'featuredProducts' => ProductResource::collection(Product::inRandomOrder()->where('is_featured', 1 && 'is_active', 1)->limit(10)->get()),
        'saleProducts' => ProductResource::collection(Product::inRandomOrder()->where('is_sale', 1 && 'is_active', 1)->limit(10)->get()),
        'newProducts' => ProductResource::collection(Product::inRandomOrder()->where('is_new', 1 && 'is_active', 1)->limit(10)->get()),
        'categories' => CategoryResource::collection(Category::where('is_active', 1)->get()),
    ]);
})->name('welcome');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'products' => ProductResource::collection(Product::inRandomOrder()->limit(10)->get()),
        'featuredProducts' => ProductResource::collection(Product::inRandomOrder()->where('is_featured', 1 && 'is_active', 1)->limit(10)->get()),
        'saleProducts' => ProductResource::collection(Product::inRandomOrder()->where('is_sale', 1 && 'is_active', 1)->limit(10)->get()),
        'newProducts' => ProductResource::collection(Product::inRandomOrder()->where('is_new', 1 && 'is_active', 1)->limit(10)->get()),
        'categories' => CategoryResource::collection(Category::where('is_active', 1)->get()),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/catalog', CatalogController::class);
    Route::resource('/cart', CartController::class);
    Route::resource('/checkout', CheckoutController::class);
    Route::resource('/product', ProductController::class);
});

Route::middleware(['auth', config('sanctum.middleware.admin')])->prefix('admin')->group(function () {
    Route::resource('/', AdminController::class);
    Route::resource('/announcement', AdminAnnouncementController::class);
    Route::resource('/users', AdminUserController::class);
    Route::resource('/products', AdminProductController::class);
    Route::resource('/brands', AdminBrandController::class);
    Route::resource('/categories', AdminCategoryController::class);
    Route::resource('/trending', AdminTrendingController::class);
});

require __DIR__ . '/auth.php';
