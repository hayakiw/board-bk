<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;

use App\Http\Requests\Board As BoardRequest;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($wsid, $grpid)
    {
        $workspace = auth()->guard('web')->user()->workspace($wsid)->firstOrFail();
        $group = $workspace->group($grpid)->firstOrFail();
        $boards = $group->boards;
        return view('board.index', compact('workspace', 'group', 'boards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($wsid, $grpid)
    {
        $workspace = auth()->guard('web')->user()->workspace($wsid)->firstOrFail();
        $group = $workspace->group($grpid)->firstOrFail();
        $board = new Board();
        return view('board.create', compact('workspace', 'group', 'board'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BoardRequest\StoreRequest $request, $wsid, $grpid)
    {
        $workspace = auth()->guard('web')->user()->workspace($wsid)->firstOrFail();
        $group = $workspace->group($grpid)->firstOrFail();

        $boardData = $request->only(['title', 'description']);
        $boardData['group_id'] = $group->id;

        if ($board = $group->boards()->create($boardData)) {
            return redirect()
                ->route('workspaces.groups.boards.show', [
                    'workspace' => $workspace->id,
                    'group' => $group->id,
                    'board' => $board->id,
                    ])
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
    public function show($wsid, $grpid, $id)
    {
        $workspace = auth()->guard('web')->user()->workspace($wsid)->firstOrFail();
        $group = $workspace->group($grpid)->firstOrFail();
        $board = $group->board($id)->firstOrFail();
        $comments = $board->comments;
        return view('board.show', compact('workspace', 'group', 'board', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($wsid, $grpid, $id)
    {
        $workspace = auth()->guard('web')->user()->workspace($wsid)->firstOrFail();
        $group = $workspace->group($grpid)->firstOrFail();
        $board = $group->board($id)->firstOrFail();
        return view('board.edit', compact('workspace', 'group', 'group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BoardRequest\UpdateRequest $request, $wsid, $grpid, $id)
    {
        $workspace = auth()->guard('web')->user()->workspace($wsid)->firstOrFail();
        $group = $workspace->group($grpid)->firstOrFail();
        $board = $group->board($id)->firstOrFail();
        
        return redirect()
            ->back()
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
