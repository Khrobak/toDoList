<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Group;
use App\Repositories\GroupRepository;
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
    public function store(StoreGroupRequest $request)
    {
        Group::create($request->validated());
        return response()->json([
            'isSuccessful' => true,
            'message' => 'List stored successfully',
        ]);
    }


    public function update(UpdateGroupRequest $request,Group $group)
    {
        $data = $request->validated();
        $group->title = $data['title'];
        $group->user_id = $data['user_id'];
        $group->save();
        return redirect()->route('groups.index')->with('status', 'List updated!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group): RedirectResponse
    {
        $group->delete();
        return redirect()->route('groups.index')->with('status', 'List deleted!');
    }

    public function filter(Request $request, GroupRepository $groupRepository): View
    {
        $data = $request->get('tags');
        $groups = $groupRepository->getAllWithFilterTag($data);
        return view('groups.index', compact('groups'));
    }

    public function search(GroupRepository $groupRepository, Request $request): View
    {
        $groups = $groupRepository->getAllWithSearching($request->get('search'));
        return view('groups.index', compact('groups'));
    }
}
