<?php

namespace App\Models;

use App\Traits\BuyableProduct;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia, Buyable
{
    use BuyableProduct;
    use HasFactory;
    use InteractsWithMedia;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'brand_id',
        'sku',
        'name',
        'slug',
        'description',
        'price',
        'discount_amount',
        'discount_type',
        'discount_from',
        'discount_till',
        'stock_track',
        'stock_count',
        'pickup_point',
        'commission_amount',
        'commission_type',
        'commission_from',
        'status',
    ];

    public function setSlugAttribute($slug)
    {
        $this->attributes['slug'] = Str::beforeLast($slug ?? Str::slug($this->name), '--i');
    }

    public function getSlugAttribute($slug)
    {
        return ($slug ?? Str::slug($this->name)) . '--i' . $this->getKey();
    }

    public static function slugOrFail(string $slug)
    {
        return static::findOrFail(Str::afterLast($slug, '--i'));
    }

    public function scopeApproved($query, $status = 'APPROVED')
    {
        return $query->where(compact('status'));
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function firstMedia()
    {
        return $this->morphOne(config('media-library.media_model'), 'model')
            ->oldestOfMany('order_column');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    /**
     * Determine if the model should be searchable.
     *
     * @return bool
     */
    public function shouldBeSearchable()
    {
        return $this->status === 'ACTIVE';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return Arr::only($this->toArray(), [
            'id', 'seller_id', 'brand_id', 'sku', 'name', 'slug', 'description',
        ]);
    }
}
