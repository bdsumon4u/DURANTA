<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Library extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['type'];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('300x100')
            ->width(300)
            ->height(100)
            ->sharpen(10)
            ->performOnCollections('logo');
        $this->addMediaConversion('16x16')
            ->width(16)
            ->height(16)
            ->sharpen(10)
            ->performOnCollections('favicon');
        $this->addMediaConversion('32x32')
            ->width(32)
            ->height(32)
            ->sharpen(10)
            ->performOnCollections('favicon');
        $this->addMediaConversion('48x48')
            ->width(48)
            ->height(48)
            ->sharpen(10)
            ->performOnCollections('favicon');
        $this->addMediaConversion('64x64')
            ->width(64)
            ->height(64)
            ->sharpen(10)
            ->performOnCollections('favicon');
        $this->addMediaConversion('128x128')
            ->width(128)
            ->height(128)
            ->sharpen(10)
            ->performOnCollections('favicon');
        $this->addMediaConversion('256x256')
            ->width(256)
            ->height(256)
            ->sharpen(10)
            ->performOnCollections('favicon');
        $this->addMediaConversion('512x512')
            ->width(512)
            ->height(512)
            ->sharpen(10)
            ->performOnCollections('favicon');
    }
}
