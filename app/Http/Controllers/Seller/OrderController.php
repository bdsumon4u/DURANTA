<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Notifications\OrderProductStatusChanged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Inertia\Inertia;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $callback = function ($query) {
            $query->whereHas('products', function ($query) {
                $query->where('seller_id', \request()->user()->id);
            })
                ->with(['products' => function ($query) {
                    $query->where('seller_id', \request()->user()->id);
                }, 'payments'])
                ->when(\request('status'), function ($query) {
                    $query->where('status', \request('status'));
                })
                ->latest('id');
        };

        if (\request('query')) {
            $query = Order::search(\request('query'))->query($callback);
        } else {
            $query = Order::when(true, $callback);
        }
        $orders = $query->paginate(10)->withQueryString();

        return Inertia::render('Seller/Orders/Index', [
            'orders' => OrderResource::collection($orders),
            'active' => \request('status'),
            'query' => \request('query'),
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
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $product = $order->products()->where([
            'seller_id' => $request->user()->id,
            'product_id' => $request->product_id,
        ])
            ->where('status', '!=', 'DELIVERED')
            ->firstOrFail();

        $original = $product->pivot->status;
        $order->products()->updateExistingPivot($product, [
            'status' => 'DELIVERED',
        ]);

        update_seller_wallet($order, $product, [
            'original' => $original,
            'present' => 'DELIVERED',
        ]);
        $order->user->notify(new OrderProductStatusChanged($order, $product));
        Notification::send($product->seller, new OrderProductStatusChanged($order, $product));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
