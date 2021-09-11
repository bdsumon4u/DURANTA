<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavItem extends Model
{
    use HasFactory;

    protected $fillable = ['parent_id', 'nav_menu_id', 'label', 'link', 'weight', 'depth'];

    public function parent()
    {
        return $this->belongsTo(NavMenu::class, 'parent_id');
    }

    public function getLinkAttribute($link)
    {
        return url($link);
    }
}
