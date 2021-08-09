<?php

namespace App\Http\Controllers;

use App\Facades\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Laravel\Jetstream\Jetstream;

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

        $data = $request->validate([
            'address' => 'required|integer',
            'contact_name' => 'required',
            'contact_phone' => 'required|numeric|digits:11',
            'term' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ]);
        $data['address_id'] = Arr::pull($data, 'address');

        $content = Cart::content();
        DB::beginTransaction();
        $products = $content->mapWithKeys(function ($item) {
            $count = $item->qty;
            $model = $item->model;
            if ($model->stock_track) {
                ($item->qty > $model->stock_count) && (
                    $count = $model->stock_count
                );
                $model->decrement('stock_count', $count);
            }

            return [$item->id => array_merge($item->options->toArray(), [
                'quantity' => $count,
                'price' => $model->getBuyablePrice(),
            ])];
        })->toArray();

        $data += [
            'subtotal' => Cart::subtotal(),
            'discount' => Cart::discount(),
            'total' => Cart::total(),
        ];

        $order = $request->user()->orders()->create($data)->products()->sync($products);

        DB::commit();

        return $order ? redirect()->action([static::class, 'complete']) : back();
    }

    public function complete(Request $request)
    {
        return Inertia::render('OrderComplete');
    }
}
