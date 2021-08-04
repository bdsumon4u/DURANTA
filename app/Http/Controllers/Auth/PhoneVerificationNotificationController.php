<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PhoneVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->user()->hasVerifiedPhone()) {
            return $request->wantsJson()
                ? new JsonResponse('', 204)
                : redirect()->intended(config('fortify.home'));
        }

        $request->user()->sendPhoneVerificationNotification();

        return $request->wantsJson()
            ? new JsonResponse('', 202)
            : back()->with('status', 'verification-code-sent');
    }
}
