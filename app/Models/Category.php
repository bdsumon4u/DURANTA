<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['name', 'slug'];
    protected $with = ['media'];
    protected $appends = ['image'];

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
        return 'https://via.placeholder.com/512';
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
