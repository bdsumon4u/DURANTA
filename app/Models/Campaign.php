<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Campaign extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['name', 'starts_at', 'ends_at', 'deadline'];

    protected $with = ['media'];
    protected $appends = ['image'];
    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'deadline' => 'datetime',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('default')->singleFile();
    }

    public function getImageAttribute()
    {
        return $this->getFirstMediaUrl();
    }

    public function getFallbackMediaUrl()
    {
        return 'https://via.placeholder.com/1300x350';
    }

    public function setSlugAttribute()
    {
        $this->attributes['slug'] = Str::slug($this->name);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot(['discount', 'selling', 'status']);
    }
}
