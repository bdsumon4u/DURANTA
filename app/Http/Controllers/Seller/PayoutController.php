<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PayoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $payouts = $request->user()
            ->transactions()
            ->where('meta->payout', true)
            ->latest('id')
            ->paginate(10);

        return Inertia::render('Seller/Payouts', [
            'payouts' => TransactionResource::collection($payouts),
        ]);
    }
}
