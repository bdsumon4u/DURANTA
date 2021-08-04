<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PhoneVerificationPromptController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if ($request->user()->hasVerifiedPhone()) {
            return redirect()->intended(config('fortify.home'));
        }

        return Inertia::render('Auth/VerifyPhone', [
            'status' => session('status'),
        ]);
    }
}
