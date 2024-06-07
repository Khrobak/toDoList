<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Http\Resources\GroupResource;
use App\Http\Filters\GroupFilter;
use App\Models\Group;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {

        $listCollection = Group::query()
            ->select(['title', 'user_id', 'id', 'created_at'])
            ->with('tasks.tags')
            ->orderByDesc('created_at')
            ->get();
        $filter = app()->make(GroupFilter::class, ['queryParams'=> array_filter($listCollection->toArray())]);
       $groups = Group::filter($filter);
        $groups = GroupResource::collection($listCollection);
        return view('groups.index', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGroupRequest $request): JsonResponse
    {
        Group::create($request->validated());
        return response()->json([
            'isSuccessful' => true,
            'message' => 'List stored successfully',
        ]);
    }


    public function update(UpdateGroupRequest $request)
    {
        // Get the data from the request
        $data = $request->all();

        // Find the record in the database based on its ID
        $record = Group::findOrFail($data['id']);

        // Update the record with the new data
        $record->update($request->validated());

        // Return a response indicating success
        return response()->json([
            'isSuccessful' => true,
            'message' => 'Data updated successfully'
        ]);
//        return redirect()->route('groups.index')->with('status', 'List updated!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateOld(UpdateGroupRequest $request, Group $list): RedirectResponse
    {
        $list->update($request->validated());
        return redirect()->route('groups.index')->with('status', 'List updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $list): RedirectResponse
    {
        $list->delete();
        return redirect()->route('groups.index')->with('status', 'List deleted!');
    }
}
