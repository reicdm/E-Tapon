<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CollectorSuccessController extends Controller
{
    public function showSuccess($requestId = null)
    {
        return view('collector.success', [
            'message' => session('message', 'Success!'),
            'requestId' => $requestId
        ]);
    }

    public function confirmSuccess(Request $request)
    {
        // Check where the success came from based on session or referer
        $previousUrl = url()->previous();

        // If coming from profile update
        if (str_contains($previousUrl, 'profile')) {
            return redirect()->route('collector.profile');
        }

        // If coming from schedule update
        if (str_contains($previousUrl, 'schedule')) {
            return redirect()->route('collector.schedule');
        }

        // If coming from accepted request update
        if (str_contains($previousUrl, 'acceptedrequest')) {
            return redirect()->route('collector.dashboard');
        }

        // Default fallback to dashboard
        return redirect()->route('collector.dashboard');
    }
}
