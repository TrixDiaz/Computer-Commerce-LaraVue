<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\BrandResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $this->applyCategoryFilter($productsQuery, $request->filter);
        $this->applyBrandFilter($productsQuery, $request->filter);

        $products = ProductResource::collection($productsQuery->paginate(10));
        $category = CategoryResource::collection(Category::all());
        $brands = BrandResource::collection(Brand::all());

        return inertia('Admin/Products/Index', [
            'products' => $products,
            'search' => $request->search ?? '',
            'categories' => $category,
            'brands' => $brands,
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


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CategoryResource::collection(Category::all());
        $brands = BrandResource::collection(Brand::all());

        return inertia('Admin/Products/Create', [
            'categories' => $categories,
            'brands' => $brands,
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
    
        // Get the authenticated user's ID and add it to the data array
        $data['user_id'] = auth()->id();
    
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
