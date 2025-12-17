<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CollectorAcceptedReqController extends Controller
{
    // LOGIN
    public function showAcceptedRequest()
    {
        return view('collector.acceptedreq');
    }
 
}
