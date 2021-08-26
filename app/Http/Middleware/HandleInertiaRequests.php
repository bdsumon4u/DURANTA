<?php

namespace App\Http\Middleware;

use App\Http\Resources\SlideResource;
use App\Models\Library;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        $data = array_merge(parent::share($request), [
            'app_name' => config('app.name'),
            'is_admin' => $request->isAdmin(),
            'is_seller' => $request->isSeller(),
        ]);

        return $this->slides($data);
    }

    /**
     * Merge slides if it's home route.
     *
     * @param array $data
     * @return array
     */
    private function slides(array $data) {
        if (\request()->routeIs('home')) {
            return array_merge($data, [
                'slides' => SlideResource::collection(Library::firstOrCreate(['type' => 'slides'])->getMedia())
            ]);
        }
        return $data;
    }
}
