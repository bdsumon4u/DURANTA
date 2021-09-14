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
        $application = $request->user()->sellership()->firstOrNew([
            'store_phone' => $request->user()->phone,
        ], [
            'store_name' => '',
            'store_email' => '',
            'store_address' => '',
            'nid_front' => '',
            'nid_back' => '',
            'license' => '',
            'signboard' => '',
        ]);

        if ($application->status !== 'approved') {
            $application->load('media');
        }

        return Inertia::render('Seller/Dashboard', [
            'application' => new SellershipResource($application),
            'statistics' => [
                'products' => $request->user()->products()->count(),
                'orders' => $request->user()->orders()->count(),
            ]
        ]);
    }
}
