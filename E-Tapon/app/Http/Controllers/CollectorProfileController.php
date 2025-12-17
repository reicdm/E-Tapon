<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CollectorProfileController extends Controller
{
    public function showProfile()
    {
        return view('collector.profile');
    }
 
}
