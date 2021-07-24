<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use Inertia\Inertia;
use Spatie\LaravelSettings\Settings;

class SettingController extends Controller
{
    private array $tabs = ['general', 'social', 'other'];

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

            return Inertia::render('Admin/Settings/'.ucfirst($tab), [
                'settings' => $this->settings($tab)->toArray(),
                'tabs' => $this->tabs,
            ]);
        }

        return $this->update($tab, $request->validated());
    }

    /**
     * @param string $tab
     * @param array $data
     * @return Settings
     */
    private function settings(string $tab, array $data = []): Settings
    {
        return resolve('\\App\\Settings\\'.ucfirst($tab).'Settings', $data);
    }

    /**
     * @param string $tab
     * @param array $data
     * @return \Illuminate\Http\Response
     */
    private function update(string $tab, array $data)
    {
        if ($tab === 'general') {
            if ($old = $data['logo']) {
                $data['logo'] = 'logo';
                // Delete Old
            }
            if ($old = $data['favicon']) {
                $data['favicon'] = 'favicon';
                // Delete Old
            }
        }

        $this->settings($tab)->fill($data)->save();
        return $this->banner('Settings Updated.');
    }
}
