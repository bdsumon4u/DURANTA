<?php

namespace App\Http\Controllers\Api;

use App\Facades\Cart;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request, Product $product)
    {
        Cart::add($product, $request->get('quantity', 1), [
            'first_media' => $product->getFirstMediaUrl(),
            'slug' => $product->slug,
            'discount' => $product->getBuyableDiscount(),
        ]);
        return response()->json(['success' => 'Product Is Added To Cart.']);
    }

    public function update(Request $request, Product $product)
    {
        $quantity = $request->get('qty', 0);
        if ($request->type === 'increment') {
            if ($product->stock_track && $product->stock_count > $quantity || !$product->stock_track) {
                Cart::update($request->rowId, $quantity + 1);
                return response()->json([
                    'success' => 'Cart Is Updated.'
                ]);
            }
        }
        if ($request->type === 'decrement' && $quantity > 1) {
            Cart::update($request->rowId, $quantity - 1);
            return response()->json([
                'success' => 'Cart Is Updated.'
            ]);
        }
        return response()->json([
            'danger' => 'Cart Can\'t Be Updated.'
        ]);
    }

    public function content(Request $request)
    {
        return response()->json([
            'cart' => [
                'total' => Cart::total(),
                'content' => Cart::content(),
                'subtotal' => Cart::subtotal(),
                'discount' => Cart::discount(),
            ],
        ]);
    }

    public function remove($rowId)
    {
        Cart::remove($rowId);
        return redirect()->back()->banner('Product Is Removed.');
    }

    public function clear()
    {
        Cart::destroy();
        return redirect()->back()->banner('Cart Is Cleared.');
    }
}
