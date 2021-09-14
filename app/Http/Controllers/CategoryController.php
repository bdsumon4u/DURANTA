<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if ($search = \request('query')) {
            $query = Category::search($search);
        } else {
            $query = Category::latest('id');
        }
        $categories = $query->paginate(24)->withQueryString()->onEachSide(0);
        return Inertia::render('Categories/Index', [
            'categories' => CategoryResource::collection($categories),
            'query' => $search,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $category_id = $category->id;
        if ($search = \request('query')) {
            $products = Product::search($search)
                ->query(function ($query) use ($category_id) {
                    $query->whereHas('categories', function ($query) use ($category_id) {
                        $query->where('categories.id', $category_id);
                    })->with('firstMedia');
                })
                ->paginate(24);
        } else {
            $products = $category->products()->approved()->with('firstMedia')->paginate(24);
        }

        return Inertia::render('Categories/Show', [
            'products' => ProductResource::collection($products),
            'category' => new CategoryResource($category),
            'search' => $search,
        ]);
    }
}
