<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Resources\SellershipResource;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if (!($application = $request->user()->sellership) || $application->status !== 'approved') {
            $application = new SellershipResource($application->load('media'));
        }
        return Inertia::render('Seller/Dashboard', compact('application'));
    }
}
