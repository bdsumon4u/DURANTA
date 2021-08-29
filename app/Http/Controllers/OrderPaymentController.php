<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Uzzal\SslCommerz\Client;
use Uzzal\SslCommerz\Customer;
use Uzzal\SslCommerz\Exceptions\RequestParameterMissingException;
use Uzzal\SslCommerz\SessionRequest;

class OrderPaymentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Order $order)
    {
        $tran_id = '#' . $order->getKey() . '-' . uniqid();
        $request->validate([
            'amount' => 'required|integer|min:10',
        ]);

        $customer = new Customer($order->address->name, $order->address->email ?? 'No Email', $order->address->phone);
        $customer->setAddress1($order->address->address);
        $customer->setState($order->address->division);
        $customer->setCity($order->address->district);

        try {
            $config[SessionRequest::TRANSACTION_ID] = $tran_id;
            $config['shipping_method'] = 'NO';
            $config['product_name'] = 'Order #' . $order->getKey();
            $config['product_category'] = 'General';
            $config['product_profile'] = 'general';
            $config['success_url'] = route('payment.success', $order->getKey());
            $config['fail_url'] = route('payment.fail', $order->getKey());
            $config['cancel_url'] = route('payment.cancel', $order->getKey());
            $config['ipn_url'] = route('payment.ipn', $order->getKey());
            $resp = Client::initSession($customer, \request('amount'), $config);
        } catch (GuzzleException | RequestParameterMissingException $e) {
            dd($e->getMessage());
        }

        $order->payments()->create([
            'tran_id' => $tran_id,
            'amount' => $request->amount,
            'gateway_url' => $resp->getGatewayUrl(),
        ]);

        return response('', 409)->header('X-Inertia-Location', $resp->getGatewayUrl());
    }
}
