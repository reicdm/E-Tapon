<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CollectorRequestController extends Controller
{
    public function showRequest()
    {
        return view('collector.request');
    }
 
}
