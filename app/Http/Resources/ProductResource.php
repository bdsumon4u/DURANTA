<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class ProductResource extends JsonResource
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
        Arr::pull($data, 'brand_id');

        if ($resource->relationLoaded('brand')) {
            $data['brand_name'] = optional($resource->brand)->name;
        }

        if ($resource->relationLoaded('categories')) {
            $data['categories'] = $request->isAdmin()
                ? $resource->categories->pluck('id')
                : $resource->categories;
        }

        if ($resource->relationLoaded('firstMedia')) {
            $data['first_media'] = optional($resource->firstMedia)->getFullUrl();
        }

        if ($resource->relationLoaded('media')) {
            $data['media'] = $resource->getMedia()->map(function ($media) {
                return ['id' => $media->id, 'link' => $media->getFullUrl()];
            })->toArray();
            $data['first_media'] = data_get(data_get($data['media'], 0), 'link');
        }

        if ($resource->relationLoaded('seller')) {
            $data['seller'] = new SellerResource($resource->seller);
        }

        return array_merge($data, [
            'brand' => $resource->brand_id,
            'commission' => $data['commission_type'] === 'percent'
                ? round($data['price'] * $data['commission_amount'] / 100)
                : $data['commission_amount'],
            'discount' => $data['discount_type'] === 'percent'
                ? round($data['price'] * $data['discount_amount'] / 100)
                : $data['discount_amount'],
            'status' => strtoupper($data['status']),
        ]);
    }
}
