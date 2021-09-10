<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NavItem;
use App\Models\NavMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class NavMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, ?NavMenu $navMenu)
    {
        NavMenu::firstOrCreate([
            'name' => 'Main Menu',
            'slug' => 'main-menu',
        ]);
        NavMenu::firstOrCreate([
            'name' => 'Categories',
            'slug' => 'categories',
        ]);

        if (!$navMenu->exists) {
            return redirect()->action([static::class], NavMenu::first());
        }

        if ($request->isMethod('GET')) {
            return Inertia::render('Admin/NavMenus/Edit', [
                'navMenu' => $navMenu->load(['navItems' => function ($query) {
                    $query->oldest('weight');
                }]),
                'navMenus' => NavMenu::all(),
            ]);
        }

        $reordered = false;
        collect($request->get('nav_items'))
            ->each(function ($item, $key) use (&$navMenu, &$reordered) {
                if ($key === $item['weight']) return;
                $navMenu->navItems()
                    ->findOrFail($item['id'])
                    ->update(['weight' => $key]);
                $reordered = true;
            });
        Cache::tags('menus')->forget('menus:' . $navMenu->slug);

        $updated = false;
        if ($request->get('editing')) {
            $updated = $navMenu->navItems()->findOrFail($request->get('id'))->update($request->only('label', 'link'));
        } else if (!$reordered) {
            $navMenu->navItems()->create($request->validate([
                'label' => 'required', 'link' => 'required',
            ]));
            return back()->banner('Nav Item Added.');
        }
        if ($reordered) {
            $this->banner('Nav Items Reordered.');
        } else if ($updated) {
            $this->banner('Nav Item Updated.');
        }
        return back();
    }

    public function destroy(NavItem $navItem)
    {
        $navItem->delete();
        Cache::tags('menus')->flush();
        return back()->banner('Nav Item Deleted.');
    }
}
