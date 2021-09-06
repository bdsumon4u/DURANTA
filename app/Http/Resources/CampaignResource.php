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
        return array_merge(parent::toArray($request), [
            'starts_at' => Carbon::parse($resource->starts_at)->format('d-M-Y'),
            'ends_at' => Carbon::parse($resource->ends_at)->format('d-M-Y'),
            'deadline' => Carbon::parse($resource->deadline)->format('d-M-Y'),
        ]);
    }
}
