<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Models\Library;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Spatie\LaravelSettings\Settings;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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
        $settings = $this->settings($tab);
        if ($tab === 'general') {
            foreach (['logo', 'favicon'] as $type) {
                if ($data[$type] instanceof UploadedFile) {
                    $fullUrl = Library::firstOrCreate(['type' => 'branding'])
                        ->addMedia($data[$type])
                        ->toMediaCollection($type)
                        ->getFullUrl();
                    $hostname = parse_url($fullUrl, PHP_URL_HOST);
                    $data[$type] = Str::after($fullUrl, $hostname);
                }
            }
        }

        $settings->fill($data)->save();
        return $this->banner('Settings Updated.');
    }
}
