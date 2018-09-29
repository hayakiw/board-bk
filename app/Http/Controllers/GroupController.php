<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workspace;
use App\Models\Group;

use App\Http\Requests\Group As GroupRequest;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($wsid)
    {
        $workspace = Workspace::findOrFail($wsid);
        $groups = Group::all();
        return view('group.index', compact('workspace', 'groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($wsid)
    {
        $workspace = Workspace::findOrFail($wsid);
        $group = new Group();
        return view('group.create', compact('workspace', 'group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupRequest\StoreRequest $request, $wsid)
    {
        $workspace = Workspace::findOrFail($wsid);
        $groupData = $request->only(['title', 'description']);
        $groupData['workspace_id'] = $workspace->id;

        if ($group = Group::create($groupData)) {
            return redirect()
                ->route('workspaces.show', $workspace->id)
                ->with(['info' => '登録しました。'])
                ;
        }

        return redirect()
            ->back()
            ->withError('失敗しました。')
            ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($wsid, $id)
    {
        $workspace = Workspace::findOrFail($wsid);
        $group = Group::findOrFail($id);
        return view('group.show', compact('workspace', 'group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($wsid, $id)
    {
        $workspace = auth()->guard('web')->user()->Workspace($wsid)->firstOrFail();
        $group = $workspace->Group($id)->firstOrFail();
        return view('group.edit', compact('workspace', 'group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GroupRequest\UpdateRequest $request, $wsid, $id)
    {
        $workspace = auth()->guard('web')->user()->Workspace($wsid)->firstOrFail();
        $group = $workspace->Group($id)->firstOrFail();
        $groupData = $request->only(['title', 'description']);

        if ($group->update($groupData)) {
            return redirect()
                ->route('workspaces.groups.show', ['workspace' => $workspace->id, 'group' => $group->id])
                ->with(['info' => '登録しました。'])
                ;
        }

        return redirect()
            ->back()
            ->withError('失敗しました。')
            ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
