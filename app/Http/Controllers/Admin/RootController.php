<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RootController extends Controller
{
    public function index()
    {
        $active = 'application'; // todo

        return view('admin.root.index')
            ->with([
            'active' => $active,
        ]);
    }
}
