<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResidentDashboardController extends Controller
{
    public function dashboard()
    {
        return view('resident.dashboard');
    }

    public function schedule()
    {
        return view('resident.schedule');
    }

    public function request()
    {
        return view('resident.request');
    }
}