<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureSellershipIsApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user()->sellership()->where('status', 'approved')->exists()) {
            return redirect()->route('seller.dashboard')->dangerBanner('You\'ve No Approved Sellership.');
        }

        return $next($request);
    }
}
