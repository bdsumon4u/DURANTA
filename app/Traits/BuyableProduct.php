<?php

namespace App\Traits;

trait BuyableProduct
{
    public function getBuyableIdentifier($options = null) {
        return $this->getKey();
    }

    public function getBuyableDescription($options = null) {
        return $this->name;
    }

    public function getBuyableDiscount($options = null)
    {
        return $this->discount_type === 'percent'
            ? round($this->price * $this->discount_amount / 100)
            : $this->discount_amount;
    }

    public function getBuyableCommission($options = null)
    {
        return $this->commission_type === 'percent'
            ? round($this->price * $this->commission_amount / 100)
            : $this->commission_amount;
    }

    public function getBuyablePrice($options = null) {
        return $this->price;
    }

    public function getBuyableWeight($options = null) {
        return $this->weight ?? 0;
    }
}
