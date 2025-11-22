<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChooseUserController extends Controller
{
    public function showChooseUser()
    {
        return view('general.g_chooseuser');
    }

    public function store(Request $request)
    {
        $selected = $request->user_type;

        if ($selected === 'resident') {
            return redirect()->route('resident.login.show');
        }

        if ($selected === 'collector') {
            return redirect()->route('collector.login.show');
        }

        return back()->with('error', 'Invalid user type.');
    }
}
