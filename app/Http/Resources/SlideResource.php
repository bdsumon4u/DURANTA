<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SlideResource extends JsonResource
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

        return [
            'id' => $resource->id,
            'image' => cdn($resource->getFullUrl()),
            'link' => $resource->getCustomProperty('link'),
        ];
    }
}
