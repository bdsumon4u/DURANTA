<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Widget extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['name', 'title', 'weight', 'settings'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('default')->singleFile();
    }

    public function setSettingsAttribute($settings)
    {
        $this->attributes['settings'] = json_encode($settings);
    }

    public function getSettingsAttribute($settings)
    {
        return json_decode($settings, true);
    }

    public static function slugOrFail(string $slug)
    {
        return static::findOrFail(Str::afterLast($slug, '--i'));
    }

    public function products($query = '')
    {
        $data['brands'] = data_get($this->settings, 'brands') ?? '';
        $data['categories'] = data_get($this->settings, 'categories') ?? '';
        $data['ordering'] = data_get($this->settings, 'ordering', 'latest');
        $callback = function ($query) use (&$data) {
            $query->approved()->with('firstMedia')
                ->when($data['brands'], function ($query) use (&$data) {
                    $query->whereIn('brand_id', explode(',', $data['brands']));
                })->when($data['categories'], function ($query) use (&$data) {
                    $query->whereHas('categories', function ($query) use (&$data) {
                        $query->whereIn('categories.id', explode(',', $data['categories']));
                    });
                })->when($data['ordering'] === 'random', function ($query) {
                    $query->inRandomOrder();
                })->when($data['ordering'] === 'latest', function ($query) {
                    $query->latest('id');
                });
        };
        return $query ? Product::search($query)->query($callback) : Product::when(true, $callback);
    }
}
