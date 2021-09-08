<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Resources\CampaignResource;
use App\Http\Resources\ProductResource;
use App\Models\Campaign;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = Campaign::latest('id')->paginate(10);
        return Inertia::render('Seller/Campaigns/Index', [
            'campaigns' => CampaignResource::collection($campaigns),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign)
    {
        if ($campaign->deadline->isPast()) {
            return back()->dangerBanner('Campaign Deadline is Over.');
        }

        $query = $campaign->products();
        if ($status = \request('status')) {
            $query->wherePivot('status', $status);
        }
        $products = $query->where('seller_id', \request()->user()->id)
            ->latest('id')
            ->paginate(5);

        if ($sku = \request('sku')) {
            if (!$product = \request()->user()->products()->approved()->where(compact('sku'))->first()) {
                return back()->dangerBanner('Invalid SKU. No Product Found');
            }
        } else {
            $product = new Product;
        }

        return Inertia::render('Seller/Campaigns/Edit', [
            'product' => $product->exists ? new ProductResource($product) : null,
            'products' => ProductResource::collection($products),
            'campaign' => new CampaignResource($campaign),
            'active' => $status,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campaign $campaign)
    {
        if (!$product = Product::findOrFail($request->product_id)) {
            return back()->dangerBanner('Product Not Found.');
        }

        if ($campaign->products()->wherePivot('status', 'APPROVED')->wherePivot('product_id', $product->getKey())->exists()) {
            return back()->dangerBanner('Product is Already Approved in This Campaign.');
        }

        $discount = $request->discount_type === 'percent'
            ? $product->price * $request->discount_amount / 100
            : $request->discount_amount;

        if ($product->price * 10 / 100 > $discount) {
            return back()->dangerBanner('Discount Must Not Be Less Than 10%.');
        }

        $campaign->products()->syncWithoutDetaching([
            $product->id => [
                'discount_amount' => $request->discount_amount,
                'discount_type' => $request->discount_type,
                'selling' => $product->price - $discount,
                'discount' => $discount,
            ]
        ]);

        return back()->banner('Product is Added to The Campaign.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        $product = $campaign->products()->where('seller_id', \request()->user()->getKey())->findOrFail(\request('product_id'));
        $campaign->products()->detach($product);
        return back()->banner('Product is Removed From This Campaign.');
    }
}
