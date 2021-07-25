<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Inertia\Inertia;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Brands/Index', [
            'brands' => Brand::orderBy('name')->paginate(10),
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
        $data = $request->validate([
            'name' => 'required|unique:brands',
            'image' => 'sometimes|nullable',
        ]);
        $brand = Brand::create($data);
        if (($image = data_get($data, 'image')) instanceof UploadedFile) {
            $brand->addMedia($image)->toMediaCollection();
        }
        return $this->banner('New Brand Added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return Inertia::render('Admin/Brands/Index', [
            'brand' => $brand,
            'brands' => Brand::orderBy('name')->paginate(10),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $data = $request->validate([
            'name' => 'required|unique:brands,id,' . $brand->id,
            'image' => 'sometimes|nullable',
        ]);
        $brand->update($data);
        if (($image = data_get($data, 'image')) instanceof UploadedFile) {
            $brand->addMedia($image)->toMediaCollection();
        }
        return $this->banner('The Brand Is Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return $this->banner('The Brand Is Deleted.');
    }
}
