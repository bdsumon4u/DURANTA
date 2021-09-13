<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Categories/Index', [
            'categories' => Category::orderBy('name')->paginate(10),
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
            'name' => 'required|unique:categories',
            'image' => 'sometimes|nullable',
        ]);
        $category = Category::create($data);
        if (($image = data_get($data, 'image')) instanceof UploadedFile) {
            $category->addMedia($image)->toMediaCollection();
        }
        return $this->banner('New Category Added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return Inertia::render('Admin/Categories/Index', [
            'category' => $category,
            'categories' => Category::orderBy('name')->paginate(10),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|unique:categories,id,' . $category->id,
            'image' => 'sometimes|nullable',
        ]);
        $category->update($data);
        if (($image = data_get($data, 'image')) instanceof UploadedFile) {
            $category->addMedia($image)->toMediaCollection();
        }
        return $this->banner('The Category Is Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ($category->products()->count()) {
            return back()->dangerBanner('Category Has Product.');
        }
        $category->delete();
        return $this->banner('The Category Is Deleted.');
    }
}
