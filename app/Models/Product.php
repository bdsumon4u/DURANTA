<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
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
        'status',
    ];

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
}
