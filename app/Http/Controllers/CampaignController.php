<?php

namespace App\Http\Controllers;

use App\Http\Resources\CampaignResource;
use App\Http\Resources\ProductResource;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CampaignController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $campaigns = Campaign::oldest('starts_at')->paginate(5);
        return Inertia::render('Campaigns/Index', [
            'campaigns' => CampaignResource::collection($campaigns),
        ]);
    }

    public function show(Campaign $campaign)
    {
        if ($campaign->starts_at->isFuture()) {
            return back()->dangerBanner('Campaign is Not Started.');
        }

        if ($campaign->ends_at->isPast()) {
            return back()->dangerBanner('Campaign is Over.');
        }

        $products = $campaign->products()->with('firstMedia')->wherePivot('status', 'APPROVED')->paginate(12);
        return Inertia::render('Campaigns/Show', [
            'products' => ProductResource::collection($products),
            'campaign' => new CampaignResource($campaign),
        ]);
    }
}
