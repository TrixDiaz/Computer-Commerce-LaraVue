<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\BrandResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SeriesResource;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Series;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $productsQuery = Product::query();

        $this->applySearch($productsQuery, $request->search);
        $this->applySort($productsQuery, $request->sort);
        $this->applyCategoryFilter($productsQuery, $request->filterCategory);
        $this->applyBrandFilter($productsQuery, $request->filterBrand);
        $this->applyShowOnlyFilter($productsQuery, $request->showOnly);

        $products = ProductResource::collection($productsQuery->paginate(10));
        $category = CategoryResource::collection(Category::all());
        $brands = BrandResource::collection(Brand::all());

        return inertia('Admin/Products/Index', [
            'products' => $products,
            'search' => $request->search ?? '',
            'categories' => $category,
            'brands' => $brands,
            'showOnly' => $request->showOnly ?? '',
        ]);
    }

    protected function applySearch(Builder $query, $search)
    {
        return $query->when($search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        });
    }

    protected function applySort(Builder $query, $sort)
    {
        return $query->when($sort, function ($query, $sort) {
            $direction = $sort === 'asc' ? 'asc' : 'desc';
            $query->orderBy('name', $direction);
        });
    }

    protected function applyCategoryFilter(Builder $query, $filter)
    {
        return $query->when($filter, function ($query, $filter) {
            $is_active = explode(',', $filter);
            $query->whereIn('category_id', $is_active);
        });
    }

    protected function applyBrandFilter(Builder $query, $filter)
    {
        return $query->when($filter, function ($query, $filter) {
            $is_active = explode(',', $filter);
            $query->whereIn('brand_id', $is_active);
        });
    }

    protected function applyShowOnlyFilter(Builder $query, $filter)
    {
        return $query->when($filter, function ($query, $filter) {
            switch ($filter) {
                case 'featured':
                    $query->where('is_featured', true);
                    break;
                case 'sale':
                    $query->where('is_sale', true);
                    break;
                case 'new':
                    $query->where('is_new', true);
                    break;
                case 'active':
                    $query->where('is_active', true);
                    break;
                case 'inactive':
                    $query->where('is_active', false);
                    break;
            }
        });
    }

   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CategoryResource::collection(Category::all());
        $brands = BrandResource::collection(Brand::all());
        $series = SeriesResource::collection(Series::all());

        return inertia('Admin/Products/Create', [
            'categories' => $categories,
            'brands' => $brands,
            'series' => $series,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        if ($request->hasFile('hover_image')) {
            $data['hover_image'] = $request->file('hover_image')->store('images', 'public');
        }

        $data['user_id'] = Auth::id();

        Product::create($data);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = CategoryResource::collection(Category::all());
        $brands = BrandResource::collection(Brand::all());
        $series = SeriesResource::collection(Series::all());

        return inertia('Admin/Products/Edit', [
            'product' => ProductResource::make($product),
            'categories' => $categories,
            'brands' => $brands,
            'series' => $series,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('images', 'public');
        } else {
            // Keep the existing image if no new file is uploaded
            unset($data['image']);
        }

        // Handle boolean fields
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_sale'] = $request->boolean('is_sale');
        $data['is_new'] = $request->boolean('is_new');
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('hover_image')) {
            // Delete old image if exists
            if ($product->hover_image) {
                Storage::disk('public')->delete($product->hover_image);
            }
            $data['hover_image'] = $request->file('hover_image')->store('images', 'public');
        } else {
            // Keep the existing image if no new file is uploaded
            unset($data['hover_image']);
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index');
    }
}
