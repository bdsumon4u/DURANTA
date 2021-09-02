<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\SellerResource;
use App\Http\Resources\TransactionResource;
use App\Models\Seller;
use App\Services\EarningService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellers = Seller::query()
            ->with('sellership')
            ->when(\request('status'), function ($query) {
                $query->whereHas('sellership', function ($query) {
                    $query->where('status', \request('status'));
                });
            })
            ->latest('id')
            ->paginate(10);

        return Inertia::render('Admin/Sellers/Index', [
            'sellers' => SellerResource::collection($sellers),
            'status' => \request('status'),
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
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function show(Seller $seller)
    {
        $period = \request('period');
        $earning = new EarningService($seller->load('wallet'));
        $between = $earning->carbonBetween($period);
        $transactions = $seller->transactions()
            ->when($period, function ($query) use ($between) {
                $query->whereBetween('created_at', $between);
            })
            ->latest('id')
            ->paginate(10)
            ->withQueryString();
        return Inertia::render('Admin/Sellers/Show', [
            'transactions' => TransactionResource::collection($transactions),
            'seller' => new SellerResource($seller),
            'periods' => $earning->periods,
            'active' => $period,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function edit(Seller $seller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seller $seller)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller)
    {
        //
    }
}
