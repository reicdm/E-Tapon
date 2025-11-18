<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CollectorDashboardController extends Controller
{
    public function dashboard()
    {
        return view('collector.dashboard');
    }
}
