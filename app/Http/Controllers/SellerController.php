<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Http\Resources\SellerResource;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        if ($search = \request('query')) {
            $query = Seller::search($search)->query(function ($query) {
                $query->with('sellership');
            });
        } else {
            $query = Seller::with('sellership')->latest('id');
        }
        $sellers = $query->paginate(24)->withQueryString()->onEachSide(0);
        return Inertia::render('Sellers/Index', [
            'sellers' => SellerResource::collection($sellers),
            'query' => $search,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function show(string $slug)
    {
        $seller = Seller::slugOrFail($slug);
        if ($search = \request('query')) {
            $products = Product::search($search)
                ->where('seller_id', $seller->getKey())
                ->query(function ($query) {
                    $query->with('firstMedia');
                })
                ->paginate(24);
        } else {
            $products = $seller->products()->approved()->with('firstMedia')->paginate(24);
        }

        return Inertia::render('Sellers/Show', [
            'seller' => new SellerResource($seller->load('sellership')),
            'products' => ProductResource::collection($products),
            'search' => $search,
        ]);
    }
}
