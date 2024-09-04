<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTrendingRequest;
use App\Http\Resources\TrendingResource;
use App\Models\Trending;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AdminTrendingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $trendingsQuery = Trending::query();

        $this->applySearch($trendingsQuery, $request->search);
        $this->applySort($trendingsQuery, $request->sort);
        $this->applyFilter($trendingsQuery, $request->filter);

        $trendings = TrendingResource::collection($trendingsQuery->paginate(10));

        return inertia('Admin/Trending/Index', [
            'trendings' => $trendings,
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
        return inertia('Admin/Trending/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTrendingRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        Trending::create($data);

        return redirect()->route('trending.index');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $trendings = TrendingResource::collection(Trending::all()->where('is_active', 1));

        return response()->json($trendings);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trending $trending)
    {
        return inertia('Admin/Trending/Edit', [
            'trending' => new TrendingResource($trending),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trending $trending)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'required|boolean',
        ]);

        $data = $request->only(['name', 'is_active']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }
    
        $trending->update($data);

        return redirect()->route('trending.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trending $trending)
    {
        $trending->delete();

        return redirect()->route('trending.index');
    }
}
