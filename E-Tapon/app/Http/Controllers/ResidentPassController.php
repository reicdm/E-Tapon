<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResidentPassController extends Controller
{
    public function showForgotPass()
    {
        return view('auth.resident.r_forgotpass');
    }

    /*public function save()
    {
        return redirect()->route('collector.login')
    }*/
}
