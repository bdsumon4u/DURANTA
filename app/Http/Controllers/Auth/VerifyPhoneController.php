<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\VerifyPhoneRequest;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VerifyPhoneController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param VerifyPhoneRequest $request
     * @param $id
     * @param $code
     * @return \Illuminate\Http\Response
     */
    public function __invoke(VerifyPhoneRequest $request, $id, $code)
    {
        if ($request->user()->hasVerifiedPhone()) {
            return $request->wantsJson()
                ? new JsonResponse('', 204)
                : redirect()->intended(config('fortify.home').'?verified=1');
        }

        if ($request->user()->markPhoneAsVerified()) {
            event(new Verified($request->user()));
        }

        return $request->wantsJson()
            ? new JsonResponse('', 202)
            : redirect()->intended(config('fortify.home').'?verified=1');
    }
}
