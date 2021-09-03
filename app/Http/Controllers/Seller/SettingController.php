<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\SettingRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingController extends Controller
{
    private array $tabs = ['store', 'withdraw'];

    /**
     * Handle the incoming request.
     *
     * @param SettingRequest $request
     * @param ?string $tab
     * @return \Illuminate\Http\Response
     */
    public function __invoke(SettingRequest $request, string $tab = null)
    {
        if ($request->isMethod('GET')) {
            if (!in_array($tab, $this->tabs, true)) {
                return redirect()->action([static::class], data_get($this->tabs, 0));
            }

            return Inertia::render('Seller/Settings/'.ucfirst($tab), [
                'settings' => $request->user()->settings()->get($tab),
                'tabs' => $this->tabs,
            ]);
        }

        return $this->update($tab, $request->validated());
    }

    /**
     * @param string $tab
     * @param array $data
     * @return \Illuminate\Http\Response
     */
    private function update(string $tab, array $data)
    {
        if ($tab === 'store') {
            if (\request()->hasFile('store_logo')) {
                $data['store_logo'] = \request()->user()
                    ->addMedia($data['store_logo'])
                    ->toMediaCollection('store_logo')
                    ->getFullUrl();
            }
        }

        \request()->user()->settings()->setMultiple([$tab => $data]);
        return $this->banner('Settings Updated.');
    }
}
