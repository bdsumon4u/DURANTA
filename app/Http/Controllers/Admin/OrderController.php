<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Models\Order;
use App\Notifications\OrderProductStatusChanged;
use App\Notifications\OrderStatusChanged;
use App\Notifications\Seller\SellerWalletUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;
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
            $query->with('user', 'address')
                ->withCount('products')
                ->when(\request('status'), function ($query) {
                    $query->where('status', \request('status'));
                })
                ->when(\request('seller'), function ($query) {
                    $query->whereHas('products', function ($query) {
                        $query->where('seller_id', \request('seller'));
                    });
                })
                ->latest('id');
        };

        if (\request('query')) {
            $query = Order::search(\request('query'))->query($callback);
        } else {
            $query = Order::when(true, $callback);
        }
        $orders = $query->paginate(10)->withQueryString();

        return Inertia::render('Admin/Orders/Index', [
            'orders' => OrderResource::collection($orders),
            'active' => \request('status'),
            'seller' => \request('seller'),
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
        $order->load('products.seller.sellership', 'address', 'payments');
        return Inertia::render('Admin/Orders/Edit', [
            'order' => new OrderResource($order),
            'invoiceDate' => today()->format('d-M-Y'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OrderRequest $request
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     * @throws ValidationException
     */
    public function update(OrderRequest $request, Order $order)
    {
        if ($request->get('paying')) {
            $data = $request->validate([
                'cash_on_delivery' => 'required|integer|gt:0',
            ]);
            $order->payments()->create([
                'tran_id' => '#' . $order->getKey() . '-COD-' . uniqid(),
                'amount' => $data['cash_on_delivery'],
                'status' => 'PAID',
                'gateway_url' => '',
            ]);
            return back()->banner('Paid: Cash On Delivery.');
        }
        if ($request->get('refunding')) {
            $data = $request->validate([
                'refund' => 'required|integer|gt:0',
                'tran_id' => 'required|unique:payments',
            ]);
            $order->payments()->create([
                'tran_id' => $data['tran_id'],
                'amount' => -$data['refund'],
                'status' => 'REFUNDED',
                'gateway_url' => '',
            ]);
            return back()->banner('Refunded: Record Stored.');
        }

        $data = $request->validated();
        $order->load('products.seller');
        $present = collect($request->products)->mapWithKeys(function ($product) {
            return [$product['id'] => $product['pivot']['status']];
        })->toArray();

        try {
            $order->products->each(function ($product) use (&$order, &$present) {
                $original = $product->pivot->status;
                if ($original == $present[$product->id]) {
                    return;
                }
                $order->products()->updateExistingPivot($product, [
                    'status' => $present[$product->id],
                ]);
                if ($original === 'DELIVERED' || $present[$product->id] === 'DELIVERED') {
                    $this->updateSellerWallet($order, [
                        'original' => $original,
                        'present' => $present[$product->id],
                    ]);
                }
                $order->user->notify(new OrderProductStatusChanged($order, $product));
                Notification::send($product->seller, new OrderProductStatusChanged($order, $product));
            });
            $order->update($data);
        } catch (\Exception $exception) {
            return back()->dangerBanner($exception->getMessage());
        }

        return redirect()->back()->banner('Order Is Updated.');
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

    private function updateSellerWallet(Order $order, $changes)
    {
        ProductResource::collection($order->products)->each(function ($product) use (&$order, &$changes) {
            update_seller_wallet($order, $product, $changes);
        });
    }
}
