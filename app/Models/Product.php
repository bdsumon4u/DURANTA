<?php

namespace App\Models;

use App\Traits\BuyableProduct;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia, Buyable
{
    use BuyableProduct;
    use HasFactory;
    use InteractsWithMedia;
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

    public static function slugOrFail(string $slug)
    {
        return static::findOrFail(Str::afterLast($slug, '--i'));
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
}
