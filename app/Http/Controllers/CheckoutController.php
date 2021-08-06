<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CheckoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if ($request->isMethod('GET')) {
            return Inertia::render('Checkout', [
                'addresses' => $request->user()->addresses,
            ]);
        }
    }

    public function complete(Request $request)
    {
        return Inertia::render('OrderComplete');
    }
}
