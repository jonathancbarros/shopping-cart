<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'value'];

    public function shoppingCart()
    {
        return $this->belongsTo(ShoppingCart::class);
    }
}
