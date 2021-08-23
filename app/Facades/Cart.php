<?php

namespace App\Facades;

class Cart extends \Gloudemans\Shoppingcart\Facades\Cart
{
    public static function subtotal()
    {
        return intval(str_replace(',', '', parent::subtotal()));
    }

    public static function discount()
    {
        return parent::content()->sum(function ($item) {
            return $item->qty * intval(str_replace(', ', '', $item->options->discount));
        });
    }

    public static function total()
    {
        return static::subtotal() - static::discount();
    }
}
