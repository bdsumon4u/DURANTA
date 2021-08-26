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
        if ($search = $request->get('search')) {
            $query = Product::search($search)->query(function ($query) {
                $query->with('firstMedia');
            });
        } else {
            $query = Product::with('firstMedia')->approved()->latest('id');
        }
        $products = $query->paginate(12)->withQueryString()->onEachSide(0);
        return Inertia::render('Products/Index', [
            'products' => ProductResource::collection($products),
        ]);
    }

    public function show(string $slug)
    {
        $product = Product::slugOrFail($slug);
        $product->load(['brand', 'media', 'categories', 'seller.products' => function ($query) {
            $query->with('firstMedia')->take(12);
        }]);
        return Inertia::render('Products/Show', [
            'product' => new ProductResource($product),
        ]);
    }
}
