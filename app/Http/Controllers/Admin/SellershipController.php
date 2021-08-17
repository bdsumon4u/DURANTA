<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SellershipRequest;
use App\Http\Resources\SellershipResource;
use App\Models\Sellership;
use App\Notifications\SellerApplication;
use Inertia\Inertia;

class SellershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sellership  $sellership
     * @return \Illuminate\Http\Response
     */
    public function edit(Sellership $sellership)
    {
        return Inertia::render('Admin/Sellers/Sellership', [
            'application' => new SellershipResource($sellership->load('media')),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SellershipRequest $request
     * @param \App\Models\Sellership $sellership
     * @return \Illuminate\Http\Response
     */
    public function update(SellershipRequest $request, Sellership $sellership)
    {
        $sellership->update($request->validated());

        $changed = !!$sellership->getChanges();

        foreach (['nid_front', 'nid_back', 'license', 'signboard'] as $type) {
            if ($request->hasFile($type)) {
                $request->validate([$type => 'image']);
                $sellership->addMedia($request->file($type))->toMediaCollection($type);
                $changed = true;
            }
        }

        if ($changed) {
            $sellership->seller->notify(new SellerApplication($sellership));
            return back()->banner('Sellership Application Updated.');
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sellership  $sellership
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sellership $sellership)
    {
        //
    }
}
