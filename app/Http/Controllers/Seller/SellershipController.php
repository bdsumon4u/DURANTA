<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\SellershipRequest;
use App\Models\Admin;
use App\Models\Sellership;
use App\Notifications\SellerApplication;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Notification;

class SellershipController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param SellershipRequest $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(SellershipRequest $request)
    {
        $sellership = $request->user()->sellership()->updateOrCreate(
            Arr::only($data = $request->validated(), ['email', 'phone']), $data
        );

        foreach (['nid_front', 'nid_back', 'license', 'signboard'] as $type) {
            if ($request->hasFile($type)) {
                $request->validate([$type => 'image']);
                $sellership->addMedia($request->file($type))->toMediaCollection($type);
            }
        }

        if ($sellership->wasRecentlyCreated) {
            Notification::send(Admin::all(), new SellerApplication($sellership));
        }

        return back()->banner('Application Submitted.');
    }
}
