<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrandResource;
use App\Http\Resources\CampaignResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SellerResource;
use App\Http\Resources\WidgetResource;
use App\Models\Brand;
use App\Models\Campaign;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Widget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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
        $campaign = Campaign::with(['products' => function ($query) {
            $query->wherePivot('status', 'APPROVED')->with('firstMedia')->take(6);
        }])->oldest('starts_at')
            ->whereDate('starts_at', '<=', now())
            ->whereDate('ends_at', '>', now())
            ->firstOrNew();
        $widgets = Cache::rememberForever('widgets', function () {
            return Widget::oldest('weight')->get();
        });
        return Inertia::render('Home', [
            'brands' => BrandResource::collection($brands),
            'stores' => SellerResource::collection($stores),
            'campaign' => new CampaignResource($campaign),
            'widgets' => WidgetResource::collection($widgets),
        ]);
    }
}
