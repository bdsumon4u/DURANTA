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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('first_media', 'slug', 'discount', 'price', 'quantity');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Not A Relationship.
    public function sellers()
    {
        $products = $this->products->pluck('id')->toArray();
        return Seller::query()->whereHas('products', function ($query) use ($products) {
            $query->whereIn('id', $products);
        });
    }
}
