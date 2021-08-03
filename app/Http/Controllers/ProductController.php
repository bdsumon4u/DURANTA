<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return Inertia::render('Products/Index');
    }

    public function show(string $slug)
    {
        $product = Product::slugOrFail($slug);
        $product->load('brand', 'media');
        return Inertia::render('Products/Show', [
            'product' => new ProductResource($product),
        ]);
    }
}
