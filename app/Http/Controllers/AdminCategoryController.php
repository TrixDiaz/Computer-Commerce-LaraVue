<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categoryQuery = Category::query();

        $this->applySearch($categoryQuery, $request->search);
        $this->applySort($categoryQuery, $request->sort);
        $this->applyFilter($categoryQuery, $request->filter);

        $categories = CategoryResource::collection($categoryQuery->paginate(10));

        return inertia('Admin/Category/Index', [
           'categories' => $categories,
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
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
