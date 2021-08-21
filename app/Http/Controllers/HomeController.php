<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
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
        $latest = Product::with('firstMedia')->latest('id')->take(12)->get();
        return Inertia::render('Home', [
            'latest' => ProductResource::collection($latest),
        ]);
    }
}
