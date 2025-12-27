<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CollectorSuccessController extends Controller
{
    // LOGIN
    public function showSuccess()
    {
        return view('collector.success');
    }
 
}
