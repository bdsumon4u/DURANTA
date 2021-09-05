<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrandResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SellerResource;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $brands = Brand::with('media')->take(15)->get();
        $stores = Seller::with('sellership', 'modelSettings')->whereHas('sellership', function ($query) {
            $query->where('status', 'APPROVED');
        })->take(15)->get();
        $latest = Product::approved()->with('firstMedia')->latest('id')->take(12)->get();
        return Inertia::render('Home', [
            'brands' => BrandResource::collection($brands),
            'stores' => SellerResource::collection($stores),
            'latest' => ProductResource::collection($latest),
        ]);
    }
}
