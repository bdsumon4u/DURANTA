<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Http\Resources\WidgetResource;
use App\Models\Widget;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WidgetController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, string $slug)
    {
        $widget = Widget::slugOrFail($slug);
        if ($widget->name !== 'Products') {
            return back()->dangerBanner('Invalid Widget!');
        }
        $products = $widget->products($request->get('query'))->paginate(24)->withQueryString();
        return Inertia::render('Widget', [
            'products' => ProductResource::collection($products),
            'widget' => new WidgetResource($widget),
            'query' => $request->get('query'),
        ]);
    }
}
