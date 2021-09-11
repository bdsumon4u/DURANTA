<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Pages/Index', [
            'pages' => Page::latest('id')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Pages/Editor', [
            'page' => new Page([
                'title' => null,
                'slug' => null,
                'content_en' => null,
                'content_bn' => null,
            ]),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Page::create($request->validate([
            'title' => 'required|unique:pages',
            'slug' => 'required|unique:pages',
            'content_en' => 'nullable',
            'content_bn' => 'nullable',
        ]));

        return redirect()
            ->action([static::class, 'index'])
            ->banner('Page is Created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return Inertia::render('Admin/Pages/Editor', [
            'page' => $page,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $page->update($request->validate([
            'title' => 'required|unique:pages,id,'.$page->getKey(),
            'slug' => 'required|unique:pages,id,'.$page->getKey(),
            'content_en' => 'nullable',
            'content_bn' => 'nullable',
        ]));

        return back()->banner('Page is Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()
            ->action([static::class, 'index'])
            ->banner('Page is Deleted.');
    }
}
