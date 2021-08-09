<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'address_id', 'contact_name', 'contact_phone', 'contact_phone', 'note', 'subtotal', 'discount', 'shipping', 'total', 'meta', 'status',
    ];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('first_media', 'slug', 'discount', 'price', 'quantity');
    }
}
