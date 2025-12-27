<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CollectorConfirmController extends Controller
{
    // LOGIN
    public function showConfirm()
    {
        return view('collector.confirm');
    }
 
}
