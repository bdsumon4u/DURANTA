<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('firstMedia')
            ->when(\request('status'), function ($query) {
                $query->where('status', \request('status'));
            })
            ->paginate(10);

        return Inertia::render('Admin/Products/Index', [
            'products' => ProductResource::collection($products),
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return Inertia::render('Admin/Products/Editor', [
            'product' => new ProductResource($product->load('media', 'categories')),
            'brands' => $this->selectable(Brand::class),
            'categories' => $this->selectable(Category::class),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $product->update($data);
        $this->addMedia($product, $data['media']);
        $product->categories()->sync($data['categories']);

        return redirect()->action([static::class, 'index'])->banner('The Product is Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    /**
     * Selectable brand or categories
     *
     * @param string $model
     * @return array
     */
    private function selectable(string $model)
    {
        return $model::select('id', 'name')
            ->orderBy('name')
            ->get()
            ->toArray();
    }

    /**
     * @param Product $product
     * @param array $media
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    private function addMedia(Product $product, array $media)
    {
        $ids = collect($media)
            ->map(function ($image) use ($product) {
                return $image['id'] ?? $product->addMedia($image['file'])->toMediaCollection()->id;
            })->toArray();

        Media::setNewOrder($ids);
        // Deleting on collection, to delete files from disk.
        $product->getMedia()->whereNotIn('id', $ids)->each->delete();
    }
}
