<?php

namespace App\Http\Controllers;

use App\Http\Resources\CampaignResource;
use App\Http\Resources\ProductResource;
use App\Models\Campaign;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        $products = Product::search(\request('search'))->query(function ($query) {
            $query->with('firstMedia')->when(\request('sort'), function ($query) {
                if (\request('sort') === 'price') {
                    $query->orderBy('price');
                } else if (\request('sort') === '-price') {
                    $query->orderByDesc('price');
                } else {
                    $query->latest('id');
                }
            })->latest('id');
        })->paginate(12)->withQueryString()->onEachSide(0);
        return Inertia::render('Products/Index', [
            'products' => ProductResource::collection($products),
        ]);
    }

    public function show(string $slug)
    {
        if (\request('campaign')) {
            $campaign = Campaign::whereSlug(\request('campaign'))->firstOrFail();
            if ($campaign->starts_at->isFuture()) {
                return back()->dangerBanner('Campaign is Not Started.');
            }
            if ($campaign->ends_at->isPast()) {
                return back()->dangerBanner('Campaign is Over.');
            }
            $product = $campaign->products()->findOrFail(Str::afterLast($slug, '--i'));
        } else {
            $campaign = new Campaign;
            $product = Product::slugOrFail($slug);
        }
        $product->load(['brand', 'media', 'categories', 'seller.products' => function ($query) {
            $query->with('firstMedia')->take(12);
        }]);

        return Inertia::render('Products/Show', [
            'product' => new ProductResource($product),
            'campaign' => new CampaignResource($campaign),
        ]);
    }
}
