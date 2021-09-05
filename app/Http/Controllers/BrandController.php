<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrandResource;
use App\Http\Resources\ProductResource;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        if ($search = \request('query')) {
            $query = Brand::search($search);
        } else {
            $query = Brand::latest('id');
        }
        $brands = $query->paginate(24)->withQueryString()->onEachSide(0);
        return Inertia::render('Brands/Index', [
            'brands' => BrandResource::collection($brands),
            'query' => $search,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        if ($search = \request('query')) {
            $products = Product::search($search)
                ->where('brand_id', $brand->getKey())
                ->query(function ($query) {
                    $query->with('firstMedia');
                })
                ->paginate(24);
        } else {
            $products = $brand->products()->approved()->with('firstMedia')->paginate(24);
        }

        return Inertia::render('Brands/Show', [
            'products' => ProductResource::collection($products),
            'brand' => new BrandResource($brand),
            'search' => $search,
        ]);
    }
}
