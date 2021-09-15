<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\WidgetResource;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Widget;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class WidgetController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if ($request->isMethod('GET')) {
            return Inertia::render('Admin/Widgets/Index', [
                'design' => WidgetResource::collection(Widget::oldest('weight')->get()),
                'selectable' => [
                    'brands' => Brand::select('id', 'name')->get(),
                    'categories' => Category::select('id', 'name')->get(),
                ],
            ]);
        }

        collect($request->get('design'))->each(function ($design, $key) use (&$request) {
            if (!is_array($design) || !isset($design['weight'], $design['name'])) {
                return;
            }

            $data = Arr::only($design, ['name', 'title']);
            $data['weight'] = $key + 1;

            if ($design['name'] === 'Banner') {
                $data['settings'] = Arr::only($design, 'link');
            } elseif ($design['name'] === 'Products') {
                $data['settings'] = Arr::only($design, ['brands', 'categories', 'number_of_products', 'ordering']);
            }

            $widget = Widget::query()->updateOrCreate(['id' => data_get($design, 'id')], $data);
            if ($design['name'] === 'Banner' && is_file($file = $request->design[$key]['image'])) {
                $widget->addMedia($file)->toMediaCollection();
            }
        });
        Cache::forget('widgets');
        return back()->banner('Widgets Are Saved.');
    }
}
