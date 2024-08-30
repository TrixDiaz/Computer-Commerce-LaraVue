<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AdminBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $brandsQuery = Brand::query();

        $this->applySearch($brandsQuery, $request->search);
        $this->applySort($brandsQuery, $request->sort);
        $this->applyFilter($brandsQuery, $request->filter);

        $brands = BrandResource::collection($brandsQuery->paginate(10));

        return inertia('Admin/Brands/Index', [
            'brands' => $brands,
            'search' => $request->search ?? '',
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

    protected function applyFilter(Builder $query, $filter)
    {
        return $query->when($filter, function ($query, $filter) {
            $is_active = explode(',', $filter);
            $query->whereIn('is_active', $is_active);
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
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
