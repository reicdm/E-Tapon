<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CollectorReqDetailsController extends Controller
{
    // LOGIN
    public function showRequestDetails()
    {
        return view('collector.reqdetails');
    }
 
}
