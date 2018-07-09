<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workspace;
use App\Models\AccountWorkspace;
use App\Models\Account;

class RootController extends Controller
{
    public function index()
    {
        $active = 'application'; // todo
        $workspaces = Workspace::query()
            ->join('accounts_workspaces', function ($join) {
                $join->on('workspaces.id', '=', 'accounts_workspaces.workspace_id')
                    ->where('accounts_workspaces.account_id', auth()->guard('web')->user()->id)
                    ;
            })
            ->get()
            ;

        // $workspaces = $account->workspaces();

        // return view('home.index', compact('workspaces'));

        return view('root.index', compact('workspaces'))
            ->with([
            'active' => $active,
        ]);
    }
}
