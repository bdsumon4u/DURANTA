<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Laravel\Scout\Searchable;

class Order extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'address_id', 'contact_name', 'contact_phone', 'note', 'subtotal', 'discount', 'shipping', 'total', 'meta', 'status',
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
            ->withPivot('first_media', 'slug', 'discount', 'price', 'quantity', 'commission', 'status');
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

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return array_merge(Arr::only($this->toArray(), [
            'id', 'contact_name', 'contact_phone', 'status',
        ]), ['order' => '#' . $this->getKey()]);
    }
}
