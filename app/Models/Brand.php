<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Brand extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use Searchable;

    protected $fillable = ['name'];
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

    public function setSlugAttribute($slug)
    {
        $this->attributes['slug'] = Str::slug($this->name);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return Arr::only($this->toArray(), [
            'id', 'name', 'slug',
        ]);
    }
}
