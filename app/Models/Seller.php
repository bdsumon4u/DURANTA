<?php

namespace App\Models;

use App\Traits\MustVerifyPhone;
use Bavix\Wallet\Interfaces\Wallet;
use Bavix\Wallet\Traits\HasWallet;
use Glorand\Model\Settings\Traits\HasSettingsTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Seller extends Authenticatable implements \App\Contracts\Auth\MustVerifyPhone, Wallet, HasMedia
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasSettingsTable;
    use HasWallet;
    use InteractsWithMedia;
    use MustVerifyPhone;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'phone_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'store_logo',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('store_logo')->singleFile();
    }

    public function getStoreLogoAttribute()
    {
        return $this->getFirstMediaUrl('store_logo');
    }

    public function getFallbackMediaUrl()
    {
        return 'https://via.placeholder.com/512';
    }

    public function sellership()
    {
        return $this->hasOne(Sellership::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Not A Relationship.
    public function orders()
    {
        return Order::query()->whereHas('products', function ($query) {
            $query->where('seller_id', $this->getKey());
        });
    }
}
