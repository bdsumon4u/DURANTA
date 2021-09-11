<?php

namespace App\Http\Middleware;

use App\Http\Resources\SlideResource;
use App\Models\Library;
use App\Models\NavMenu;
use App\Settings\GeneralSettings;
use App\Settings\SocialSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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

        $data = $this->settings($data);
        $data = $this->menus($data);
        $data = $this->balance($data);
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

    /**
     * Merge balance if it's seller dashboard.
     *
     * @param array $data
     * @return array
     */
    private function balance(array $data)
    {
        if (\request()->routeIs('seller.dashboard')) {
            return array_merge($data, [
                'balance' => \request()->user()->balance,
            ]);
        }
        return $data;
    }

    /**
     * Merge menus if it's public route.
     *
     * @param array $data
     * @return array
     */
    private function menus(array $data)
    {
        if (\request()->isAdmin() || \request()->isSeller()) {
            return $data;
        }

        return array_merge($data, [
            'menus' => [
                'main_menu' => Cache::tags('menus')->rememberForever('menus:main-menu', function () {
                    return NavMenu::where('slug', 'main-menu')
                        ->with(['navItems' => function ($query) {
                            $query->oldest('weight');
                        }])->firstOrNew();
                }),
                'categories' => Cache::tags('menus')->rememberForever('menus:categories', function () {
                    return NavMenu::where('slug', 'categories')
                        ->with(['navItems' => function ($query) {
                            $query->oldest('weight');
                        }])->firstOrNew();
                }),
                'quick_links' => Cache::tags('menus')->rememberForever('menus:quick-links', function () {
                    return NavMenu::where('slug', 'quick-links')
                        ->with(['navItems' => function ($query) {
                            $query->oldest('weight');
                        }])->firstOrNew();
                }),
            ]
        ]);
    }

    /**
     * Merge settings if it's public route.
     *
     * @param array $data
     * @return array
     */
    private function settings(array $data)
    {
        if (\request()->isAdmin() || \request()->isSeller()) {
            return $data;
        }

        return array_merge($data, [
            'settings' => [
                'general' => resolve(GeneralSettings::class)->toArray(),
                'social' => resolve(SocialSettings::class)->toArray(),
            ]
        ]);
    }
}
