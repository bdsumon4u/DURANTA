<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Uzzal\SslCommerz\Client;

class PaymentController extends Controller
{
    public function success(Request $request, Order $order)
    {
        $resp = Client::verifyOrder($request->val_id);
        if ($resp->getStatus() === 'INVALID_TRANSACTION') {
            Log::error('Invalid validation id', $request->toArray());
            if ($payment = $this->paymentRecord($request, $order, 'first')) {
                $payment->update(['status' => $resp->getStatus()]);
            }
            return redirect()->route('dashboard')->dangerBanner('INVALID_TRANSACTION');
        }

        $payment = $this->paymentRecord($request, $order);
        $payment->update(array_merge($request->toArray(), [
            'status' => 'PAID',
        ]));
        if ($payment->getChanges()) {
            $this->banner('Payment Record Updated.');
        }
        return redirect()->route('orders.show', $order);
    }
    public function fail(Request $request, Order $order)
    {
        $this->paymentRecord($request, $order)->update(['status' => 'FAILED']);
        return redirect()->route('orders.show', $order);
    }
    public function cancel(Request $request, Order $order)
    {
        $this->paymentRecord($request, $order)->update(['status' => 'CANCELLED']);
        return redirect()->route('orders.show', $order);
    }
    public function ipn(Request $request, Order $order)
    {
        $payment = $this->paymentRecord($request, $order);
        $resp = Client::verifyOrder($request->val_id);

        if ($payment->status == 'PAID' && $resp->getStatus() != 'VALID') {
            Log::error('Payment Status: PAID But IPN Status: ' . $resp->getStatus() . ' For Transaction: ' . $payment->id . ' For Order: ' . $order->getKey());
        }

        if ($resp->getStatus() === 'INVALID_TRANSACTION') {
            Log::error('Invalid validation id', $request->toArray());
            echo 'Invalid Transaction: ' . $request->tran_id . ' For Order: ' . $order->getKey();
        } else if ($resp->getStatus() === 'FAILED') {
            Log::error("Transaction is declined by customer's Issuer Bank", $request->toArray());
            echo 'Transaction Failed: ' . $request->tran_id . ' For Order: ' . $order->getKey();
        } else if ($resp->getStatus() === 'CANCELLED') {
            Log::error('Transaction is cancelled by the customer', $request->toArray());
            echo 'Transaction Cancelled: ' . $request->tran_id . ' For Order: ' . $order->getKey();
        } else if ($resp->getStatus() === 'UNATTEMPTED') {
            Log::error('Customer did not choose to pay any channel', $request->toArray());
            echo 'Transaction Unattempted: ' . $request->tran_id . ' For Order: ' . $order->getKey();
        } else if ($resp->getStatus() === 'EXPIRED') {
            Log::error('Payment Timeout', $request->toArray());
            echo 'Transaction Timeout: ' . $request->tran_id . ' For Order: ' . $order->getKey();
        } else {
            if ($payment->status !== 'PENDING') {
                $message = 'Trying To Change Status Of Payment: ' . $payment->id . ' For Order: ' . $order->getKey() . ' From ' . $payment->status . ' To ' . $resp->getStatus();
                Log::error($message, $request->toArray());
                echo $message;
            } else {
                $payment->update(array_merge($request->toArray(), [
                    'status' => 'PAID',
                ]));
                if ($payment->getChanges()) {
                    echo 'Payment Record Updated.';
                } else {
                    echo 'Payment: ' . $payment->id . ' Record Is Not Updated.';
                }
            }
        }
    }

    private function paymentRecord(Request $request, Order $order, string $method = 'firstOrFail')
    {
        return $order->payments() ->where('tran_id', $request->tran_id)->{$method}();
    }
}
