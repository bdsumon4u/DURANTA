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
            $data['products'] = $resource->products->map(function ($product) {
                return array_merge($product->toArray(), [
                    'seller' => $product->seller->sellership->store_name,
                ]);
            })->toArray();
        }

        return array_merge($data, [
            'created_at' => $resource->created_at->format('d M, Y'),
        ]);
    }
}
