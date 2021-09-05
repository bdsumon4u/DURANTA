<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class SellerResource extends JsonResource
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

        if ($resource->relationLoaded('sellership')) {
            $data['store_name'] = $resource->sellership->store_name;
            $data['slug'] = Str::slug($resource->sellership->store_name) . '--i' . $resource->id;
        }

        if ($resource->relationLoaded('products')) {
            $data['products'] = ProductResource::collection($resource->products);
        }

        return array_merge($data, []);
    }
}
