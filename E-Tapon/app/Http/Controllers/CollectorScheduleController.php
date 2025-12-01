<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CollectorScheduleController extends Controller
{
    // LOGIN
    public function showSchedule()
    {
        return view('collector.schedule');
    }
 
}
