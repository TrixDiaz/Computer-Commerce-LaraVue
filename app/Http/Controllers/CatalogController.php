<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrandResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $productsQuery = Product::query();
        $this->applySort($productsQuery, $request->sort);
        $this->applyCategoryFilter($productsQuery, $request->filterCategory);
        $this->applyBrandFilter($productsQuery, $request->filterBrand);
        
        $products = ProductResource::collection($productsQuery->paginate(8));
        $brands = BrandResource::collection(Brand::all());
        $categories = CategoryResource::collection(Category::all());
        return inertia('Catalog', [
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    protected function applySort(Builder $query, $sort)
    {
        return $query->when($sort, function ($query, $sort) {
            switch ($sort) {
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'date_desc':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'date_asc':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'discount_desc':
                    $query->orderByRaw('(price - sale_price) / price DESC');
                    break;
                case 'featured_products' :
                    $query->where('is_featured', true);
                    break;
                case 'new_products' :
                    $query->where('is_new', true)->orderBy('created_at', 'desc');
                    break;
                case 'sale_products' :
                    $query->where('is_sale', true);
                    break;
                default:
                    $query->orderBy('name', 'asc');
            }
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
