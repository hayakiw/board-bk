<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Workspace As WorkspaceRequest;
use Illuminate\Support\Str;
use Mail;
use Carbon\Carbon;

use App\Models\Workspace;
use App\Models\AccountWorkspace;
use App\Models\Account;

class WorkspaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workspaces = auth()->guard('web')->user()->workspaces;
        return view('workspace.index', compact('workspaces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $workspace = new Workspace();
        return view('workspace.create', compact('workspaces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkspaceRequest\StoreRequest $request)
    {
        $account = auth()->guard('web')->user();
        // create workspace
        $workspaceData = $request->only([
            'name', 'description'
        ]);
        \DB::beginTransaction();
        if (!($workspace = $account->workspaces()->create($workspaceData, [
            'role' => AccountWorkspace::ROLE_ADMIN,
            'invite_at' => Carbon::now(),
            'entry_at' => Carbon::now(),
        ]))) {
            \DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->withError('登録できませんでした')
                ;
        }

        $accounts = $this->findOrCreateUsersEmail($workspace, $request->only('invites')['invites']);
        if ($accounts) {
            foreach ($accounts as $account) {
                Mail::send(
                    ['text' => 'mail.workspace_invite'],
                    compact('account', 'workspace'),
                    function ($m) use ($account) {
                        $m->from(
                            config('my.mail.from'),
                            config('my.mail.name')
                        );
                        $m->to($account->email);
                        $m->subject(
                            config('my.workspace.invite.mail_subject')
                        );
                    }
                );
            }
        }

        \DB::commit();
        return redirect()
            ->route('workspaces.index')
            ->withInfo('登録しました。')
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
        $workspace = Workspace::findOrFail($id);
        return view('workspace.show', compact('workspace'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $workspace = auth()->guard('web')->user()->Workspace($id);
        return view('workspace.edit', compact('workspace'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WorkspaceRequest\UpdateRequest $request, $id)
    {
        $account = auth()->guard('web')->user();
        // create workspace
        $workspaceData = $request->only([
            'name', 'description'
        ]);
        $workspace = $account->workspace($id);
        \DB::beginTransaction();
        if (!($workspace->update($workspaceData))) {
            \DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->withError('更新できませんでした')
                ;
        }

        \DB::commit();
        return redirect()
            ->route('workspaces.index')
            ->withInfo('登録しました。')
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

    /**
     * @param array $emailes 
     * 
     * @return array App\Models\Account
     */
    private function findOrCreateUsersEmail($workspace, $invites = [])
    {
        $accounts = [];
        if (count($invites)) {
            foreach ($invites as $invite ) {
                $account = Account::where(['email' => $invite['email']])
                    ->first()
                ;

                if (!count($account) > 0) {
                    $token = hash_hmac('sha256', Str::random(40), config('app.key'));
                    $invite['confirmation_token'] = $token;
                    $invite['confirmation_sent_at'] = Carbon::now();
                    $account = Account::create($invite);
                }
                AccountWorkspace::create([
                    'account_id' => $account->id,
                    'workspace_id' => $workspace->id,
                    'role' => AccountWorkspace::ROLE_GENERAL,
                    'invited_at' => Carbon::now(),
                ]);
                $accounts[] = $account;
            }
        }

        return $accounts;
    }
}
