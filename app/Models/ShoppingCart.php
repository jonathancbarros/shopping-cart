<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = ['product_id', 'amount'];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
