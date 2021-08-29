<?php

namespace App\Http\Controllers;

use App\Facades\Cart;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Notifications\OrderReceived;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $orders = \request()->user()->orders()->with('address')->withCount('products')->latest('id')->paginate(10);
        return Inertia::render('Orders/Index', [
            'orders' => OrderResource::collection($orders),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Orders/Create', [
            'addresses' => \request()->user()->addresses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        DB::beginTransaction();
        $products = Cart::content()->mapWithKeys(function ($item) {
            $count = $item->qty;
            $model = $item->model;
            if ($model->stock_track) {
                ($item->qty > $model->stock_count) && (
                $count = $model->stock_count
                );
                $model->decrement('stock_count', $count);
            }

            return [$item->id => array_merge($item->options->toArray(), [
                'quantity' => $count,
                'price' => $model->getBuyablePrice(),
            ])];
        })->toArray();

        if ($order = $request->user()->orders()->create($request->all())) {
            $order->products()->sync($products);
            $request->user()->notify(new OrderReceived($order));
            Cart::destroy();
        }
        DB::commit();

        return $order ? redirect()->route('orders.complete') : back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $order->load('address', 'products', 'payments');
        return Inertia::render('Orders/Show', [
            'order' => new OrderResource($order),
        ]);
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
        //
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
