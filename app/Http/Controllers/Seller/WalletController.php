<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Services\EarningService;
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
        $earning = new EarningService($request->user());
        $period = $request->get('period');
        $between = $earning->carbonBetween($period);
        $transactions = $request->user()
            ->transactions()
            ->when($period, function ($query) use ($between) {
                $query->whereBetween('created_at', $between);
            })
            ->latest('id')
            ->paginate(10)
            ->withQueryString();
        return Inertia::render('Seller/Wallet', [
            'transactions' => TransactionResource::collection($transactions),
            'periods' => $earning->periods,
            'active' => $period,
        ]);
    }
}
