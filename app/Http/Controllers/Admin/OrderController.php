<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Models\Order;
use App\Notifications\OrderStatusChanged;
use App\Notifications\Seller\SellerWalletUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use function Clue\StreamFilter\fun;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::search(\request('query'))->query(function ($query) {
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
        })->paginate(10)->withQueryString();

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
            'dueDate' => today()->addDay()->format('d-M-Y'),
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
        $order->load('products.seller', 'payments');
        $resource = (new OrderResource($order));
        $rArr = $resource->toArray($request);
        if ($amount = $request->get('cash_on_delivery')) {
            if ($amount != $rArr['due']) {
                return back()->dangerBanner('Due amount does not match cod amount.');
            }
            $order->payments()->create([
                'tran_id' => '#' . $order->getKey() . '-COD',
                'amount' => $amount,
                'status' => 'PAID',
                'gateway_url' => '',
            ]);
            return back()->banner('Paid: Cash On Delivery');
        }

        $original = $order->getOriginal();
        $data = $request->validated();

        if ($data['status'] === 'COMPLETED' && $rArr['due'] > 0) {
            throw ValidationException::withMessages([
                'not_paid' => 'There is a due of amount ' . $rArr['due'] . '.',
            ]);
        }

        $changes = [];
        $order->update($data);
        foreach ($order->getChanges() as $key => $value) {
            $changes[$key] = [
                'original' => $original[$key],
                'present' => $value,
            ];
        }

        if ($order->wasChanged('status')) {
            if ($changes['status']['original'] === 'COMPLETED' || $changes['status']['present'] === 'COMPLETED') {
                // Increase/Decrease Seller's Balance
                $this->updateSellerWallet($order, $changes['status']);
            }
            ##############################################
            # What if some of the products are returned! #
            ##############################################
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

    private function updateSellerWallet(Order $order, $changes)
    {
        ProductResource::collection($order->products)->each(function ($product) use (&$order, &$changes) {
            $arr = $product->toArray(\request());
            $price = data_get($arr['pivot'], 'price', $arr['price']);
            $discount = data_get($arr['discount'], 'discount', $arr['discount']);
            $commission = data_get($arr['commission'], 'commission', $arr['commission']);
            $amount = ($price - $discount - $commission) * $arr['pivot']['quantity'];
            $message = ' amount ' . $amount . ' for product #' . $arr['id'] . 'x' . $arr['pivot']['quantity'] . ' on changing order #' . $order->id . ' status from "' . $changes['original'] . '" to "' . $changes['present'] . '".';
            $balance = $product->seller->balance;
            if ($order->status === 'COMPLETED') {
                // Increase
                $message = 'Credited' . $message;
                $product->seller->deposit($amount, [
                    'message' => $message,
                    'balance' => $balance + $amount,
                ]);
            } else {
                // Decrease
                $message = 'Debited' . $message;
                $product->seller->forceWithdraw($amount, [
                    'message' => $message,
                    'balance' => $balance - $amount,
                ]);
            }
            $product->seller->notify(new SellerWalletUpdated($order, $message));
        });
    }
}
