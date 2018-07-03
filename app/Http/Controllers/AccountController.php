<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Account as AccountRequest;
use Carbon\Carbon;
use App\Models\Account;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $account = new Account;
        return view('account.create')
            ->with([
                'account' => $account
            ])
        ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountRequest\StoreRequest $request)
    {
        $accountData = $this->getAccountData($request);
        $accountData['password'] = bcrypt($accountData['password']);

        if ($account = Account::create($accountData)) {
            $request->session()->flash('info', '登録しました。');
            return redirect()
                ->route('accounts.index')
            ;
        }

        return redirect()
            ->back()
            ->withInput($accountData)
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
