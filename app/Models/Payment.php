<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'tran_id', 'val_id', 'amount', 'card_type', 'store_amount', 'bank_tran_id', 'status', 'tran_date', 'error', 'currency', 'risk_title', 'gateway_url',
    ];

    protected $casts = [
        'tran_date' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
