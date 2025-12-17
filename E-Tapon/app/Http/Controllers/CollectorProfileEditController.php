<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CollectorProfileEditController extends Controller
{
    public function showProfileEdit()
    {
        return view('collector.profileedit');
    }
 
}
