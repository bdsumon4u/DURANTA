<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WalletController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $transactions = $request->user()->transactions()->latest('id')->paginate(10);
        return Inertia::render('Seller/Wallet', [
            'transactions' => TransactionResource::collection($transactions),
        ]);
    }
}
