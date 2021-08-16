<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SellershipResource extends JsonResource
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

        if ($resource->relationLoaded('media')) {
            $data['nid_front'] = $resource->getFirstMediaUrl('nid_front');
            $data['nid_back'] = $resource->getFirstMediaUrl('nid_back');
            $data['license'] = $resource->getFirstMediaUrl('license');
            $data['signboard'] = $resource->getFirstMediaUrl('signboard');
            unset($data['media']);
        }

        return $data;
    }
}
