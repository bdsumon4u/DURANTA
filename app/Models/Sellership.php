<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Sellership extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'store_name', 'store_email', 'store_phone', 'store_address', 'status',
    ];

    public function registerMediaCollections(): void
    {
        foreach (['nid_front', 'nid_back', 'license', 'signboard'] as $type) {
            $this->addMediaCollection($type)->singleFile();
        }
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
}
