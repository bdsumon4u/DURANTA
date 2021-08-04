<?php

namespace App\Http\Middleware;

use App\Contracts\Auth\MustVerifyPhone;
use Closure;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class EnsurePhoneIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $redirectToRoute
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse|null
     */
    public function handle($request, Closure $next, $redirectToRoute = null)
    {
        if (! $request->user() ||
            ($request->user() instanceof MustVerifyPhone &&
                ! $request->user()->hasVerifiedPhone())) {
            return $request->expectsJson()
                ? abort(403, 'Your phone number is not verified.')
                : Redirect::guest(URL::route($redirectToRoute ?: 'phone.verification.notice'));
        }

        return $next($request);
    }
}
