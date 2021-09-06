<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CampaignRequest;
use App\Http\Resources\CampaignResource;
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
        return Inertia::render('Admin/Campaigns/Edit', [
            'campaign' => new CampaignResource($campaign),
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
        $campaign->delete();
        return back()->banner('The Campaign is Deleted.');
    }
}
