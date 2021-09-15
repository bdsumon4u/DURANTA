<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use function Clue\StreamFilter\fun;

class WidgetResource extends JsonResource
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
        $data = Arr::only(parent::toArray($request), [
            'id', 'weight', 'name', 'title'
        ]);

        if ($resource->name === 'Banner') {
            $data['image'] = $resource->getFirstMediaUrl();
            $data['link'] = data_get($resource->settings, 'link');
            if (!filter_var($data['link'], FILTER_VALIDATE_URL)) {
                $data['link'] = route('home');
            }
        } elseif ($resource->name === 'Products') {
            $data['slug'] = Str::slug($data['title']) . '--i' . $data['id'];
            $data['brands'] = data_get($resource->settings, 'brands') ?? '';
            $data['categories'] = data_get($resource->settings, 'categories') ?? '';
            $data['ordering'] = data_get($resource->settings, 'ordering', 'latest');
            $data['number_of_products'] = data_get($resource->settings, 'number_of_products') ?? 0;
            if ($request->routeIs('home')) {
                $products = $resource->products()->take((int)$data['number_of_products'])->get();
                $data['products'] = ProductResource::collection($products);
            }
        }

        return $data;
    }
}
