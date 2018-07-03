<?php

namespace App\Http\Controllers;

class RootController extends Controller
{
    public function index()
    {
        $active = 'application'; // todo

        return view('root.index')
            ->with([
            'active' => $active,
        ]);
    }
}
