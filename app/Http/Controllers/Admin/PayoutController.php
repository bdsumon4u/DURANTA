<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Models\Seller;
use App\Notifications\Seller\PaymentRecived;
use Bavix\Wallet\Models\Transaction;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PayoutController extends Controller
{
    private array $currentPeriod;
    private array $previousPeriod;

    public function __construct()
    {
        $fOfCurrMonth = now()->firstOfMonth();
        $mOfCurrMonth = $fOfCurrMonth->copy()->addDays(14);
        $lOfCurrMonth = now()->lastOfMonth();

        $fOfPrevMonth = now()->subMonth()->firstOfMonth();
        $mOfPrevMonth = $fOfPrevMonth->copy()->addDays(14);
        $lOfPrevMonth = now()->subMonth()->lastOfMonth();

        $this->currentPeriod = date('d') > 15 ? [$mOfCurrMonth->copy()->addDay(), $lOfCurrMonth->endOfDay()] : [$fOfCurrMonth, $mOfCurrMonth->endOfDay()];
        $this->previousPeriod = date('d') > 15 ? [$fOfCurrMonth, $mOfCurrMonth->endOfDay()] : [$mOfPrevMonth->addDay(), $lOfPrevMonth->endOfDay()];
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $sellers = $this->sellers(['wallet', 'modelSettings'])->paginate(10);

        return Inertia::render('Admin/Payouts/Index', [
            'sellers' => $sellers,
        ]);
    }

    public function paid(Request $request)
    {
        $seller = $this->sellers(['modelSettings'])->findOrFail($request->get('seller_id'));
        if ($request->isMethod('GET')) {
            return Inertia::render('Admin/Payouts/Paid', compact('seller'));
        }

        $data = $request->validate([
            'paid_amount' => 'required',
            'trx_id' => 'required',
        ]);

        try {
            $message = 'You\'re paid amount ' . $data['paid_amount'] . ', TRX ID: ' . $data['trx_id'];
            $seller->withdraw($data['paid_amount'], array_merge([
                'balance' => $seller->balance - $data['paid_amount'],
                'trx_id' => $data['trx_id'],
                'message' => $message,
                'payout' => true,
            ], $seller->settings()->get('withdraw')));
            $seller->notify(new PaymentRecived($message));
        } catch (\Exception $exception) {
            return back()->dangerBanner($exception->getMessage());
        }

        return redirect()->action(static::class)->banner('Payment Recorded.');
    }

    public function history(Request $request)
    {
        $payouts = Transaction::with('payable')
            ->where('meta->payout', true)
            ->latest('id')
            ->paginate(10);

        return Inertia::render('Admin/Payouts/History', [
            'payouts' => TransactionResource::collection($payouts),
        ]);
    }

    private function sellers($with = [])
    {
        return Seller::whereDoesntHave('transactions', function ($query) {
            $query->whereBetween('created_at', $this->currentPeriod)->where('meta->payout', true);
        })->with(array_merge($with, ['transactions' => function ($query) {
            $query->whereBetween('created_at', $this->previousPeriod)->latest('id')->take(1);
        }]));
    }
}
