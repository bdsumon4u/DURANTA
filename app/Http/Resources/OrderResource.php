<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $resource = $this->resource;
        $data = parent::toArray($request);
        Arr::pull($data, 'address_id');

        if ($resource->relationLoaded('products')) {
            $total = 0;
            $commission = 0;
            $data['products'] = ProductResource::collection($resource->products)
                ->map(function ($product) use (&$total, &$commission) {
                    $data = $product->toArray(request());
                    $total += ($product->getBuyablePrice() - $product->getBuyableDiscount()) * $data['pivot']['quantity'];
                    $commission += data_get($data['pivot'], 'commission', $data['commission']) * $data['pivot']['quantity'];
                    return array_merge($data, [
                        'seller' => $product->seller->sellership->store_name,
                    ]);
                })->toArray($request);
            $data['total'] = $total;
            $data['commission'] = $commission;
        }

        if ($resource->relationLoaded('payments')) {
            $paid = 0;
            $data['payments'] = $resource->payments->map(function ($payment) use (&$paid) {
                if ($payment->status == 'PAID') {
                    $paid += $payment->amount;
                }
                return array_merge($payment->toArray(), [
                    'tran_date' => $payment->tran_date->format('d-M-Y'),
                ]);
            })->toArray();
            $data['paid'] = $paid;
        }

        $data['payable'] = $data['total'] + $data['shipping'];
        $data['due'] = $data['payable'] - data_get($data, 'paid', 0);

        return array_merge($data, [
            'created_at' => $resource->created_at->format('d M, Y'),
        ]);
    }
}
