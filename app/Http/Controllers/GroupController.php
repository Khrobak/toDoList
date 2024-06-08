<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Group;
use App\Repositories\GroupRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GroupRepository $groupRepository): View
    {
        $groups = $groupRepository->getAllWithRelations();

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
        $data = $request->validated();

        $record = Group::findOrFail($data['id']);

        $record->update($data);

        return response()->json([
            'isSuccessful' => true,
            'message' => 'Data updated successfully'
        ]);
//        return redirect()->route('groups.index')->with('status', 'List updated!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $list): RedirectResponse
    {
        $list->delete();
        return redirect()->route('groups.index')->with('status', 'List deleted!');
    }

    public function filter(Request $request, GroupRepository $groupRepository): View
    {
        $data = $request->get('tags');
        $groups = $groupRepository->getAllWithFilterTag($data);
        return view('groups.index', compact('groups'));
    }
}
