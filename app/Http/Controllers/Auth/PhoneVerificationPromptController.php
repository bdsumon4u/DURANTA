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
            if ($request->isAdmin()) {
                return redirect()->intended(route('admin.dashboard'));
            } else if ($request->isSeller()) {
                return redirect()->intended(route('seller.dashboard'));
            } else {
                return redirect()->intended(config('fortify.home'));
            }
        }

        return Inertia::render('Auth/VerifyPhone', [
            'is_seller' => $request->isSeller(),
            'status' => session('status'),
        ]);
    }
}
