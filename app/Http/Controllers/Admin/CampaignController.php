<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CampaignRequest;
use App\Http\Resources\CampaignResource;
use App\Http\Resources\ProductResource;
use App\Models\Campaign;
use App\Models\Seller;
use App\Notifications\Seller\CampaignCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
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
        return Inertia::render('Admin/Campaigns/Index', [
            'campaigns' => CampaignResource::collection($campaigns),
            'starts_at' => now()->addWeek()->format('d-M-Y'),
            'ends_at' => now()->addWeeks(2)->format('d-M-Y'),
            'deadline' => now()->addDays(5)->format('d-M-Y'),
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
     * @param CampaignRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CampaignRequest $request)
    {
        $campaign = Campaign::create($request->validated());
        Notification::send(Seller::all(), new CampaignCreated($campaign));
        return back()->banner('New Campaign Created.');
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
        $query = $campaign->products();
        if ($status = \request('status')) {
            $query->wherePivot('status', $status);
        }
        $products = $query->paginate(5);
        return Inertia::render('Admin/Campaigns/Edit', [
            'products' => ProductResource::collection($products),
            'campaign' => new CampaignResource($campaign),
            'active' => $status,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CampaignRequest $request
     * @param \App\Models\Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(CampaignRequest $request, Campaign $campaign)
    {
        if ($id = $request->get('product_id')) {
            $id = $campaign->products()->findOrFail($id)->getKey();
            $campaign->products()->updateExistingPivot($id, [
                'status' => 'APPROVED',
            ]);
            return back()->banner('Product is Approved.');
        }
        $campaign->update($request->validated());
        return back()->banner('The Campaign is Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        if ($id = \request('product_id')) {
            $id = $campaign->products()->findOrFail($id)->getKey();
            $campaign->products()->updateExistingPivot($id, [
                'status' => 'REJECTED',
            ]);
            return back()->banner('Product is Rejected.');
        }
        $campaign->delete();
        return back()->banner('The Campaign is Deleted.');
    }
}
