<?php

namespace App\Http\Controllers;

use App\Http\Resources\AnnouncementResource;
use App\Models\Announcement;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AdminAnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $announcementQuery = Announcement::query();

        $this->applySearch($announcementQuery, $request->search);
        $this->applySort($announcementQuery, $request->sort);
        $this->applyFilter($announcementQuery, $request->filter);

        $announcement = AnnouncementResource::collection($announcementQuery->paginate(10));

        return inertia('Admin/Announcement/Index', [
           'announcements' => $announcement,
           'search' => $request->search ?? '', 
        ]);
    }

    protected function applySearch(Builder $query, $search)
    {
        return $query->when($search, function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%');
        });
    }

    protected function applySort(Builder $query, $sort)
    {
        return $query->when($sort, function ($query, $sort) {
            $direction = $sort === 'asc' ? 'asc' : 'desc';
            $query->orderBy('title', $direction);
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
        return inertia('Admin/Announcement/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|lowercase|max:255',
            'description' => 'required|string',
            'is_active' => 'required|boolean',
        ]);

        Announcement::create($request->all());

        return redirect()->route('announcement.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcement)
    
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announcement $announcement)
    {
        return inertia('Admin/Announcement/Edit', [
            'announcement' => new AnnouncementResource($announcement),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Announcement $announcement)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'is_active' => 'required|boolean',
        ]);

        $announcement->update($request->all());

        return redirect()->route('announcement.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return redirect()->route('announcement.index');
    }
}
