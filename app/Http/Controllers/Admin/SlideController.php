<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\SlideResource;
use App\Models\Library;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = Library::firstOrCreate(['type' => 'slides'])->getMedia();
        return Inertia::render('Admin/Slides/Index', [
            'slides' => SlideResource::collection($slides),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Slides/Editor');
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
            'image' => 'required|image',
            'link' => 'required|max:255',
        ]);
        Library::firstOrCreate(['type' => 'slides'])
            ->addMedia($data['image'])
            ->withCustomProperties([
                'link' => $data['link'],
            ])
            ->toMediaCollection();

        return redirect()->action([static::class, 'index'])->banner('Slide Uploaded.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Spatie\MediaLibrary\MediaCollections\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function show(Media $slide)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Spatie\MediaLibrary\MediaCollections\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function edit(Media $slide)
    {
        return Inertia::render('Admin/Slides/Editor', [
            'slide' => new SlideResource($slide),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Spatie\MediaLibrary\MediaCollections\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Media $slide)
    {
        $data = $request->validate(['link' => 'required|max:255']);
        $slide->setCustomProperty('link', $data['link'])->save();

        return redirect()->action([static::class, 'index'])->banner('Slide Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Spatie\MediaLibrary\MediaCollections\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $slide)
    {
        $slide->destroy();
        return redirect()->action([static::class, 'index'])->banner('Slide Deleted.');
    }
}
