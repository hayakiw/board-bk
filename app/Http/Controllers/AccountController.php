<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mail;
use App\Http\Requests\Account as AccountRequest;
use Carbon\Carbon;
use App\Models\Account;
use App\Models\Workspace;
use App\Models\AccountWorkspace;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $accountBuilder = Account::query();
        $search = $this->getSearchData($request);
        $accountBuilder = $this->addSerchCondition($accountBuilder, $search);
        $accounts = $accountBuilder->orderBy('id', 'asc')->paginate(100)->setPath('');

        return view('account.index')
            ->with([
                'accounts' => $accounts,
                'search' => $search,
            ])
        ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('account.create');
    }
    
    public function store(AccountRequest\StoreRequest $request)
    {
        $accountData = $request->only('email');

        $token = hash_hmac('sha256', Str::random(40), config('app.key'));
        $accountData['confirmation_token'] = $token;
        $accountData['confirmation_sent_at'] = Carbon::now();

        \DB::beginTransaction();

        if ($account = Account::create($accountData)) {
            \DB::commit();

            Mail::send(
                ['text' => 'mail.account_created'],
                compact('token', 'account'),
                function ($m) use ($account) {
                    $m->from(
                        config('my.mail.from'),
                        config('my.mail.name')
                    );
                    $m->to($account->email);
                    $m->subject(
                        config('my.account.created.mail_subject')
                    );
                }
            );

            return redirect()
                ->route('account.create')
                ->with(['info' => '確認メールを送信しましたのでご確認ください。'])
            ;
        }

        \DB::rollBack();

        return redirect()
            ->back()
            ->withInput($accountData)
        ;
    }

    public function confirm(Request $request, $token, $wsid = null)
    {
        $account = Account::where('confirmation_token', $token)
            ->where('confirmation_sent_at', '>', Carbon::now()->subDay(config('my.reset_password_request.expires_in')))
            ->firstOrFail()
            ;

        if ($account) {
            return view('account.confirm', compact('account', 'token', 'wsid'));
        }

        return redirect()
            ->route('root.index')
            ->withError('不正なアクセスです。')
            ;
    }

    public function activate(AccountRequest\ActivateRequest $request)
    {
        $accountData = $request->only([
            'last_name', 'first_name', 'last_name_kana', 'first_name_kana',
            'password',
        ]);

        $accountData['confirmation_token'] = null;
        $accountData['confirmation_sent_at'] = null;
        $accountData['confirmated_at'] = Carbon::now();
        $accountData['password'] = bcrypt($accountData['password']);

        $token = $request->only('confirmation_token');
        $invite_workspace_id = $request->only('workspace_id');

        $errors = [];

        if (empty($token['confirmation_token'])) {
            $errors['confirmation_token'] = '不正なアクセスです。';
        }

        if (!$errors) {

            $account = Account::where('confirmation_token', $token['confirmation_token'])
                ->where('confirmation_sent_at', '>', Carbon::now()->subDay(config('my.reset_password_request.expires_in')))
                ->first()
                ;
                
            \DB::beginTransaction();

            if ($account && $account->update($accountData)) {
                if ($invite_workspace_id && $account->workspace($invite_workspace_id)->invite_at) {
                    // invite workspace
                    $workspace = $account->workspace($invite_workspace_id);
                    $accountWorkSpace = AccountWorkspace::find('workspace_id', $invite_workspace_id);
                    if (!$accountWorkSpace) {
                        $errors[] = 'アクセスできませんでした。';
                    } elseif (!($accountWorkSpace->update([
                        'entry_at' => Carbon::now(),
                    ]))) {
                        $errors[] = 'アクセスできませんでした。';
                    }
                } else {
                    // create workspace
                    $workspaceData = $request->only('workspace');
                    if (!($workspace = Workspace::create($workspaceData['workspace']))) {
                        $errors[] = 'ワークスペースを登録できませんでした。';
                    }

                    if (!$errors) {
                        $relateData = [
                            'account_id' => $account->id,
                            'workspace_id' => $workspace->id,
                            'role' => AccountWorkspace::ROLE_ADMIN,
                            'invite_at' => Carbon::now(),
                        ];
                        if (!(AccountWorkspace::create($relateData))) {
                            $errors[] = 'ワークスペースを登録できませんでした。';
                        }
                    }
                }

                if (!$errors) {
                    \DB::commit();
                    $credentials = [
                        'email' => $account->email,
                        'password' => $account->password,
                    ];
                    if (auth()->guard('web')->attempt($credentials, $remember)) {
                        return redirect()
                            ->route('workspaces.show', ['id' => $workspace->id])
                            ->with('info', 'ログインしました。');
                    }
                    return redirect()
                        ->route('root.index')
                        ->with(['info' => '会員情報を登録しました。']);
                }
            }

            \DB::rollBack();

        }

        return redirect()
            ->back()
            ->withError('登録に失敗しました。')
            ;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $account = Account::findOrFail($id);
        return view('account.edit')
            ->with('account', $account)
        ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AccountRequest\UpdateRequest $request, $id)
    {
        $account = Account::findOrFail($id);

        $accountData = $this->getAccountData($request);

        if(!empty($accountData['password'])){
          $accountData['password'] = bcrypt($accountData['password']);
        }else{
          unset($accountData['password']);
        }

        if ($account->update($accountData)){
            return redirect()
                ->route('accounts.index', $request->query())
                ->with(['info' => '更新しました。'])
            ;
        }

        return redirect()
            ->back()
            ->withInput($accountData)
        ;
    }

    // 管理者向け
    public function invite_form()
    {
        return view('account.invite');
    }

    public function invite(AccountRequest\InviteRequest $request)
    {
        // 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Account::destroy($id);

        return redirect()
            ->route('accounts.index')
            ->with(['info' => '削除しました。']);
    }

    /*
     * @param  \Illuminate\Http\Response
     * @return array  $accountData
     */
    private function getAccountData($request)
    {
        $accountData = $request->only([
            'userid',
            'password',
        ]);

        $accountData['permit_application'] = $request->input('permit_application')? 1 : 0;
        $accountData['permit_loan'] = $request->input('permit_loan')? 1 : 0;
        $accountData['permit_refund'] = $request->input('permit_refund')? 1 : 0;
        $accountData['permit_statistic'] = $request->input('permit_statistic')? 1 : 0;
        $accountData['permit_master'] = $request->input('permit_master')? 1 : 0;
        $accountData['permit_negotiate'] = $request->input('permit_negotiate')? 1 : 0;
        $accountData['permit_account'] = $request->input('permit_account')? 1 : 0;

        return $accountData;
    }


    private function getSearchData($request)
    {
        // 検索項目
        $search = $request->only([
            'id',
        ]);

        return $search;
    }

    private function addSerchCondition($accountBuilder, $search)
    {

        if (isset($search['id']) && $search['id'] != ''){
            $accountBuilder
                ->where('id', 'like', "%{$search['id']}%")
            ;
        }

        if (isset($search['userid']) && $search['userid'] != ''){
            $accountBuilder
                ->where('userid', 'like', "%{$search['userid']}%")
            ;
        }

        return $accountBuilder;
    }

}
