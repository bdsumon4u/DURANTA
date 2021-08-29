<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Notifications\OrderStatusChanged;
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
        $orders = Order::with('user', 'address')
            ->withCount('products')
            ->when(\request('status'), function ($query) {
                $query->where('status', \request('status'));
            })
            ->latest('id')
            ->paginate(10);

        return Inertia::render('Admin/Orders/Index', [
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
        $order->load('products.seller.sellership', 'address', 'payments');
        return Inertia::render('Admin/Orders/Edit', [
            'order' => new OrderResource($order),
            'invoiceDate' => today()->format('d-M-Y'),
            'dueDate' => today()->addDay()->format('d-M-Y'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OrderRequest $request
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, Order $order)
    {
        $data = $request->validated();
        $order->update($data);
        if ($order->wasChanged('status')) {
            $order->user->notify(new OrderStatusChanged($order));
            Notification::send($order->sellers()->get(), new OrderStatusChanged($order));
        }
        return redirect()->action([static::class, 'index'])->banner('Order Is Updated.');
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
