<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\Comment As CommentRequest;

use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest\StoreRequest $request, $wsid, $grpid, $type, $type_id)
    {
        $workspace = auth()->guard('web')->user()->workspace($wsid)->firstOrFail();
        $group = $workspace->group($grpid)->firstOrFail();
        $var_type = $group->$type($type_id)->firstOrFail();

        \DB::beginTransaction();
        $commentData = $request->only(['comment', 'commentable_type']);
        $commentData['commentable_id'] = $type_id;
        $commentData['account_id'] = auth()->guard('web')->user()->id;
        $commentData['seq'] = $var_type->getSequence();

        if ($comment = $var_type->comments()->create($commentData)) {
            \DB::commit();
            return redirect()
                ->back()
                ->with(['info' => '登録しました。'])
                ;
        }
        \DB::rollBack();

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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($wsid, $grpid, $type, $type_id, $id)
    {
        $workspace = auth()->guard('web')->user()->workspace($wsid)->firstOrFail();
        $group = $workspace->group($grpid)->firstOrFail();
        $var_type = $group->$type($type_id)->firstOrFail();

        $params = [
            'workspace' => $workspace->id, 
            'group' => $group->id, 
            'type' => $type,
            'id' => $var_type->id, 
            'comment' => $id
        ];

        $comment = Comment::findOrFail($id);

        return view('comment.edit', compact('params', 'comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommentRequest\UpdateRequest $request, $wsid, $grpid, $type, $type_id, $id)
    {
        $workspace = auth()->guard('web')->user()->workspace($wsid)->firstOrFail();
        $group = $workspace->group($grpid)->firstOrFail();
        $var_type = $group->$type($type_id)->firstOrFail();

        $inputData = $request->only([
            'comment',
        ]);
        $comment = Comment::findOrFail($id);

        // TODO: viewを返すように変更する
        if ($comment->update($inputData)) {
            return redirect()
                ->back();
        }

        return redirect()
            ->back()
            ->withErrors('更新できませんでした。');
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
