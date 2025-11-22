<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CollectorPassController extends Controller
{
    public function showForgotPass()
    {
        return view('auth.collector.c_forgotpass');
    }

    /*public function save()
    {
        return redirect()->route('collector.login')
    }*/
}
