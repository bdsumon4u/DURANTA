<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class CampaignResource extends JsonResource
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

        if ($resource->relationLoaded('products')) {
            $data['products'] = ProductResource::collection($resource->products);
        }

        return array_merge($data, [
            'starts_at' => optional($resource->starts_at)->format('d-M-Y'),
            'starts_in' => optional($resource->starts_at)->isPast() ? 0 : optional($resource->starts_at)->diffInMilliseconds(),
            'ends_at' => optional($resource->ends_at)->format('d-M-Y'),
            'ends_in' => optional($resource->ends_at)->isPast() ? 0 : optional($resource->ends_at)->diffInMilliseconds(),
            'deadline' => optional($resource->deadline)->format('d-M-Y'),
        ]);
    }
}
